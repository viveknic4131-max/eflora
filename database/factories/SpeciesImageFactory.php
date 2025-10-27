<?php

namespace Database\Factories;
use App\Models\Species;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpeciesImage>
 */
class SpeciesImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $species = Species::inRandomOrder()->first() ?? Species::factory()->create();

        // Generate fake image
        $filename = 'species_' . $species->id . '.jpg';
        $path = 'plants/' . $filename;

        Storage::disk('public')->makeDirectory('plants');
        if (!Storage::disk('public')->exists($path)) {
            // create placeholder image (fast)
            Storage::disk('public')->put($path, file_get_contents('https://picsum.photos/400/300'));
        }

        return [
            'species_id' => $species->id,
            'pic' => $filename,
        ];
    }
}
