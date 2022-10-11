<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    protected $fillable=[
        'name','description','ict','plan','condicion'
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
