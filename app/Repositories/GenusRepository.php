<?php

namespace App\Repositories;

use App\Models\Genus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Repositories\Contracts\GenusRepositoryInterface;

class GenusRepository implements GenusRepositoryInterface
{
    public function search(string $keyword, array $familyIds)
    {
        return Genus::with('family')
            ->whereIn('family_id', $familyIds)
            ->where('name', 'LIKE', $keyword . '%')
            ->get();
    }

    public function getAllGenus(int $perPage)
    {
        return Genus::with('family')->orderBy('id', 'desc')->paginate($perPage);
    }

    public function find($id)
    {
        return Genus::findOrFail($id);
    }

    public function update($id, $request)
    {
        DB::beginTransaction();

        try {

            $genus = Genus::findOrFail($id);
            $genus->update([
                'name'        => $request->genus,
                'description' => $request->description,
                'family_id'   => $request->family_id,

            ]);

            DB::commit();
            return $genus;
        } catch (\Exception $e) {

            DB::rollBack();
            // return $e->getMessage();
            throw $e;
        }
    }

    public function delete($id)
    {

        DB::beginTransaction();

        try {

            $genus = Genus::findOrFail($id);
            $genus->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            //   return true;
            throw $e;
        }
    }
    public function store($request)
    {

        // dd($request);
        return DB::transaction(function () use ($request) {

            return Genus::create([
                'genus_code' => Str::uuid(),
                'name'      => $request->genus,
                'family_id'   => $request->family_id,
                'description' => $request->description,
                'volume_id'   => 0,
            ]);
        });
       
    }

    public function getGenusByFamilyIds(array $familyIds)
    {
        return Genus::whereIn('family_id', $familyIds)->get();
    }

     public function getGenusByFamilyId(int $familyId)
    {
        return Genus::select('id', 'name')->where('family_id', $familyId)->get();
    }
}
