<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Defectos extends Model
{
     protected $fillable=[
        'fecha','idScrap','cantidad', 'loteid','idMachine','isdefect'
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
