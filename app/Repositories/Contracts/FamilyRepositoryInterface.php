<?php

namespace App\Repositories\Contracts;

interface FamilyRepositoryInterface
{
    public function search(string $keyword, array $volumeIds);
}
