<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use App\Models\Family;
use App\Models\Volume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genus>
 */
class GenusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     public function definition()
    {
        return [
            'genus_code' => (string) Str::uuid(),
                  'name' => ucfirst($this->faker->word()) . 'aceae',
            'description' => $this->faker->sentence(),
            'family_id' => Family::inRandomOrder()->value('id') ?? Family::factory(),
            'volume_id' => Volume::inRandomOrder()->value('id') ?? Volume::factory(),
        ];
    }
}
