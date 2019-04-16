<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medio extends Model
{
    protected $fillable = [
		'nombre', 'descripcion', 'marca', 'color', 'capacidad', 'foto', 'stock', 'departamento'];
}
