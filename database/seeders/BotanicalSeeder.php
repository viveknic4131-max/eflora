<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Family, Volume, Genus, Species, SpeciesImage, FamilyVolumes};
use Illuminate\Support\Facades\Storage;

class BotanicalSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🧬 Creating fake data...');

        Storage::disk('public')->makeDirectory('plants');

        // 1️⃣ Families
        $this->command->info('→ Seeding families...');
        Family::factory()->count(2000)->create();

        // 2️⃣ Volumes
        $this->command->info('→ Seeding volumes...');
        Volume::factory()->count(2000)->create();

        // 3️⃣ Genera
        $this->command->info('→ Seeding genera...');
        Genus::factory()->count(2000)->create();

        // 4️⃣ Species
        $this->command->info('→ Seeding species...');
        Species::factory()->count(2000)->create();

        // 5️⃣ Species Images
        $this->command->info('→ Generating species images...');
        Species::all()->each(function ($species) {
            $filename = 'species_' . $species->id . '.jpg';
            $path = 'plants/' . $filename;

            if (!Storage::disk('public')->exists($path)) {
                $img = imagecreatetruecolor(400, 300);
                $bg = imagecolorallocate($img, rand(100, 255), rand(100, 255), rand(100, 255));
                imagefill($img, 0, 0, $bg);

                ob_start();
                imagejpeg($img);
                $imgData = ob_get_clean();

                Storage::disk('public')->put($path, $imgData);
                imagedestroy($img);
            }


            SpeciesImage::create([
                'species_id' => $species->id,
                'pic' => $filename,
            ]);
        });

        // 6️⃣ Family-Volume links
        $this->command->info('→ Seeding family-volume relationships...');
        FamilyVolumes::factory()->count(2000)->create();

        $this->command->info('✅ Botanical seeding complete!');
    }
}
