<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Family;
use App\Repositories\Contracts\FamilyRepositoryInterface;

class FamilyRepository implements FamilyRepositoryInterface
{
    public function search(string $keyword, array $volumeIds)
    {
        return Family::whereIn('id', $volumeIds)
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    public function getAllFamilies(int $perPage)
    {
        return Family::orderby('id', 'DESC')->paginate($perPage);
    }

    public function find($id)
    {
        return Family::findOrFail($id);
    }
    public function update($id, $request)
    {

        DB::beginTransaction();

        try {

            $family = Family::findOrFail($id);

            $family->update([
                'name'        => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();
            return $family;
        } catch (\Exception $e) {

            DB::rollBack();
            return $e->getMessage();
            // throw $e;
        }

    }
    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $family = Family::findOrFail($id);
            $family->delete();

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

        return DB::transaction(function () use ($request) {

            return Family::create([
                'family_code' => Str::uuid(),
                'name'      => $request->name,
                'description' => $request->description,
            ]);
        });

    }
}
