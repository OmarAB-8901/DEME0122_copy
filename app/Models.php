<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    protected $fillable=[
        'name','description','valor_std', 'idmachine','condicion'
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
