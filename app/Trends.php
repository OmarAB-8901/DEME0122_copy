<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trends extends Model
{
    public $timestamps = false;
    protected $fillable =['id','idvariable','date','value','highLimit','lowLimit'];
    public function variables()
    {
        return $this->hasMany('App\Variable');
    }
}
