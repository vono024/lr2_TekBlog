<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('status', 'Увійдіть для перегляду списку бажань');
        }

        $products = auth()->user()->wishlistProducts()->paginate(12);

        return view('wishlist.index', compact('products'));
    }

    public function toggle(Product $product)
    {
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'Увійдіть в систему']);
        }

        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['success' => true, 'action' => 'removed']);
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ]);
            return response()->json(['success' => true, 'action' => 'added']);
        }
    }
}
