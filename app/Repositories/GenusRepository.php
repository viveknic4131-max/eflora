<?php

namespace App\Repositories;

use App\Models\Genus;
use App\Repositories\Contracts\GenusRepositoryInterface;

class GenusRepository implements GenusRepositoryInterface
{
    public function search(string $keyword, array $familyIds)
    {
        return Genus::with('family')
            ->whereIn('family_id', $familyIds)
            ->where('name', 'LIKE', $keyword.'%')
            ->get();
    }
}
