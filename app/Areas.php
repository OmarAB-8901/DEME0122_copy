<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
     protected $fillable=[
        'pos','namearea','idmachine', 'condition'
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
