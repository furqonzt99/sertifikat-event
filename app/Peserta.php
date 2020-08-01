<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = "peserta";

    protected $guarded = ['id'];

    public function event(){
    	return $this->belongsTo('App\Event');
    }
}
