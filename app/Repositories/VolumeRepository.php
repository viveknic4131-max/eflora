<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Volume;
use App\Repositories\Contracts\VolumeRepositoryInterface;

class VolumeRepository implements VolumeRepositoryInterface
{
    // Example:
    // public function all() {}
    public function getAllVolumes(int $perPage)
    {

        return Volume::orderby('id', 'DESC')->paginate($perPage);
    }


    public function store($request)
    {
        return DB::transaction(function () use ($request) {

            return Volume::create([
                'volume_code' => Str::uuid(),
                'volume'      => $request->volume,
                'name'        => $request->volume_name,
                'description' => $request->description,
                'type'        => $request->volume_type,
            ]);
        });
    }



    public function find($id)
    {
        return Volume::findOrFail($id);
    }

    public function update($id, $request)
    {
        DB::beginTransaction();

        try {

            $volume = Volume::findOrFail($id);

            $volume->update([
                'volume'      => $request->volume,
                'name'        => $request->volume_name,
                'description' => $request->description,
                'type'        => $request->volume_type,
            ]);

            DB::commit();
            return $volume;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $volume = Volume::findOrFail($id);
            $volume->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    // public function getVolumesByType(bool $type, int $perPage = 50)
    // {
    //     return Volume::where('type', $type)->orderBy('name', 'asc')->paginate($perPage);
    // }
    public function getVolumesByType(bool $type, ?string $letter = null, int $perPage = 50)
{

    return Volume::when($type !== null, function ($q) use ($type) {
            $q->where('type', $type);
        })
        ->when($letter, function ($q) use ($letter) {
            $q->where('name', 'LIKE', Str::lower($letter). '%');
        })
        ->orderBy('name', 'asc')
        ->paginate($perPage);
}

}
