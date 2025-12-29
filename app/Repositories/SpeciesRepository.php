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

    public function searchByName(string $name)
    {
        return Species::where('name', 'LIKE', '%' . $name . '%')
            ->first();
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

        // dd($request->all());
        return DB::transaction(function () use ($request) {
            $is_infra = false;
            $infra_values = null;
            // $is_in = false;
            $in_author = null;

            $states = null;

            if ($request->filled('states') && is_array($request->states)) {
                $states = array_values(
                    array_map(
                        'intval',
                        array_filter($request->states, fn($v) => $v !== null && $v !== '')
                    )
                );
            }

            if (isset($request->rank) && isset($request->taxon_name) && !empty($request->rank) && !empty($request->taxon_name)) {
                // dd($request->rank);
                $is_infra = true;
                $infra_values = json_encode([
                    'rank' => $request->rank,
                    'taxon_name' => $request->taxon_name
                ]);
            }


            if (isset($request->in_author_1)  && !empty($request->in_author_1)) {
                // dd($request->rank);

                // $is_in = true;
                // $is_infra = true;
                $in_author =  $request->in_author_1;
            }
            // dd('there');
            $species = Species::create([
                'species_code'   => Str::uuid(),
                'name'           => $request->species,
                // 'description'    => $request->description,
                'genus_id'       => $request->genus_id,
                'family_id'      => $request->family_id,
                'author'         => $request->author,
                'publication'    => $request->publication,
                'year_described' => $request->year_described,
                'volume'         => $request->volume,
                'page'           => $request->page,
                // 'common_name'    => $request->common_name,
                // 'synonyms'       => $request->synonyms ? json_encode($request->synonyms) : null,
                'is_infra'       => $is_infra,
                'infra_values'   => $infra_values,
                // 'is_in'          => $is_in,
                'in_author'      => $in_author,
                'state_ids'      => $states,
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
