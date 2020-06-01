<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reportes';
    protected $fillable=[
        'cajero_id',
        'observacion_id',
        'fecha'
    ];
    protected $guarded=[''];

    protected $casts = [
        'cajero_id'=>'integer',
        'observacion_id'=>'integer',
        'fecha'=>'date',
        
    ];

    public function cajero()
    {
        return $this->belongsTo(Cajero::class,'cajero_id');
    }
    public function observacion()
    {
        return $this->belongsTo(observacion::class,'observacion_id');
    }

}
