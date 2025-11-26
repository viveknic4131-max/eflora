<?php

namespace App\Repositories;

use App\Models\Species;
use App\Repositories\Contracts\SpeciesRepositoryInterface;

class SpeciesRepository implements SpeciesRepositoryInterface
{
    public function search(string $keyword, array $familyIds)
    {
        return Species::with(['family','genus','images'])
            ->whereIn('family_id', $familyIds)
            ->where('name', 'LIKE', $keyword.'%')
            ->get();
    }
}
