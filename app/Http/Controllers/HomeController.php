<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Family;
use App\Models\FamilyVolumes;
use App\Models\Genus;
use App\Models\Species;
use App\Models\Volume;
use App\Repositories\Contracts\VolumeRepositoryInterface;
use App\Services\SearchService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(protected SearchService $searchService,  VolumeRepositoryInterface $volumeRepository)
    {
        $this->volumeRepository = $volumeRepository;
    }


    public function search(SearchRequest $request)
    {
        try {
            // validated inputs only
            $validated = $request->validated();

            $plantType = $validated['plant_type'];
            $keyword   = $validated['q'];
            $page      = $request->input('page', 1);
            $perPage   = $request->input('per_page', 12);

            $resultPaginator = $this->searchService->search(
                plantType: $plantType,
                keyword: $keyword,
                page: $page,
                perPage: $perPage
            );

            return view('theme.searchlist', [
                'data'       => $resultPaginator,
                'keyword'    => $keyword,
                'searchType' => $plantType
            ]);
        } catch (\Exception $e) {


            \Log::info('Search error: ' . $e->getMessage());


            return redirect()
                ->back()
                ->withErrors(['error' => 'Something went wrong while processing your search.'])
                ->withInput();
        }
    }



    // public function suggest(SearchRequest $request)
    // {

    //     try {
    //         // dd('here');
    //         // $request->validate([
    //         //     'q' => 'required|string|min:1|max:255|regex:/^[A-Za-z\s]+$/',
    //         // ]);
    //         // $validated = $request->validated();
    //         $service = $this->searchService->suggest($request->q, $request->plant_type ?? null);
    //         return response()->json($service);
    //         //

    //         // return response()->json($this->searchService->suggest($validated['q'], $validated['plant_type'] ?? null));
    //     } catch (\Exception $e) {
    //         \Log::info('Suggestion error: ' . $e->getMessage());
    //         return response()->json([
    //             'error' => 'Something went wrong while fetching suggestions.'
    //         ], 500);
    //     }
    // }

    public function suggest(SearchRequest $request)
    {
        try {
            $service = $this->searchService->suggest(
                $request->q,
                $request->plant_type
            );

            return response()->json($service);
        } catch (\Exception $e) {
            \Log::error("Suggest Error: " . $e->getMessage());

            return response()->json([
                'error' => 'Something went wrong while fetching suggestions.'
            ], 500);
        }
    }



    // old method before refactor

    //  public function search(Request $request)
    // {

    //     // 🔹 Validate request
    //     $validated = $request->validate([
    //         'plant_type' => 'required|in:flora_india,checklist',
    //         'q' => 'required|string|max:255',
    //     ]);

    //     $keyword = trim($request->q);
    //     $searchType = $request->plant_type;

    //     // 🔹 Volume type: 1 = flora_india, 0 = checklist
    //     $volumeType = $searchType === 'flora_india' ? 1 : 0;

    //     // 🔹 Get all volume IDs of that type
    //     $volumeIds = Volume::where('type', $volumeType)->pluck('id');
    //     // dd(in_array(1,$volumeIds->toArray()));
    //     // 🔹 Get all family IDs related to those volumes
    //     $familyIds = FamilyVolumes::whereIn('volume_id', $volumeIds)
    //         ->pluck('family_id')
    //         ->unique();


    //     $families = Family::whereIn('id', $familyIds)
    //         ->where('name', 'LIKE', "%{$keyword}%")
    //         ->get();
    //     // dd($families);
    //     $genus = Genus::with('family')
    //         ->whereIn('family_id', $familyIds)
    //         ->where('name', 'LIKE', "%{$keyword}%")
    //         ->get();

    //     $species = Species::with(['images', 'family', 'genus'])
    //         ->whereIn('family_id', $familyIds)
    //         ->where('name', 'LIKE', "%{$keyword}%")
    //         ->get();

    //     // 🔹 Combine all results into one collection
    //     $combined = collect()
    //         ->merge($families->map(fn($f) => [
    //             'type' => 'Family',
    //             'name' => $f->name,
    //             'details' => $f->description,
    //             'id' => $f->family_code,
    //             'images' => null
    //         ]))
    //         ->merge($genus->map(fn($g) => [
    //             'type' => 'Genus',
    //             'name' => $g->name,
    //             'details' => ($g->description ?? '') . ' (' . ($g->family->name ?? '') . ')',
    //             'id' => $g->genus_code,
    //             'images' => null
    //         ]))
    //         ->merge($species->map(fn($s) => [
    //             'type' => 'Species',
    //             'name' => $s->name,
    //             'details' => implode(' ', array_filter([
    //                 $s->family->name ?? '',
    //                 $s->genus->name ?? '',
    //                 $s->author,
    //                 $s->volume,
    //                 $s->page,
    //                 $s->year_described,
    //                 $s->publication
    //             ])),
    //             'id' => $s->species_code,
    //             'images' => $s->images->pluck('pic')->first()
    //         ]));

    //     // 🔹 Manual Pagination (since we merged collections)
    //     $perPage = 10;
    //     $page = request()->get('page', 1);
    //     $pagedData = $combined->forPage($page, $perPage);

    //     // Create LengthAwarePaginator instance


    //     $data = new \Illuminate\Pagination\LengthAwarePaginator(
    //         $pagedData,
    //         $combined->count(),
    //         $perPage,
    //         $page,
    //         ['path' => request()->url(), 'query' => request()->query()]
    //     );
    //     //  dd($keyword );
    //     // 🔹 Return view
    //     return view('theme.searchlist', compact('data', 'keyword', 'searchType'));
    // }

    // public function suggest(Request $request)
    // {
    //     $type = $request->get('plant_type');
    //     $keyword = $request->get('q');

    //     $families = Family::where('name', 'LIKE', "%{$keyword}%")
    //         ->take(5)
    //         ->get(['id', 'name']);

    //     $genus = Genus::where('name', 'LIKE', "%{$keyword}%")
    //         ->take(5)
    //         ->get(['id', 'name']);

    //     $species = Species::where('name', 'LIKE', "%{$keyword}%")
    //         ->take(5)
    //         ->get(['id', 'name']);

    //     $suggestions = [
    //         'Family' => $families,
    //         'Genus' => $genus,
    //         'Species' => $species,
    //     ];

    //     return response()->json($suggestions);
    // }


    public function index()
    {
        $bsiVolume = Volume::where('type', false)->paginate(5);
        $floraofIndia = Volume::where('type', true)->paginate(5);

        return view('theme.home', compact('bsiVolume', 'floraofIndia'));
        // return view('theme.home');
    }

    // public function getPlantChecklistVolume(Request $request)
    // {
    //     // dd($request->all());


    //     $type = $request->boolean('code', false);

    //     $mode = $type ? 'Plant Checklist Of India' : 'Flora Of India';

    //     $perPage = $request->get('perPage', 50);
    //         $letter = null;
    //     // Fetch volumes
    //     $bsiVolume = $this->volumeRepository->getVolumesByType($letter,$type, $perPage);

    //     if ($request->letter) {

    //         $letter = $request->letter;
    //         $bsiVolume = $this->volumeRepository->getVolumesByType($letter,$type, $perPage);
    //           dd( $bsiVolume);
    //     }

    //     // Return view with mode
    //     return view('theme.volumes', compact('bsiVolume', 'mode'));
    // }


    public function getPlantChecklistVolume(Request $request)
    {
        $type = $request->boolean('code', false);
        $letter = $request->get('letter');
        $perPage = $request->get('perPage', 50);

        $mode = $type ? 'Plant Checklist Of India' : 'Flora Of India';

        // Pass both type & letter
        $bsiVolume = $this->volumeRepository->getVolumesByType($type, $letter, $perPage);

        return view('theme.volumes', compact('bsiVolume', 'mode', 'letter'));
    }



    // Flora of India AJAX
    public function getFloraOfIndiaVolumes(Request $request)
    {
        $perPage = $request->get('perPage', 50);
        $floraofIndia =  $bsiVolume =  $this->volumeRepository->getVolumesByType(false, $perPage);;

        // if ($request->ajax()) {
        return view('theme.volumes', compact('floraofIndia'))->render();
        // }
    }

    public function getVolumesList(Request $request)
    {
        $mode = $request->get('mode', 'all');
        $perPage = $request->get('perPage', 50);
        $volumes =  $this->volumeRepository->getAllVolumes($perPage);

        // if ($request->ajax()) {
        return view('theme.volumes', compact('volumes'))->render();
        // }
    }







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
        // dd($request->all());

        // Volume Mode — show only family list
        if ($request->filled('volume')) {
            $volumeCode = trim($request->volume);
            $volume = Volume::where('volume_code', $volumeCode)->firstOrFail();

            $familyIds = FamilyVolumes::where('volume_id', $volume->id)->pluck('family_id');
            $families = Family::with('genera.species.images')->whereIn('id', $familyIds)->paginate(50);

            return view('theme.family-view', [
                'mode' => 'volume',
                'volume' => $volume,
                'families' => $families,
            ]);
        }

        //  Family Mode — show only Genus list
        if ($request->filled('family') && !$request->filled('genus')) {
            $family = Family::where('family_code', $request->family)->firstOrFail();

            $genusQuery = Genus::where('family_id', $family->id);

            if ($request->filled('genus_search')) {
                $genusQuery->where('name', 'like', '%' . $request->genus_search . '%');
            }

            $genusList = $genusQuery->paginate(24);

            return view('theme.family-view', [
                'mode' => 'family',
                'family' => $family,
                'genusList' => $genusList,
            ]);
        }

        //  Genus Mode — show species under selected genus
        if ($request->filled('genus')) {
            $genus = Genus::where('genus_code', $request->genus)->firstOrFail();
            $family = Family::findOrFail($genus->family_id);

            $speciesQuery = Species::with('images')->where('genus_id', $genus->id);

            if ($request->filled('species_search')) {
                $speciesQuery->where('name', 'like', '%' . $request->species_search . '%');
            }

            $speciesList = $speciesQuery->paginate(24);

            return view('theme.family-view', [
                'mode' => 'genus',
                'family' => $family,
                'genus' => $genus,
                'speciesList' => $speciesList,
            ]);
        }

        // flora of India Mode — show all families  or generas

        // Checklist / Flora of India Mode — show all families or genera
        if ($request->filled('type') && $request->has('code')) {


            $isFloraIndia = $request->boolean('code');
            $modePrefix  = $isFloraIndia ? 'flora_india' : 'checklist';

            if ($request->type === 'family') {

                  $volume = Volume::where('type',$isFloraIndia )->get();

                  if($volume->isEmpty()) {
                      abort(404, 'No volumes found for the specified type.');
                  }
                  foreach($volume as $vol) {
                    $getFamilyIds = FamilyVolumes::where('volume_id', $vol->id)->pluck('family_id');
                    dd($getFamilyIds);
                    $families = Family::with('genera.species.images')->whereIn('id', $getFamilyIds)->paginate(50);
                  }

            // $familyIds = FamilyVolumes::where('volume_id', $volume->id)->pluck('family_id');
            // $families = Family::with('genera.species.images')->whereIn('id', $familyIds)->paginate(50);

            //     $families = Family::paginate(50);

                return view('theme.family-view', [
                    'mode'     => "{$modePrefix}_family",
                    'families' => $families,
                ]);
            }

            if ($request->type === 'generas') {

                $generas = Genus::paginate(50);

                return view('theme.family-view', [
                    'mode'  => "{$modePrefix}_genus",
                    'genus' => $generas,
                ]);
            }
        }


        abort(404, 'Invalid parameters provided.');
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
