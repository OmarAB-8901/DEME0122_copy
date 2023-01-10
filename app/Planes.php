<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planes extends Model
{
    protected $fillable=[
        'orden_trabajo','modelo','lote','plan','asociados','condicion',
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
