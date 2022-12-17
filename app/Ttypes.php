<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ttypes extends Model
{
     protected $fillable=[
        'descrip','orden','codigo'
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
