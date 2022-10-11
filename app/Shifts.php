<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    protected $fillable =[
        'id','name','start_time','end_time','idgroup','condicion'
    ];
    public function user()
    {
        return $this->hasMany('App\User');
    }
}
