<?php

namespace App\Repositories;

use App\Models\Species;
use App\Models\SpeciesImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Repositories\Contracts\SpeciesRepositoryInterface;

class SpeciesRepository implements SpeciesRepositoryInterface
{
    public function search(string $keyword, array $familyIds)
    {
        return Species::with(['family', 'genus', 'images'])
            ->whereIn('family_id', $familyIds)
            ->where('name', 'LIKE', $keyword . '%')
            ->get();
    }


    public function getAllSpecies(int $perPage)
    {
        return Species::with(['family', 'genus', 'images'])->orderBy('id', 'desc')->paginate($perPage);
    }

    public function find($id)
    {
        return Species::findOrFail($id);
    }

    public function update($id, $request) {}

    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $genus = Species::findOrFail($id);
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
        return DB::transaction(function () use ($request) {


            $species = Species::create([
                'species_code'   => Str::uuid(),
                'name'           => $request->species,
                'description'    => $request->description,
                'genus_id'       => $request->genus_id,
                'family_id'      => $request->family_id,
                'author'         => $request->author,
                'publication'    => $request->publication,
                'year_described' => $request->year_described,
                'volume'         => $request->volume,
                'page'           => $request->page,
                'common_name'    => $request->common_name,
                'synonyms'       => $request->synonyms ? json_encode($request->synonyms) : null,
            ]);


            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('plants', $filename, 'public');
                    SpeciesImage::create([
                        'species_id' => $species->id,
                        'pic'        => $filename
                    ]);
                }
            }

            return $species;
        });
    }
}
