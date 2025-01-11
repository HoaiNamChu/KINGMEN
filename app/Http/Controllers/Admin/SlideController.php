<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = Slide::all(); // Lấy tất cả slides
        return view('admin.sliders.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'image',
            'content' => 'max:100',
            'link' => 'max:100',
        ]);

        // Xử lý lưu ảnh nếu có
        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('slides', 'public')
            : null; // Nếu không có ảnh, đặt giá trị là null

        Slide::create([
            'title' => $request->title,
            'image' => $imagePath,
            'link' => $request->link,
            'content' => $request->content,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.slides.index')->with('success', 'Slide created successfully!');
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
    public function edit(Slide $slide)
    {
        return view('admin.sliders.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slide $slide)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $imagePath = $slide->image;
        // Nếu có ảnh mới, xóa ảnh cũ và lưu ảnh mới
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath); // Xóa ảnh cũ
            }
            $imagePath = $request->file('image')->store('slides', 'public'); // Lưu ảnh mới
        }

        $slide->update([
            'title' => $request->title,
            'image' => $imagePath,
            'link' => $request->link,
            'content' => $request->content,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.slides.index')->with('success', 'Slide updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slide $slide)
    {
        $slide->delete();
        return redirect()->route('admin.slides.index')->with('success', 'Slide deleted successfully!');
    }
}
