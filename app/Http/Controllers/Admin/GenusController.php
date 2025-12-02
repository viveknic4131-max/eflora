<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenusRequest;
use App\Models\Genus;
use App\Repositories\Contracts\GenusRepositoryInterface;
use App\Services\GenusService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(GenusRepositoryInterface $genusRepository)
    {
        $this->genusRepository = $genusRepository;
    }

    public function index(Request $request)
    {


        $perPage = $request->get('perPage', 50);
        $genus = $this->genusRepository->getAllGenus($perPage);;

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
    public function store(GenusRequest $request)
    {
        // dd($request->all());
        try {
            $this->genusRepository->store($request);

            return redirect()
                ->route('genera.index')
                ->with('success', 'Genus created successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Something went wrong while creating genus.');
        }

        // return redirect()->route('genera.index')->with('success', 'Genus created successfully.');
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
    public function edit(string $id, GenusService $service)
    {
        $genus = $this->genusRepository->find($id);
        $selectedFamilyDTO = $service->getSelectedFamilyDTO($genus);

        return view('pages.genera.create', compact('genus', 'selectedFamilyDTO'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenusRequest $request, string $id)
    {
        try {
            $this->genusRepository->update($id, $request);

            return redirect()
                ->route('genera.index')
                ->with('success', 'Genus updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update genus.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->genusRepository->delete($id);

            return redirect()
                ->route('genera.index')
                ->with('success', 'Genus deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete genus.');
        }
    }

    public function ajaxByFamily(Request $request)
    {
        $familyId = $request->family_id;
// dd($familyId);
      $genera=   $this->genusRepository->getGenusByFamilyId($familyId);

    //    dd($genera);

        return response()->json($genera);
    }
}
