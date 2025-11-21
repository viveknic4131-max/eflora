<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Genus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class GenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $perPage = $request->get('perPage', 50);
        $genus = Genus::with('family')->orderBy('id', 'desc')->paginate($perPage);
        // dd($genus);

        return view('pages.genera.index', compact('genus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
   return view('pages.genera.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'genus' => 'required|string|max:255|unique:genera,name',
        'family_id' => 'required|exists:families,id',
        'description' => 'nullable|string',
    ]);

    Genus::create([
        'genus_code' => Str::uuid(),
        'name'       => $request->genus,
        'description'=> $request->description,
        'family_id'  => $request->family_id,
        'volume_id'  => 0,
    ]);

    return redirect()->route('genera.index')->with('success', 'Genus created successfully.');
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

    public function ajaxByFamily(Request $request)
{
    $familyId = $request->family_id;

    $genera = Genus::where('family_id', $familyId)
                ->select('id', 'name')
                ->get();

    return response()->json($genera);
}

}
