<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $guarded = [];
    protected $table = 'cotizaciones';
    protected $appends = ['grand_total'];

    public function movimientos()
    {
        return $this->hasMany('App\CotDetalle', 'id_cotizacion');
    }

    public function getGrandTotalAttribute()
    {
        return number_format($this->movimientos()->sum('precio'), 2);
    }
}
