<?php

namespace App\Services;

use App\Repositories\Contracts\FamilyRepositoryInterface;
use App\Repositories\Contracts\GenusRepositoryInterface;
use App\Repositories\Contracts\SpeciesRepositoryInterface;
use App\DTOs\SearchDTO;
use App\Models\Family;
use App\Models\FamilyVolumes;
use App\Models\Genus;
use App\Models\Species;
use App\Models\Volume;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SearchService
{
    public function __construct(
        protected FamilyRepositoryInterface $familyRepo,
        protected GenusRepositoryInterface $genusRepo,
        protected SpeciesRepositoryInterface $speciesRepo
    ) {}

    public function search(string $plantType, string $keyword, int $page = 1, int $perPage = 10): LengthAwarePaginator
    {

        $keyword = trim($keyword);

        $volumeType = $plantType === 'flora_india' ? 1 : 0;
        $volumeIds = Volume::where('type', $volumeType)->pluck('id');



        $familyIds = FamilyVolumes::whereIn('volume_id', $volumeIds)
            ->pluck('family_id')->unique();

        $families = $this->familyRepo->search($keyword, $volumeIds->toArray());

        $genus = $this->genusRepo->search($keyword, $familyIds->toArray());

        $species = $this->speciesRepo->search($keyword, $familyIds->toArray());
        //

        // if (count($species) === 0 || count($genus) === 0 || count($families) === 0) {
        //     $families = $this->familyRepo->searchByName($keyword);

        //     $genus = $this->genusRepo->searchByName($keyword);

        //     $species = $this->speciesRepo->searchByName($keyword);
        // }

        // later solve this issue

        $combined = collect()
            ->merge($families->map(fn($f) => new SearchDTO('Family', $f->name, $f->family_code, $f->description)))
            ->merge($genus->map(fn($g) => new SearchDTO('Genus', $g->name, $g->genus_code, ($g->description ?? '') . ' (' . ($g->family->name ?? '') . ')')))
            ->merge($species->map(fn($s) => new SearchDTO('Species', $s->name, $s->species_code, implode(' ', array_filter([$s->family->name ?? '', $s->genus->name ?? '', $s->author, $s->volume, $s->page, $s->year_described, $s->publication])), $s->images->pluck('pic')->first())));

        $pagedData = $combined->forPage($page, $perPage);

        return new LengthAwarePaginator(
            $pagedData->map->toArray(),
            $combined->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    public function suggest(string $keyword, ?string $plantType = null): array
    {
        // dd($keyword);

        $families = Family::where('name', 'LIKE', "%{$keyword}%")
            ->take(5)
            ->get(['id', 'name']);

        $genus = Genus::where('name', 'LIKE', "%{$keyword}%")
            ->take(5)
            ->get(['id', 'name']);

        $species = Species::where('name', 'LIKE', "%{$keyword}%")
            ->take(5)
            ->get(['id', 'name']);

        // $families = Family::where('name', 'LIKE', $keyword . '%')->take(5)->get(['id', 'name']);

        // $genus = Genus::where('name', 'LIKE', $keyword . '%')->take(5)->get(['id', 'name']);

        // $species = Species::where('name', 'LIKE', $keyword . '%')->take(5)->get(['id', 'name']);

        return [
            'Family' => $families,
            'Genus' => $genus,
            'Species' => $species
        ];
    }
}
