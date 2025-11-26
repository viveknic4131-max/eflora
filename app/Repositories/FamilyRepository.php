<?php

namespace App\Repositories;

use App\Models\Family;
use App\Repositories\Contracts\FamilyRepositoryInterface;

class FamilyRepository implements FamilyRepositoryInterface
{
    public function search(string $keyword, array $volumeIds)
    {
        return Family::whereIn('id', $volumeIds)
            ->where('name', 'LIKE', '%'.$keyword.'%')
            ->get();
    }
}
