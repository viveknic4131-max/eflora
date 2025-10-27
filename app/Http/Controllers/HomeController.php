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
        $bsiVolume =Volume::where('type', false)->get();
        $floraofIndia = Volume::where('type', true)->get();

        return view('theme.home', compact('bsiVolume', 'floraofIndia'));
    }


    public function search(Request $request)
    {
        $keyword = $request->get('q');

        $families = Family::where('name', 'LIKE', "%{$keyword}%")->get();
        $genus = Genus::where('name', 'LIKE', "%{$keyword}%")->get();
        $species = Species::with('images')->where('name', 'LIKE', "%{$keyword}%")->get();

        $data = collect()
            ->merge($families->map(fn($f) => [
                'type' => 'Family',
                'name' => $f->name,
                'id' => $f->id
            ]))
            ->merge($genus->map(fn($g) => [
                'type' => 'Genus',
                'name' => $g->name,
                'id' => $g->id
            ]))
            ->merge($species->map(fn($s) => [
                'type' => 'Species',
                'name' => $s->name,
                'id' => $s->id,
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
}
