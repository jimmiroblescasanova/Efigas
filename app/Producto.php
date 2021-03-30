<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $guarded = [];

    public function setPrecioAttribute($val)
    {
        return $this->attributes['precio'] = $val * 100;
    }

    public function getPrecioAttribute($val)
    {
        return $this->attributes['precio'] = $val / 100;
    }

    public function cotizacion() {
        return $this->belongsTo('App\Cotizacion');
    }
}
