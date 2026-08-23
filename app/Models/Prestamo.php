<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

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
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el libro prestado
     */
    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }
}