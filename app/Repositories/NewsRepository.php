<?php

namespace App\Repositories;

use App\Models\News;
use App\Repositories\Contracts\NewsRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsRepository implements NewsRepositoryInterface
{
    public function search(string $keyword, array $volumeIds)
    {
        return News::whereIn('id', $volumeIds)
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->get();
    }

    public function searchByName(string $name)
    {
        return News::where('name', 'LIKE', '%' . $name . '%')->first();
    }

    public function getAllNews(int $perPage)
    {
        return News::orderby('id', 'DESC')->paginate($perPage);
    }

    public function find($id)
    {
        return News::findOrFail($id);
    }


    public function update($id, $request)
    {
        DB::beginTransaction();

        try {
            $news = News::findOrFail($id);


            $data = [
                'title' => $request->title,
                'slug'  => Str::slug($request->title),
            ];

            if ($request->hasFile('file_path')) {

                if ($news->file_path && Storage::disk('public')->exists('news/' . $news->file_path)) {
                    Storage::disk('public')->delete('news/' . $news->file_path);
                }


                $file = $request->file('file_path');
                $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();

                $file->storeAs('news', $filename, 'public');


                $data['file_path'] = $filename;
            }


            $news->update($data);

            
            DB::commit();
            return $news;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $News = News::findOrFail($id);
            $News->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            //   return true;
            throw $e;
        }
    }
    public function store($request)
    {

        // dd($request->all());
        return DB::transaction(function () use ($request) {

            $filename = null;


            if ($request->hasFile('file_path')) {

                $file = $request->file('file_path');

                $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();

                $file->storeAs('news', $filename, 'public');
            }


            return News::create([
                'title'     => $request->title,
                'slug'      => Str::slug($request->title),
                'file_path' => $filename,
            ]);
        });
    }
}
