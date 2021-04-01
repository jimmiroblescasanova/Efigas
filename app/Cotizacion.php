<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $guarded = [];
    protected $table = 'cotizaciones';
    protected $appends = ['grand_total'];
    protected $dates = [
        'fecha',
    ];

    public function movimientos()
    {
        return $this->hasMany('App\CotDetalle', 'id_cotizacion');
    }

    public function getGrandTotalAttribute()
    {
        return number_format($this->movimientos()->sum('total'), 2);
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('id', 'LIKE', '%' . $search . '%')
            ->orWhere('nombre', 'LIKE', '%' . $search . '%')
            ->orWhere('fecha', 'LIKE', '%' . $search . '%');
    }
}
