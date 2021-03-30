<?php

namespace App\Http\Livewire;

use App\Producto;
use App\Cotizacion;
use Livewire\Component;
use Livewire\WithPagination;


class CotizacionComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nombre, $fecha, $direccion;
    public $searchInput;
    public $rowInput = [];
    public $i = 0;


    public function mount()
    {
        $this->searchInput = '';
    }

    public function updatingSearchInput()
    {
        $this->resetPage();
    }

    public function clearForm()
    {
        $this->rowInput = [];
        $this->nombre = '';
        $this->fecha = '';
        $this->direccion = '';
    }

    public function addInput($id)
    {
        $result = [];
        $producto = Producto::findOrFail($id);

        $result['id'] = $producto->id;
        $result['nombre'] = $producto->nombre;
        $result['precio'] = $producto->precio;

        array_push($this->rowInput ,$result);
        $this->searchInput = '';
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|string|min:6',
            'fecha' => 'required|date',
            'direccion' => 'nullable',
            'rowInput' => 'array|min:1',
            'rowInput.*.cantidad' => 'required|numeric',
            'rowInput.*.id' => 'required|numeric',
            'rowInput.*.precio' => 'required|numeric',
        ], [
            'rowInput.min' => 'Debes agregar al menos un producto',
            'rowInput.*.cantidad.required' => 'Cantidad obligatoria',
            'rowInput.*.precio.required' => 'Precio obligatorio',
            'rowInput.*.cantidad.numeric' => 'Solo números',
            'rowInput.*.precio.numeric' => 'Solo números',
        ]);

        $documento = Cotizacion::create([
            'nombre' => $this->nombre,
            'fecha' => $this->fecha,
            'direccion' => $this->direccion,
        ]);

        foreach ($this->rowInput as $row)
        {
            $fila = $documento->movimientos()->create([
                'id_producto' => $row['id'],
                'cantidad' => $row['cantidad'],
                'precio' => $row['precio'],
            ]);
        }

        $this->clearForm();

        session()->flash('message', 'Cotización guardada correctamente.');
    }

    public function render()
    {
        $prod = '';

        if($this->searchInput != '')
        {
            $prod = Producto::where('nombre', 'LIKE', '%'.$this->searchInput.'%')->paginate(5);
        }

        return view('livewire.cotizacion', [
            'products' => $prod,
        ]);
    }

}
