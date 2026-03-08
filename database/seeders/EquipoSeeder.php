<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipo;

class EquipoSeeder extends Seeder
{
    public function run(): void
    {
        $marcas = [
            [
                'nombre' => 'Honda',
                'descripcion' => 'Potencia y fiabilidad japonesa.',
                'imagen_url' => 'equipos/honda-logo.png', // Ruta relativa dentro de storage/app/public
            ],
            [
                'nombre' => 'Kawasaki',
                'descripcion' => 'Domina el asfalto con adrenalina.',
                'imagen_url' => 'equipos/kawasaki-logo.png',
            ],
            [
                'nombre' => 'Suzuki',
                'descripcion' => 'Innovación en cada detalle.',
                'imagen_url' => 'equipos/suzuki-logo.png',
            ],
        ];

        foreach ($marcas as $marca) {
            Equipo::create($marca);
        }
    }
}