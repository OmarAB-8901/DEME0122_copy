<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeEvent extends Model
{
    protected $fillable =[
        'id','id_type','name','idgroups','description','condicion','created_at','updated_at'
    ];
    public function user()
    {
        return $this->hasMany('App\User');
    }
}
