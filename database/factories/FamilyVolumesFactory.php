<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Family;
use App\Models\Volume;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FamilyVolume>
 */
class FamilyVolumesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'family_id' => Family::inRandomOrder()->value('id') ?? Family::factory(),
            'volume_id' => Volume::inRandomOrder()->value('id') ?? Volume::factory(),
        ];
    }
}
