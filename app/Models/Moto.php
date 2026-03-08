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

    public function marca()
    {
        return $this->belongsTo(Equipo::class);
    }
}