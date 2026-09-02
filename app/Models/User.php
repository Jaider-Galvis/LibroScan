<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
<<<<<<< HEAD
        'documento', // <-- Permite guardar el documento
        'telefono',  // <-- Permite guardar el teléfono
        'grado',     // <-- Permite guardar el grado
=======
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
        'password',
        'role',
    ];

    /**
<<<<<<< HEAD
     * Valores por defecto para el modelo en memoria.
=======
     * Valors por defecto para el modelo en memoria.
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
     *
     * @var array<string, string>
     */
    protected $attributes = [
        'role' => 'student',
    ];

    /**
     * Los atributos que deben ocultarse en serializaciones JSON/API.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atributos que deben convertirse a tipos nativos de PHP.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Garantiza cifrado automático vía Hash
        ];
    }

    /**
<<<<<<< HEAD
     * Relación: Un usuario puede tener muchos préstamos.
     */
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }

    /**
=======
>>>>>>> 1acfdab512664ac7878291e1876e3e0944357adb
     * Verifica si el usuario es administrador o bibliotecario.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Verifica si el usuario es un estudiante.
     */
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }
}