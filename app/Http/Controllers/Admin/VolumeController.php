<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\FamilyVolumes;
use App\Models\Volume;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VolumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $perPage = $request->get('perPage', 2);
        $families = Volume::orderBy('id', 'desc')->paginate($perPage);
        return view('pages.volume.index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.volume.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'volume_name' => 'required|string|max:255|unique:families,name',
            'description' => 'required',
            'volume_type' => 'required',
            'volume' => 'required',
        ]);
        Volume::create([
            'volume_code' => Str::uuid(),
            'volume' => $request->volume,
            'name' => $request->volume_name,
            'description' => $request->description,
            'type' => $request->volume_type,
        ]);


        return redirect()->route('volume.index')->with('success', 'Volume created successfully.');
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

    public function assignVolumeFamily()
    {

        $families=FamilyVolumes::paginate(10);
        return view('pages.volume_family_assign.index', compact('families'));
    }

    public function createVolumeFamily()
    {
        $volumes=Volume::all();
        $families=Family::all();
        return view('pages.volume_family_assign.create', compact('volumes', 'families'));
    }
    public function searchVolumes(Request $request)
{
    $search = $request->get('q', '');
    $volumes = Volume::query()
        ->where('name', 'like', "%{$search}%")
        ->select('id', 'name')
        ->limit(20)
        ->get();

    return response()->json($volumes);
}

}
