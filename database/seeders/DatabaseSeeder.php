<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* Usuario desarrollador */
        if (env('APP_DEBUG') === true) {
            User::create([
                'name' => 'Marco González Luengo',
                'email' => 'dev@nqu.me',
                'email_verified_at' => now(),
                'password' => '$2y$12$baBvcVW6JRbGoXddyAOEVu34fWNXbAgEcejF7wFtacFb1ltBBiJAO',
                'remember_token' => 'j27O18VY00rkbav5nukKeO0aBFUhxHUNdGqGk1cs48qSWUgYTFUlHRPtZCuX',
            ]);
        }

        /* Seeder de datos base */
        $this->call([
            SectorSeeder::class,
            TramiteSeeder::class,
        ]);
    }
}
