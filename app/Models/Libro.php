<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Libro extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva.
     */
    protected $fillable = [
        'titulo',
        'autor',
        'isbn',
        'categoria',
        'stock',
        'portada',
        'descripcion',
    ];

    /**
     * Obtiene la URL completa de la portada o una imagen por defecto.
     */
    public function getPortadaUrlAttribute(): string
    {
        if ($this->portada && Storage::disk('public')->exists($this->portada)) {
            return Storage::url($this->portada);
        }

        return asset('images/default-book-cover.jpg');
    }
}