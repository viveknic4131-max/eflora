<?php

namespace App\Repositories\Contracts;

interface FamilyRepositoryInterface
{
    public function search(string $keyword, array $volumeIds);
     public function searchByName(string $name);

    public function getAllFamilies(int $perPage);
    public function find($id);
    public function update($id, $data);
    public function delete($id);
    public function store($request);
}
