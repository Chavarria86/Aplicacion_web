<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Postulacion extends Model
{
    protected $table = 'postulaciones';

    public $timestamps = true;
    const UPDATED_AT = null;

    protected $fillable = [
        'pasante_id',
        'vacante_id',
        'estado',
        'cv_id',
    ];

    public function pasante(): BelongsTo
    {
        return $this->belongsTo(Pasante::class, 'pasante_id', 'id');
    }

    public function vacante(): BelongsTo
    {
        return $this->belongsTo(Vacante::class, 'vacante_id', 'id');
    }

    public function cv(): BelongsTo
    {
        return $this->belongsTo(CurriculumVitae::class, 'cv_id', 'id');
    }
}
