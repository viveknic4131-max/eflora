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
        $bsiVolume = Volume::where('type', false)->paginate(5);
        $floraofIndia = Volume::where('type', true)->paginate(5);

        return view('theme.home', compact('bsiVolume', 'floraofIndia'));
        // return view('theme.home');
    }

    public function getBsiVolume(Request $request)
    {
        $bsiVolume = Volume::where('type', false)->paginate(5);

        if ($request->ajax()) {
            return view('theme.components.bsi_volume', compact('bsiVolume'))->render();
        }
    }

    // Flora of India AJAX
    public function getFloraOfIndia(Request $request)
    {
        $floraofIndia = Volume::where('type', true)->paginate(5);

        if ($request->ajax()) {
            return view('theme.components.flora_of_india', compact('floraofIndia'))->render();
        }
    }


    // public function search(Request $request)
    // {
    //     // dd(url('/'));
    //     // dd($request->all());
    //   dd(  explode(',',$request->q,-1));

    //      $validated = $request->validate([
    //         'plant_type' => 'required|in:flora_india,checklist',
    //         'q' => 'required|string|max:255',
    //     ]);
    //     $keyword = $request->q;
    //     $searchType = $request->plant_type;

    //     // if($request->plant_type ==='flora_india'){
    //     //     dd('flora of india');
    //     // }
    //     // if($request->plant_type ==='checklist'){
    //     //     dd('checklist');
    //     // }
    //     $keyword = $request->q;
    //     $searchType = $request->plant_type;

    //     $families = Family::where('name', 'LIKE', "%{$keyword}%")->get();
    //     $genus = Genus::with('family')->where('name', 'LIKE', "%{$keyword}%")->get();
    //     $species = Species::with('images', 'family', 'genus')->where('name', 'LIKE', "%{$keyword}%")->get();
    //     $data = collect()
    //         ->merge($families->map(fn($f) => [
    //             'type' => 'Family',
    //             'name' => $f->name,
    //             'details' => $f->description,
    //             'id' => $f->family_code
    //         ]))
    //         ->merge($genus->map(fn($g) => [
    //             'type' => 'Genus',
    //             'name' => $g->name,
    //             'details' => $g->description . ' ' . $g->family->name,
    //             'id' => $g->genus_code
    //         ]))
    //         ->merge($species->map(fn($s) => [
    //             'type' => 'Species',
    //             'name' => $s->name,
    //             'details' => $s->family->name . ' ' . $s->genus->name . ' ' . $s->author . ' ' . $s->volume . ' ' . $s->page . ' ' . $s->year_described . ' ' . $s->publication,
    //             'id' => $s->species_code,
    //             'images' => $s->images->pluck('pic')->first()
    //         ]));

    //     // dd($data->toArray());
    //     return view('theme.searchlist', compact('data', 'keyword','searchType'));

    //     // return view('theme.searchlist', compact('data'));
    // }

    public function search(Request $request)
    {

        // 🔹 Validate request
        $validated = $request->validate([
            'plant_type' => 'required|in:flora_india,checklist',
            'q' => 'required|string|max:255',
        ]);

        $keyword = trim($request->q);
        $searchType = $request->plant_type;

        // 🔹 Volume type: 1 = flora_india, 0 = checklist
        $volumeType = $searchType === 'flora_india' ? 1 : 0;

        // 🔹 Get all volume IDs of that type
        $volumeIds = Volume::where('type', $volumeType)->pluck('id');
        // dd(in_array(1,$volumeIds->toArray()));
        // 🔹 Get all family IDs related to those volumes
        $familyIds = FamilyVolumes::whereIn('volume_id', $volumeIds)
            ->pluck('family_id')
            ->unique();


        $families = Family::whereIn('id', $familyIds)
            ->where('name', 'LIKE', "%{$keyword}%")
            ->get();
        // dd($families);
        $genus = Genus::with('family')
            ->whereIn('family_id', $familyIds)
            ->where('name', 'LIKE', "%{$keyword}%")
            ->get();

        $species = Species::with(['images', 'family', 'genus'])
            ->whereIn('family_id', $familyIds)
            ->where('name', 'LIKE', "%{$keyword}%")
            ->get();

        // 🔹 Combine all results into one collection
        $combined = collect()
            ->merge($families->map(fn($f) => [
                'type' => 'Family',
                'name' => $f->name,
                'details' => $f->description,
                'id' => $f->family_code,
                'images' => null
            ]))
            ->merge($genus->map(fn($g) => [
                'type' => 'Genus',
                'name' => $g->name,
                'details' => ($g->description ?? '') . ' (' . ($g->family->name ?? '') . ')',
                'id' => $g->genus_code,
                'images' => null
            ]))
            ->merge($species->map(fn($s) => [
                'type' => 'Species',
                'name' => $s->name,
                'details' => implode(' ', array_filter([
                    $s->family->name ?? '',
                    $s->genus->name ?? '',
                    $s->author,
                    $s->volume,
                    $s->page,
                    $s->year_described,
                    $s->publication
                ])),
                'id' => $s->species_code,
                'images' => $s->images->pluck('pic')->first()
            ]));

        // 🔹 Manual Pagination (since we merged collections)
        $perPage = 10;
        $page = request()->get('page', 1);
        $pagedData = $combined->forPage($page, $perPage);

        // Create LengthAwarePaginator instance


        $data = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData,
            $combined->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        //  dd($keyword );
        // 🔹 Return view
        return view('theme.searchlist', compact('data', 'keyword', 'searchType'));
    }


    // public function search(Request $request)
    // {

    //     $validated = $request->validate([
    //         'plant_type' => 'required|in:flora_india,checklist',
    //         'q' => 'required|string|max:255',
    //     ]);
    //     $keyword = $request->q;
    //     $searchType = $request->plant_type;

    //     $families = Family::where('name', 'LIKE', "%{$keyword}%")
    //         ->paginate(12, ['*'], 'families_page');

    //     $genus = Genus::with('family')
    //         ->where('name', 'LIKE', "%{$keyword}%")
    //         ->paginate(12, ['*'], 'genus_page');

    //     $species = Species::with('images', 'family', 'genus')
    //         ->where('name', 'LIKE', "%{$keyword}%")
    //         ->paginate(12, ['*'], 'species_page');

    //     return view('theme.searchlist', compact('families', 'genus', 'species', 'keyword', 'searchType'));
    // }


    public function suggest(Request $request)
    {
        $type = $request->get('plant_type');
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

    // public function getFamilyOrVolume(Request $request)
    // {
    //     // ✅ Case 1: User clicked a Volume
    //     if ($request->filled('volume')) {
    //         $volumeCode = trim($request->volume);
    //         $volume = Volume::where('volume_code', $volumeCode)->firstOrFail();
    //         $familyIds = FamilyVolumes::where('volume_id', $volume->id)->pluck('family_id')->toArray();
    //         // Fetch families in this volume
    //         // $families = Family::where('volume_id', $volume->id)->get();
    //         $families = Family::whereIn('id', $familyIds)->get();

    //         // If only one family in this volume → redirect directly to it
    //         if ($families->count() === 1) {
    //             return redirect()->route('get.family', ['family' => $families->first()->family_code]);
    //         }

    //         // Otherwise, show families list in "volume mode"
    //         return view('theme.family-view', [
    //             'mode' => 'volume',
    //             'volume' => $volume,
    //             'families' => $families
    //         ]);
    //     }

    //     // ✅ Case 2: User clicked a Family
    //     $request->validate([
    //         'family' => 'required|string'
    //     ]);

    //     $familyCode = trim($request->family);
    //     $family = Family::where('family_code', $familyCode)->firstOrFail();

    //     $genusQuery = Genus::where('family_id', $family->id);
    //     $speciesQuery = Species::whereHas('genus', fn($q) => $q->where('family_id', $family->id));

    //     // Filters
    //     if ($request->filled('genus_search')) {
    //         $genusQuery->where('name', 'like', '%' . $request->genus_search . '%');
    //         $speciesQuery->whereHas('genus', fn($q) => $q
    //             ->where('family_id', $family->id)
    //             ->where('name', 'like', '%' . $request->genus_search . '%'));
    //     }

    //     if ($request->filled('species_search')) {
    //         $speciesQuery->where('name', 'like', '%' . $request->species_search . '%');
    //     }

    //     $genusList = $genusQuery->paginate(10);
    //     $speciesList = $speciesQuery->paginate(10);

    //     return view('theme.family-view', [
    //         'mode' => 'family',
    //         'family' => $family,
    //         'genusList' => $genusList,
    //         'speciesList' => $speciesList
    //     ]);
    // }

    public function getFamilyOrVolume(Request $request)
    {
        // ✅ If viewing a Volume
        if ($request->filled('volume')) {
            $volumeCode = trim($request->volume);
            $volume = Volume::where('volume_code', $volumeCode)->firstOrFail();

            $familyIds = FamilyVolumes::where('volume_id', $volume->id)->pluck('family_id');
            $families = Family::whereIn('id', $familyIds)->get();

            return view('theme.family-view', [
                'mode' => 'volume',
                'volume' => $volume,
                'families' => $families,
            ]);
        }

        // ✅ If viewing a Family
        $family = Family::where('family_code', $request->family)->firstOrFail();

        $genusQuery = Genus::where('family_id', $family->id);
        $speciesQuery = Species::whereHas('genus', fn($q) => $q->where('family_id', $family->id));

        $selectedGenus = null;

        // ✅ If user clicked a specific genus
        if ($request->filled('genus')) {
            $selectedGenus = Genus::where('genus_code', $request->genus)
                ->where('family_id', $family->id)
                ->firstOrFail();

            // only load species from this genus
            $speciesQuery->where('genus_id', $selectedGenus->id);
        }

        // ✅ Handle search filters
        if ($request->filled('genus_search')) {
            $genusQuery->where('name', 'like', '%' . $request->genus_search . '%');
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
            'speciesList' => $speciesList,
            'selectedGenus' => $selectedGenus,
        ]);
    }





    public function getGenus(Request $request)
    {

        $request->validate([
            'genus' => 'required|string',
        ]);

        $genusCode = trim($request->genus);
        $genus = Genus::where('genus_code', $genusCode)->firstOrFail();

        // Since one genus belongs to a single family
        $family = Family::findOrFail($genus->family_id);

        // Fetch species that belong to this genus
        $speciesList = Species::where('genus_id', $genus->id)->paginate(10);

        return view('theme.family-view', [
            'mode' => 'genus',
            'family' => $family,
            'genus' => $genus,
            'speciesList' => $speciesList,
        ]);
    }

    public function getSpecies(Request $request)
    {
        $species = Species::with(['genus', 'family', 'images'])->where('species_code', $request->species)->firstOrFail();

        return view('theme.species-details', compact('species'));
    }
}
