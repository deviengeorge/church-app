<?php

namespace Database\Factories;

use App\Enums\PersonGender;
use App\Enums\PersonStatus;
use App\Enums\PersonTitle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name;
        $names = explode(" ", $name);
        return [
            'name' => $name,
            'names' => $names,
            'title' => PersonTitle::cases()[rand(0, count(PersonTitle::cases()) - 1)],
            'gender' => PersonGender::cases()[rand(0, count(PersonGender::cases()) - 1)],
            'status' => PersonStatus::UNEMPLOYED,
        ];
    }
}
