<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalAdministrativo extends Model
{
    protected $table = 'personal_administrativo';

    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'apellidos',
        'correo_institucional',
        'password',
        'cargo',
    ];

    protected $hidden = [
        'password',
    ];
}
