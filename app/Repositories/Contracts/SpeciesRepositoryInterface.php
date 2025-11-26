<?php

namespace App\Repositories\Contracts;

interface SpeciesRepositoryInterface
{
    public function search(string $keyword, array $familyIds);
}
