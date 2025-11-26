<?php

namespace App\Search;

use Illuminate\Database\Eloquent\Builder;
use App\Repositories\FamilyRepository;
use App\Repositories\GenusRepository;
use App\Repositories\SpeciesRepository;
use App\DTOs\SearchDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class FloraSearchSearch
{

    public function __construct(
        protected FamilyRepository $familyRepo,
        protected GenusRepository $genusRepo,
        protected SpeciesRepository $speciesRepo
    ) {}

    public function search(string $plantType, string $keyword, int $page = 1, int $perPage = 10): LengthAwarePaginator
    {
        $keyword = trim($keyword);

        $volumeType = $plantType === 'flora_india' ? 1 : 0;
        $volumeIds = \App\Models\Volume::where('type', $volumeType)->pluck('id');

        $familyIds = \App\Models\FamilyVolumes::whereIn('volume_id', $volumeIds)
            ->pluck('family_id')->unique();

        $families = $this->familyRepo->search($keyword, $familyIds);
        $genus = $this->genusRepo->search($keyword, $familyIds);
        $species = $this->speciesRepo->search($keyword, $familyIds);

        // Merge results
        $combined = collect()
            ->merge($families->map(fn($f) => new SearchDTO('Family', $f->name, $f->family_code, $f->description)))
            ->merge($genus->map(fn($g) => new SearchDTO('Genus', $g->name, $g->genus_code, $g->description . ' (' . ($g->family->name ?? '') . ')')))
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

    public function suggest(string $keyword): array
    {
        $families = \App\Models\Family::where('name', 'LIKE', $keyword.'%')->take(5)->get(['id','name']);
        $genus = \App\Models\Genus::where('name', 'LIKE', $keyword.'%')->take(5)->get(['id','name']);
        $species = \App\Models\Species::where('name', 'LIKE', $keyword.'%')->take(5)->get(['id','name']);

        return [
            'Family' => $families,
            'Genus' => $genus,
            'Species' => $species
        ];
    }
}
