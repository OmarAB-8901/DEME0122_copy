<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orgchart extends Model
{
   
    protected $fillable=[
        'nameorg','idgroup','ord_num','time1','time2','cond'
    ];


   

}
