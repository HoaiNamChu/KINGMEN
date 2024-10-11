<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tags\StoreTagRequest;
use App\Http\Requests\Admin\Tags\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.tags.';

    public function index()
    {
        $tags = Tag::query()->latest()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        $data = [
            'name' => request('name'),
            'description' => request('description'),
            'is_active' => request('is_active')
        ];

        if (request('slug')) {
            $data['slug'] = Str::slug(request('slug'));
        } else {
            $data['slug'] = Str::slug(request('name'));
        }

        try {
            $tag = Tag::query()->create($data);
            return redirect()->route('admin.tags.index')->with('success', 'Add Tags Successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view(self::PATH_VIEW . __FUNCTION__,compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $data = [
            'name' => request('name'),
            'description' => request('description'),
            'is_active' => request('is_active')
        ];

        if (request('slug')) {
            $data['slug'] = Str::slug(request('slug'));
        } else {
            $data['slug'] = Str::slug(request('name'));
        }

        try {
            $tag->update($data);
            return redirect()->route('admin.tags.edit', $tag)->with('success', 'Update Tags Successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            return redirect()->route('admin.tags.index')->with('success', 'Delete Tags Successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
