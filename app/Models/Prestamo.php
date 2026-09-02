<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\BelongsTo;
=======
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb

class Prestamo extends Model
{
    use HasFactory;

<<<<<<< HEAD
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
=======
    protected $fillable = [
        'user_id',
        'libro_id',
        'estado',
        'fecha_solicitud',
        'fecha_prestamo',
        'fecha_devolucion_esperada',
        'fecha_devolucion_real',
    ];

    /**
     * Relación con el usuario que solicita el préstamo
     */
    public function user()
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
    {
        return $this->belongsTo(User::class);
    }

    /**
<<<<<<< HEAD
     * Relación con el libro prestado.
     */
    public function libro(): BelongsTo
=======
     * Relación con el libro prestado
     */
    public function libro()
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
    {
        return $this->belongsTo(Libro::class);
    }
}