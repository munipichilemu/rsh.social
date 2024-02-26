<?php

namespace Database\Seeders;

use App\Models\Tramite;
use Illuminate\Database\Seeder;

class TramiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tramite::insert([
            ['name' => 'Ingreso RSH', 'description' => 'Ingreso al Registro Social de Hogares', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Actualización Educación', 'description' => 'Actualización módulo Educación', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Actualización domicilio', 'description' => 'Actualización de domicilio e información de vivienda', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Incorporación nuevo integrante', 'description' => 'Incorporación de nuevo integrante', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cambio jefe de hogar', 'description' => 'Cambio jefe de hogar', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Desvinculación integrante', 'description' => 'Desvinculación de integrante', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Actualización parentesco', 'description' => 'Actualización de relación de parentesco', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Actualización ocupación/ingresos', 'description' => 'Actualización de ocupación e ingresos', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Actualización Salud', 'description' => 'Actualización módulo de salud', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Actualización Vivienda', 'description' => 'Actualización módulo de vivienda', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Actualización Registro Administrativo', 'description' => 'Actualización de información de registros administrativos', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rectificación Registro Administrativo', 'description' => 'Rectificación de información de registros administrativos', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Complemento información', 'description' => 'Complemento de información al registro', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
