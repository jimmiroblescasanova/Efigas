<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $guarded = [];

    public function setNameAttribute($val)
    {
        $this->attributes['name'] = strtoupper($val);
    }

    public function setRfcAttribute($val)
    {
        $this->attributes['rfc'] = strtoupper($val);
    }

    public function measurer()
    {
        return $this->belongsTo('App\Measurer');
    }

    public function getIdAttribute($id)
    {
        return str_pad($id, 5, '0', STR_PAD_LEFT);
    }
}
