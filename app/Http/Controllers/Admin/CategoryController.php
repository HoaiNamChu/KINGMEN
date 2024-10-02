<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.categories.';
    const PATH_UPLOAD = 'categories';
    public function index()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
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
    public function store(Request $request)
    {
        $data = [
            'name' => request('name'),
            'parent_id' => request('parent_id'),
            'description' => request('description'),
        ];
        $data['image'] ??= null;
        $data['is_active'] = request('is_active') ? 1 : 0;
        if (request()->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, request()->file('image'));
        }
        dd($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view(self::PATH_VIEW . __FUNCTION__);
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
}
