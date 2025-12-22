<?php

namespace App\Repositories\Contracts;

interface GenusRepositoryInterface
{

    public function find($id);
    public function update($id, $data);
    public function delete($id);
    public function store($request);

    public function search(string $keyword, array $familyIds);
     public function searchByName(string $name);
    public function getAllGenus(int $perPage);

    public function getGenusByFamilyIds(array $request);
    public function getGenusByFamilyId(int $request);
}
