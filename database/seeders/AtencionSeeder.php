<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AtencionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Atencion::factory(10)->create();
    }
}
