<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca',
        'modelo',
        'cilindrada',
        'precio',
        'imagen',
    ];

    // Relación con Equipos (Marcas) que ya tienes
    public function marca()
    {
        return $this->belongsTo(Equipo::class);
    }

    // NUEVA RELACIÓN: Una moto tiene una especificación técnica
    public function especificacion()
    {
        return $this->hasOne(Especificacion::class, 'moto_id');
    }
}