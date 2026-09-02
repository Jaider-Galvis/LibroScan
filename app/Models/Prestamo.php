<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestamo extends Model
{
    use HasFactory;

    /**
     * Atributos asignables masivamente.
     */
    protected $fillable = [
        'user_id',
        'libro_id',
        'documento',
        'telefono',
        'grado',
        'estado',
        'fecha_solicitud',
        'fecha_prestamo',
        'fecha_devolucion_limite',
        'fecha_devolucion_esperada',
        'fecha_devolucion_real',
        'observaciones',
    ];

    /**
     * Conversión automática de tipos (Casting).
     */
    protected $casts = [
        'user_id'                   => 'integer',
        'libro_id'                  => 'integer',
        'fecha_solicitud'           => 'datetime',
        'fecha_prestamo'            => 'datetime',
        'fecha_devolucion_limite'   => 'datetime',
        'fecha_devolucion_esperada' => 'datetime',
        'fecha_devolucion_real'     => 'datetime',
    ];

    /**
     * Relación con el usuario (Estudiante/Lector) que solicita el préstamo.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el libro prestado.
     */
    public function libro(): BelongsTo
    {
        return $this->belongsTo(Libro::class);
    }
}