<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use App\Models\Genus;
use App\Models\Family;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Species>
 */
class SpeciesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'species_code' => (string) Str::uuid(),
                  'name' => ucfirst($this->faker->word()) . ' ' . $this->faker->lexify('sp????'),
                //   'name' => ucfirst($this->faker->word()) . 'aceae'. ' ' . $this->faker->unique()->word(),
            // 'name' => ucfirst($this->faker->unique()->word()) . ' ' . $this->faker->unique()->word(),
            // 'description' => $this->faker->paragraph(),
            'description' => substr($this->faker->paragraph(), 0, 175),
            'genus_id' => Genus::inRandomOrder()->value('id') ?? Genus::factory(),
            'family_id' => Family::inRandomOrder()->value('id') ?? Family::factory(),
            'author' => $this->faker->name(),
            'publication' => $this->faker->sentence(3),
            'year_described' => $this->faker->year(),
            'volume' => 'Vol ' . $this->faker->numberBetween(1, 500),
            'page' => $this->faker->numberBetween(1, 999),
            'common_name' => $this->faker->word(),
            'synonyms' => json_encode($this->faker->words(3)),
        ];
    }
}
