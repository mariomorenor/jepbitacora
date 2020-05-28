<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cajero extends Model
{
    protected $fillable=[
        'zona_id','direccion','descripcion','codigo'
    ];

    protected $casts=[
       'zona_id'=>'integer',
       'codigo'=>'integer',
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    public function observaciones()
    {
        return $this->hasMany(Observacion::class);
    }

}
