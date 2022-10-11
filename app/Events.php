<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    public $timestamps = false;
    protected $fillable =['id','idmachine','startTime','endTime','type','descriptions','justification','duration'];
    public function machine(){
        return $this->belongsTo('App\Machine');
    }
}
