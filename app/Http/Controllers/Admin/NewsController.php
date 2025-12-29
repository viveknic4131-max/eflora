<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\NewsRepositoryInterface;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }
    public function index(Request $request)
    {


        $perPage = $request->get('perPage', 50);
        $news = $this->newsRepository->getAllNews($perPage);

        return view('pages.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->newsRepository->store($request);

            return redirect()
                ->route('news.index')
                ->with('success', 'News created successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Something went wrong while creating news.');
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
     $news = $this->newsRepository->find($id);
        return view('pages.news.create', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      try {
            $this->newsRepository->update($id, $request);

            return redirect()
                ->route('news.index')
                ->with('success', 'News updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update News.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->newsRepository->delete($id);

            return redirect()
                ->route('news.index')
                ->with('success', 'News deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete News.');
        }
    }


    public function newsList(Request $request)
    {
        $perPage = $request->get('perPage', 50);
        $news = $this->newsRepository->getAllNews($perPage);

        return view('theme.newslist', compact('news'));
    }
}
