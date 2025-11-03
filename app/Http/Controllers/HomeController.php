<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyVolumes;
use App\Models\Genus;
use App\Models\Species;
use App\Models\Volume;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $bsiVolume = Volume::where('type', false)->paginate(25);
        $floraofIndia = Volume::where('type', true)->paginate(25);

        return view('theme.home', compact('bsiVolume', 'floraofIndia'));
    }


    public function search(Request $request)
    {
        // dd(url('/'));
        $keyword = $request->get('q');

        $families = Family::where('name', 'LIKE', "%{$keyword}%")->get();
        $genus = Genus::with('family')->where('name', 'LIKE', "%{$keyword}%")->get();
        $species = Species::with('images', 'family', 'genus')->where('name', 'LIKE', "%{$keyword}%")->get();
        $data = collect()
            ->merge($families->map(fn($f) => [
                'type' => 'Family',
                'name' => $f->name,
                'details' => $f->description,
                'id' => $f->family_code
            ]))
            ->merge($genus->map(fn($g) => [
                'type' => 'Genus',
                'name' => $g->name,
                'details' => $g->description . ' ' . $g->family->name,
                'id' => $g->genus_code
            ]))
            ->merge($species->map(fn($s) => [
                'type' => 'Species',
                'name' => $s->name,
                'details' => $s->family->name . ' ' . $s->genus->name . ' ' . $s->author . ' ' . $s->volume . ' ' . $s->page . ' ' . $s->year_described . ' ' . $s->publication,
                'id' => $s->species_code,
                'images' => $s->images->pluck('pic')->first()
            ]));

        // dd($data->toArray());
        return view('theme.searchlist', compact('data', 'keyword'));

        // return view('theme.searchlist', compact('data'));
    }
    public function suggest(Request $request)
    {
        $keyword = $request->get('q');

        $families = Family::where('name', 'LIKE', "%{$keyword}%")
            ->take(5)
            ->get(['id', 'name']);

        $genus = Genus::where('name', 'LIKE', "%{$keyword}%")
            ->take(5)
            ->get(['id', 'name']);

        $species = Species::where('name', 'LIKE', "%{$keyword}%")
            ->take(5)
            ->get(['id', 'name']);

        $suggestions = [
            'Family' => $families,
            'Genus' => $genus,
            'Species' => $species,
        ];

        return response()->json($suggestions);
    }


    //    public function getFamily(Request $request)
    // {
    //     // dd($request->all());
    //     $family = Family::where('family_code',$request->family)->firstOrFail();


    //     $genusQuery = Genus::where('family_id', $family->id);
    //     $speciesQuery = Species::whereHas('genus', function ($q) use ($family) {
    //         $q->where('family_id', $family->id);
    //     });

    //     if ($request->has('genus_search')) {
    //         $genusQuery->where('name', 'like', '%' . $request->genus_search . '%');
    //     }

    //     if ($request->has('species_search')) {
    //         $speciesQuery->where('name', 'like', '%' . $request->species_search . '%');
    //     }

    //     $genusList = $genusQuery->get();
    //     $speciesList = $speciesQuery->get();
    //     // dd($genusList);
    //     //

    //     return view('theme.family-view', compact('family', 'genusList', 'speciesList'));
    // }

    public function getFamily(Request $request)
    {
        $request->validate([
            'family' => 'required|string'
        ]);

        $familyCode = trim($request->family);

        // Find the family by family_code
        $family = Family::where('family_code', $familyCode)->firstOrFail();

        $genusQuery = Genus::where('family_id', $family->id);
        $speciesQuery = Species::whereHas('genus', function ($q) use ($family) {
            $q->where('family_id', $family->id);
        });

        if ($request->filled('genus_search')) {
            $genusQuery->where('name', 'like', '%' . $request->genus_search . '%');
            $speciesQuery->whereHas('genus', function ($q) use ($family, $request) {
                $q->where('family_id', $family->id)
                    ->where('name', 'like', '%' . $request->genus_search . '%');
            });
        }

        if ($request->filled('species_search')) {
            $speciesQuery->where('name', 'like', '%' . $request->species_search . '%');
        }

        $genusList = $genusQuery->paginate(10);
        $speciesList = $speciesQuery->paginate(10);

        return view('theme.family-view', compact('family', 'genusList', 'speciesList'));
    }

    public function getFamilyOrVolume(Request $request)
    {
        // ✅ Case 1: User clicked a Volume
        if ($request->filled('volume')) {
            $volumeCode = trim($request->volume);
            $volume = Volume::where('volume_code', $volumeCode)->firstOrFail();
            $familyIds = FamilyVolumes::where('volume_id', $volume->id)->pluck('family_id')->toArray();
            // Fetch families in this volume
            // $families = Family::where('volume_id', $volume->id)->get();
            $families = Family::whereIn('id', $familyIds)->get();

            // If only one family in this volume → redirect directly to it
            if ($families->count() === 1) {
                return redirect()->route('get.family', ['family' => $families->first()->family_code]);
            }

            // Otherwise, show families list in "volume mode"
            return view('theme.family-view', [
                'mode' => 'volume',
                'volume' => $volume,
                'families' => $families
            ]);
        }

        // ✅ Case 2: User clicked a Family
        $request->validate([
            'family' => 'required|string'
        ]);

        $familyCode = trim($request->family);
        $family = Family::where('family_code', $familyCode)->firstOrFail();

        $genusQuery = Genus::where('family_id', $family->id);
        $speciesQuery = Species::whereHas('genus', fn($q) => $q->where('family_id', $family->id));

        // Filters
        if ($request->filled('genus_search')) {
            $genusQuery->where('name', 'like', '%' . $request->genus_search . '%');
            $speciesQuery->whereHas('genus', fn($q) => $q
                ->where('family_id', $family->id)
                ->where('name', 'like', '%' . $request->genus_search . '%'));
        }

        if ($request->filled('species_search')) {
            $speciesQuery->where('name', 'like', '%' . $request->species_search . '%');
        }

        $genusList = $genusQuery->paginate(10);
        $speciesList = $speciesQuery->paginate(10);

        return view('theme.family-view', [
            'mode' => 'family',
            'family' => $family,
            'genusList' => $genusList,
            'speciesList' => $speciesList
        ]);
    }



    public function getGenus(Request $request) {}

    public function getSpecies(Request $request)
    {
        $species = Species::with(['genus', 'family', 'images'])->where('species_code', $request->species)->firstOrFail();

        return view('theme.species-details', compact('species'));
    }
}
