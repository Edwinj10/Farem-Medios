<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
	protected $fillable = [
		'id_usuario', 'fecha', 'estado', 'detalle'];
	}
