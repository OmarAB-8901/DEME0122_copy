<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $fillable=[
        'name','condicion'
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
