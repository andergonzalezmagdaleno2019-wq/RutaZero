<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'imagen_url'];

    public function motos()
    {
        return $this->hasMany(Moto::class);
    }
}