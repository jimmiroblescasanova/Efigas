<?php

namespace App\Imports;

use App\Producto;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;

class ProductosImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    use Importable;

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.codigo' => 'required',
            '*.descripcion' => 'required',
            '*.precio' => ['required', 'numeric'],
        ], [
            '*.codigo.required' => 'El código no puede estar vacío.',
            '*.descripcion.required' => 'El nombre no puede estar vacío.',
            '*.precio.required' => 'El precio no puede estar vacío.',
            '*.precio.numeric' => 'El precio debe ser un número.'
        ])->validate();

        foreach($rows as $row)
        {
            Producto::updateOrCreate([
                'codigo' => $row['codigo']
            ], [
                'tipoProducto' => 1,
                'nombre' => $row['descripcion'],
                'precio' => $row['precio'],
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 500;
    }

}
