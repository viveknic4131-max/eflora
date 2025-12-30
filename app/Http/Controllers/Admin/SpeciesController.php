<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpeciesRequest;
use App\Models\Species;
use App\Models\SpeciesImage;
use App\Models\SpeciesSynonym;
use App\Models\State;
use App\Repositories\Contracts\SpeciesRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(SpeciesRepositoryInterface $speciesRepository)
    {
        $this->speciesRepository = $speciesRepository;
    }
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 50);
        $species = $this->speciesRepository->getAllSpecies($perPage);;

        return view('pages.species.index', compact('species'));
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
    public function store(SpeciesRequest $request)
    {

        // dd($request->all());
        try {
            $species =    $this->speciesRepository->store($request);

            // dd($species->id);

            // return redirect()
            //     ->route('species.index')
            //     ->with('success', 'Species created successfully.');

            return response()->json([
                'success' => true,
                'species_id' => $species->id
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'message' => 'Something went wrong while creating species.'
            ]);

            // return redirect()
            //     ->back()
            //     ->with('error', 'Something went wrong while creating species.');
        }
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
        $species = $this->speciesRepository->find($id);
        return view('pages.species.create', compact('species'));
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
        try {
            $this->speciesRepository->delete($id);

            return redirect()
                ->route('species.index')
                ->with('success', 'Species deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete Species.');
        }
    }


    public function synonyms(Request $request)
    {

        // dd($request->all());

       try {
            $synonyms = $this->speciesRepository->addSynonyms($request);

            return response()->json([
                'success' => true,
                'message' => 'Synonyms added successfully.'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'message' => 'Something went wrong while adding synonyms.'
            ]);
        }
    }


    public function getStateList(Request $request)
    {
        $search = $request->get('q', '');
        $states = State::query()
            ->where('name', 'like', "%{$search}%")
            ->select('id', 'name')
            ->limit(20)
            ->get();

        return response()->json($states);
    }
}
