<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oee extends Model
{
    public $timestamps = false;
    protected $fillable =['id','idmachine','capturedTime','oee','availability','runTime','performance','ict','totalPieces','quality','goodParts','lotId','partId','idShift'];
    public function machine(){
        return $this->belongsTo('App\Machine');
    }
}
