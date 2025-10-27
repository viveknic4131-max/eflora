<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $perPage = $request->get('perPage', 50);
        $families = Family::orderBy('id', 'desc')->paginate($perPage);
        return view('pages.family.index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.family.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255|unique:families,name',
            'description' => 'required',
        ]);
        Family::create([
            'family_code' => Str::uuid(),
            'name' => $request->name,
            'description' => $request->description,
        ]);


        return redirect()->route('family.index')->with('success', 'Family created successfully.');
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

    public function searchFamilies(Request $request)
{
    $search = $request->get('q', '');
    $families = Family::query()
        ->where('name', 'like', "%{$search}%")
        ->select('id', 'name')
        ->limit(20)
        ->get();

    return response()->json($families);
}

}
