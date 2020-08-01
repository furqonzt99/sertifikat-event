<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "event";

    protected $guarded = ['id'];

    public function peserta(){
    	return $this->hasMany('App\Peserta');
    }
}
