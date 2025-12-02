<?php

namespace App\Services;

use App\DTOs\FamilyDropdownDTO;
use App\Repositories\Contracts\GenusRepositoryInterface;

class GenusService
{
    protected $genusRepo;

    public function __construct(GenusRepositoryInterface $genusRepo)
    {
        $this->genusRepo = $genusRepo;
    }

    public function getSelectedFamilyDTO($genus)
    {
        return new FamilyDropdownDTO(
            $genus->family->id,
            $genus->family->name
        );
    }
}
