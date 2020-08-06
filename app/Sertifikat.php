<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $table = "sertifikat";

    protected $fillable = ['id_event', 'email'];
}
