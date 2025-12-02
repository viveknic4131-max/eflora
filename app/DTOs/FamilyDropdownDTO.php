<?php

namespace App\DTOs;

class FamilyDropdownDTO
{
    public function __construct(
         public int $id,
        public string $name
    ) {}
}
