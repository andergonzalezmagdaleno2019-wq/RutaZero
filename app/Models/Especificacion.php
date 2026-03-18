<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especificacion extends Model
{
    use HasFactory;

    // Definimos la tabla manualmente ya que Laravel buscaría "especificacions" por defecto
    protected $table = 'especificaciones';

    protected $fillable = [
        'moto_id',
        'motor',
        'cilindrada',
        'transmision',
        'frenos',
        'potencia',
        'descripcion',
    ];

    // Relación inversa: Una especificación pertenece a una moto
    public function moto()
    {
        return $this->belongsTo(Moto::class, 'moto_id');
    }
}