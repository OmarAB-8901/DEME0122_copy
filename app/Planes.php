<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planes extends Model
{
    protected $fillable=[
        'orden_trabajo','modelo','lote','ict','plan','condicion'
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
