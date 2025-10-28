<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Genus;
use App\Models\Species;
use App\Models\Volume;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $bsiVolume = Volume::where('type', false)->get();
        $floraofIndia = Volume::where('type', true)->get();

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


   public function getFamily(Request $request)
{
    $family = Family::findOrFail($request->family);


    $genusQuery = Genus::where('family_id', $family->id);
    $speciesQuery = Species::whereHas('genus', function ($q) use ($family) {
        $q->where('family_id', $family->id);
    });

    if ($request->has('genus_search')) {
        $genusQuery->where('name', 'like', '%' . $request->genus_search . '%');
    }

    if ($request->has('species_search')) {
        $speciesQuery->where('name', 'like', '%' . $request->species_search . '%');
    }

    $genusList = $genusQuery->get();
    $speciesList = $speciesQuery->get();

    return view('theme.family-view', compact('family', 'genusList', 'speciesList'));
}


    public function getGenus(Request $request) {}

    public function getSpecies(Request $request) {}
}
