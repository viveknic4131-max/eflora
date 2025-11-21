<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Species;
use App\Models\SpeciesImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 50);
        $genus = Species::with(['family', 'genus'])->orderBy('id', 'desc')->paginate($perPage);
        // dd($genus);

        return view('pages.species.index', compact('genus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.species.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->synonyms);

        $validated = $request->validate([
            'family_id'       => 'required|exists:families,id',
            'genus_id'        => 'required|exists:genera,id',
            'genus'           => 'required|string|max:255',
            'description'     => 'required|string',
            'author'          => 'required|string|max:255',
            'publication'     => 'required|string|max:255',
            'year_described'  => 'required|string|max:50',
            'volume'          => 'required|string|max:100',
            'page'            => 'required|string|max:100',
            'common_name'     => 'nullable|string|max:255',

            'synonyms'        => 'nullable|array',
            // 'synonyms.*'      => 'nullable|string|max:255',

            'images'          => 'nullable|array',
            'images.*'        => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

// dd();

        $species = Species::create([
             'species_code' => Str::uuid(),
            'family_id'      => $validated['family_id'],
            'genus_id'       => $validated['genus_id'],
            'name'           => $validated['genus'],
            'description'    => $validated['description'],
            'author'         => $validated['author'],
            'publication'    => $validated['publication'],
            'year_described' => $validated['year_described'],
            'volume'         => $validated['volume'],
            'page'           => $validated['page'],
            'common_name'    => $validated['common_name'] ?? null,
            'synonyms'       => json_encode( $validated['synonyms']) ?? [],
        ]);


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

             $image->storeAs('plants', $filename, 'public');
// dd(  $image->storeAs('public/plants', $filename));
                SpeciesImage::create([
                    'species_id' => $species->id,
                    'pic' => $filename
                ]);
            }
        }

        return redirect()->route('species.index')->with('status', 'Species added successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
