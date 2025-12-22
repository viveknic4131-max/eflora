<?php

namespace App\Repositories\Contracts;

interface SpeciesRepositoryInterface
{
    public function search(string $keyword, array $familyIds);
 public function searchByName(string $name);
    public function find($id);
    public function update($id, $data);
    public function delete($id);
    public function store($request);

    public function getAllSpecies(int $perPage);
}
