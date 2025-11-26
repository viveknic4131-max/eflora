<?php

namespace App\Repositories\Contracts;

interface GenusRepositoryInterface
{
    public function search(string $keyword, array $familyIds);
}
