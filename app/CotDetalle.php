<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotDetalle extends Model
{
    protected $guarded = [];
    protected $table = 'cot_detalle';

    public function cotizacion()
    {
        return $this->belongsTo('App\Cotizacion');
    }

}
