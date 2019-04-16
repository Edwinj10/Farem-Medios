<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservacione extends Model
{
	protected $fillable = [
		'id_usuario', 'fecha', 'aula','carrera','estado', 'detalle'];
	}


