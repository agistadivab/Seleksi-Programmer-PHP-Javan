<?php

namespace Database\Factories;

use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;

class VillageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->randomNumber(9),
            'district_code' => $this->faker->randomNumber(6),
            'name' => $this->faker->city,
            'meta' => '{"lat":"'.$this->faker->latitude.'","long":"'.$this->faker->longitude.'","pos":"'.$this->faker->address.'"}',
        ];
    }
}
