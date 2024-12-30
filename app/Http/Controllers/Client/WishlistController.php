<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Trả về danh sách sản phẩm trong wishlist của người dùng
        $wishlists = Wishlist::where('user_id', auth()->id())->with('product')->get();
        return view('client.wishlist.index', compact('wishlists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $exists = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id);

        if ($exists->exists()) {
            $exists->delete();
            return response()->json([
                'success' => false,
                'message' => 'This product has been removed from wishlist.'
            ]);
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Product added to wishlist!'
            ]);
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
    public function destroy(Wishlist $wishlist)
    {
        //
        if ($wishlist->user_id === auth()->id()) {
            $wishlist->delete();
            return redirect()->back()->with('success', 'Product removed from wishlist!');
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }
}
