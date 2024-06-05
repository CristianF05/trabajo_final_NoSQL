<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'estudiantes';

    protected $fillable = [
        'nombre',
        'apellido',
        'salon',
        'grado',
        'dni',
    ];
}
