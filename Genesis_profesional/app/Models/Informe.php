<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Informe extends Model
{
    protected $table = 'informes';

    public $timestamps = true;
    const UPDATED_AT = null;

    protected $fillable = [
        'pasante_id',
        'tipo',
        'archivo_url',
        'estado',
        'observaciones',
        'horas',
        'nombre',
        'objetivos',
        'actividades',
        'conclusiones',
        'fecha_inicio',
        'fecha_fin',
        'bitacora',
        'imagenes',
    ];

    protected $casts = [
        'bitacora' => 'array',
        'imagenes' => 'array',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'horas' => 'float',
    ];

    public function pasante(): BelongsTo
    {
        return $this->belongsTo(Pasante::class, 'pasante_id', 'id');
    }
}
