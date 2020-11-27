<?php

namespace App\Http\Controllers;

use AWS;
use App\Price;
use App\Project;
use App\Clients;
use App\Document;
use App\Measurer;
use Carbon\Carbon;
use App\Traits\UpdateProjectTrait;
use App\Http\Requests\SaveDocumentRequest;
use Illuminate\Support\Facades\DB;

class DocumentsController extends Controller
{
    use UpdateProjectTrait;

    public function __construct()
    {
        $this->middleware('auth')->except('print');
    }

    public function index()
    {
        return view('documents.index',[
            'documents' => Document::orderByDesc('id')->get(),
        ]);
    }

    public function create()
    {
        return view('documents.create', [
            'clients' => Clients::select('id', 'name')->whereNotNull('measurer_id')->get(),
        ]);
    }

    public function store(SaveDocumentRequest $request)
    {
        // Primero obtenemos el precio actual de la BD
        $price = Price::latest()->first()->price;
        // Se obtiene el cliente capturado
        $client = Clients::findOrFail($request->client_id);
        // Se calcula el día de pago a partir de la fecha de captura
        $payment_date = Carbon::create($request->date)->addDays(20);
        // Guarda la foto y asigna la ruta
        $photo = $request->file('photo')->store('images');
        // Consumo del mes
        $month_quantity = $request->final_quantity - $client->measurer->actual_measure;
//        Factor de correccion
        $correction_factor = Measurer::findOrFail($client->measurer_id)->value('correction_factor');
        // Importe total del mes
        $total = ($month_quantity * ($price * $correction_factor)) + $client->balance;
        if ($client->reconnection_charge == TRUE) {
            $total = $total + 99;
        }
        // Separar decimales
        $decimals = explode('.', round($total,2));
//        return $decimals;
        // Guarda todos los valores en un array
        $data = [
            'client_id' => $request->client_id,
            'date' => $request->date,
            'payment_date' => $payment_date,
            'final_quantity' => $request->final_quantity,
            'start_quantity' => $client->measurer->actual_measure,
            'month_quantity' => $month_quantity,
            'correction_factor' => $correction_factor,
            'period' => Carbon::create($request->date)->subMonth()->isoFormat('MMMM, Y'),
            'price' => $price,
            'total' => $decimals[0],
            'pending' => $decimals[0],
            'previous_balance' => $client->balance,
            'photo' => $photo,
        ];

        DB::beginTransaction();
        try {
            // Crea el documento a partir de array
            $document_id = DB::table('documents')->insertGetId($data);
            // Actualiza el balance del cliente
            DB::table('clients')
                ->where('id', $request->client_id)
                ->update([
                    'balance' => array_key_exists(1, $decimals) ? $decimals[1] : 0,
                    'reconnection_charge' => FALSE,
                ]);
            // Crear la referencia de pago
            DB::table('documents')->where('id', $document_id)->update([
                'reference' => $payment_date->format('Ym') . str_pad($document_id, 4, '0', STR_PAD_LEFT)
            ]);
            // Obtener el id del medidor usado y actualiza su valor
            DB::table('measurers')->where('id', $client->measurer->id)->update([
                'actual_measure' => $request['final_quantity'],
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }

        // Descontar el consumo en el proyecto
        $project = Project::find($client->project_id);
        $project->actual_capacity = $project->actual_capacity - ($month_quantity * 4.1848); // Se multiplica por la conversión a litros
        $this->calculatePercentage($project);
        $project->save();

        return redirect()->route('documents.create')
            ->with('message', 'Lectura capturada correctamente.');
    }

    public function show(Document $document)
    {
        $historic = Document::select('id', 'period', 'month_quantity')
            ->where([
                ['client_id', $document->client_id],
                ['id', '<=', $document->id]
            ])->orderByDesc('id')->get();

        $advance_payment = Clients::find($document->client_id)->value('advance_payment');

        return view('documents.show', [
            'document' => $document,
            'historic' => $historic->take(6),
            'advance_payment' => $advance_payment,
        ]);
    }

    public function authorize_docto($id)
    {
        $docto = Document::findOrFail($id);
        $docto->status = 2;
        $docto->save();

        $phone_number = $docto->client->country_code . $docto->client->phone;

        $sms = AWS::createClient('sns');
        $sms->publish([
            'Message' => 'Estimado cliente, se ha generado su recibo de servicio de gas y se ha enviado a su correo electrónico registrado.',
            'PhoneNumber' => $phone_number,
            'MessageAttributes' => [
                'AWS.SNS.SMS.SMSType'  => [
                    'DataType'    => 'String',
                    'StringValue' => 'Transactional',
                ]
            ],
        ]);

        return redirect()->route('documents.index');
    }

    public function cancel($id)
    {
        $docto = Document::findOrFail($id);
        $docto->status = 3;
        $docto->pending = 0;
        $docto->save();

        return back();
    }

    public function print($id)
    {
        $docto = Document::findOrFail($id);

        // Se obtiene los históricos de meses anteriores
        $historic = Document::select('id', 'period', 'month_quantity', 'total')
            ->where([
            ['client_id', $docto->client_id],
            ['id', '<=', $docto->id]
            ])->orderByDesc('id')->get();

        // Se arma el array para el histórico
        $arr_period = '[';
        $arr_data = '[';
        foreach ($historic->take(6) as $h)
        {
            $arr_period = $arr_period . '"' . $h->period . '",';
            $arr_data = $arr_data . $h->month_quantity . ',';
        }
        $arr_period = $arr_period . ']';
        $arr_data = $arr_data . ']';

        // Generar los valores de la gráfica
        $chart = "{
        type: 'bar',
        data: {
            labels: ". $arr_period .",
            datasets: [{
                'backgroundColor': 'rgba(169,169,169, 0.5)',
                label: 'Consumos', data: ". $arr_data ."}
                ]}
            }";

        // General el PDF
        $pdf = \PDF::loadView('print.document', [
            'docto' => $docto,
            'chart' => urlencode($chart),
            'historic' => $historic->take(2),
        ]);
        $pdf->setPaper('statement', 'portrait');
        return $pdf->stream();

//        return $historic->take(1);

    }
}
