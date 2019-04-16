<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    //
protected $fillable = [
		'nombre', 'hora_inicio', 'hora_fin'];
}
