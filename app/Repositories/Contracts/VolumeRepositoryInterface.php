<?php

namespace App\Repositories\Contracts;

interface VolumeRepositoryInterface
{
    // public function search(string $keyword, array $volumeIds);

    public function getAllVolumes(int $perPage);
    public function find($id);
    public function update($id, $data);
    public function delete($id);
    public function store($request);
}
