<?php

namespace Database\Factories;

use App\Models\Atencion;
use App\Models\Sector;
use App\Models\Tramite;
use Illuminate\Database\Eloquent\Factories\Factory;
use Parfaitementweb\FilamentCountryField\Forms\Components\Country;

/**
 * @extends Factory<Atencion>
 */
class AtencionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $country = (fake()->numberBetween(0, 100) < 96) ? 'CL' : fake()->randomKey((new Country('list'))->getList());
        $gender = fake()->randomElement(['female', 'male']);
        $sector = Sector::all();
        $tramite = Tramite::all();

        return [
            'rut' => fake()->rut(),
            'names' => fake()->firstName($gender).' '.fake()->firstName($gender),  // 2 nombres.
            'lastname_1' => fake()->lastName(),
            'lastname_2' => fake()->lastName(),
            'sector_id' => fake()->numberBetween($sector->first()->id, $sector->last()->id),
            'phone' => '+56'.fake()->numberBetween(111111111, 999999999),
            'nationality' => $country,
            'tramite_id' => fake()->numberBetween($tramite->first()->id, $tramite->last()->id),
            'created_at' => fake()->dateTimeBetween('-2 years'),
        ];
    }
}
