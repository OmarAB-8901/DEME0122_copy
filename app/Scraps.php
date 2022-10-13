<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scraps extends Model
{
    protected $fillable=[
        'identifier','name','descripcion','condicion'
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
