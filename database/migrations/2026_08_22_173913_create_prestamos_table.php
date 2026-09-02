<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('libro_id')->constrained('libros')->onDelete('cascade');
            
            // Datos del estudiante para el préstamo
            $table->string('documento')->nullable();
            $table->string('telefono')->nullable();
            $table->string('grado')->nullable();
            
            // Trazabilidad de fechas y estado
            $table->timestamp('fecha_solicitud')->useCurrent();
            $table->timestamp('fecha_prestamo')->nullable();
            $table->date('fecha_devolucion_limite')->nullable();
            $table->date('fecha_devolucion_esperada')->nullable();
            $table->date('fecha_devolucion_real')->nullable();
            
            $table->enum('estado', ['pendiente', 'activo', 'aprobado', 'rechazado', 'devuelto'])->default('pendiente'); 
            
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};