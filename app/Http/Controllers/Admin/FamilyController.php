<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FamilyRequest;
use App\Models\Family;
use App\Repositories\Contracts\FamilyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(FamilyRepositoryInterface $familyRepository)
    {
        $this->familyRepository = $familyRepository;
    }


    public function index(Request $request)

    {

        $perPage = $request->get('perPage', 50);
        $families = $this->familyRepository->getAllFamilies($perPage);;

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
    public function store(FamilyRequest $request)
    {


        try {
            $this->familyRepository->store($request);

            return redirect()
                ->route('family.index')
                ->with('success', 'Family created successfully.');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('error', 'Something went wrong while creating Family.');
        }
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required|string|max:255|unique:families,name',
        //     'description' => 'required',
        // ]);
        // Family::create([
        //     'family_code' => Str::uuid(),
        //     'name' => $request->name,
        //     'description' => $request->description,
        // ]);


        // return redirect()->route('family.index')->with('success', 'Family created successfully.');
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
        $family = $this->familyRepository->find($id);

        return view('pages.family.create', compact('family'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FamilyRequest $request, string $id)
    {
       try {
            $this->familyRepository->update($id, $request);

            return redirect()
                ->route('family.index')
                ->with('success', 'Family updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update Family.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->familyRepository->delete($id);

            return redirect()
                ->route('family.index')
                ->with('success', 'Family deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete Family.');
        }
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
