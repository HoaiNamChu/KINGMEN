<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.posts.';
    const PATH_UPLOAD = 'posts';

    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view(self::PATH_VIEW . __FUNCTION__, compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::pluck('name', 'id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'user_id' => \Auth::id(),
            'title' => request('title'),
            'content' => request('content'),
            'is_active' => request('is_active') ?? 0,
            'is_home' => request('is_home') ?? 0,
        ];
        if (empty($request->slug)) {
            $data['slug'] = Str::slug($request->title);
        } else {
            $data['slug'] = Str::slug($request->slug);
        }
        if (request()->hasFile('image')) {
            $data['image'] = \Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        $data['image'] ??= null;

        $post = Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Added new post successfully');
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
    public function edit(Post $post)
    {
        $post->load('user');
        $tags = Tag::pluck('name', 'id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $oldThumbUrl = $post->image;

        $data = [
            'title' => request('title'),
            'content' => request('content'),
            'is_active' => request('is_active') ?? 0,
            'is_home' => request('is_home') ?? 0,
        ];
        if (empty($request->slug)) {
            $data['slug'] = Str::slug($request->title);
        } else {
            $data['slug'] = Str::slug($request->slug);
        }

        if (request()->hasFile('image')) {
            $data['image'] = \Storage::put(self::PATH_UPLOAD, $request->file('image'));
        } else {
            $data['image'] = $oldThumbUrl;
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Updated post successfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $thumbUrl = $post->image;
        $post->delete();
        if (!empty($thumbUrl) && Storage::exists($thumbUrl)) {
            \Storage::delete($thumbUrl);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Deleted post successfully');
    }
}
