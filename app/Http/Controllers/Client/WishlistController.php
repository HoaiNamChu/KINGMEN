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
        //
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Kiểm tra xem sản phẩm đã có trong wishlist của người dùng chưa
        $exists = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            // Nếu tồn tại, hiển thị thông báo
            return redirect()->back()->with('error', 'Product is already in your wishlist!');
        }
        
        // Nếu chưa tồn tại, thêm sản phẩm vào wishlist
        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist!');
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
