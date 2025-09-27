<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 📌 Lihat semua item di keranjang user
    public function index()
    {
        $userId = Auth::id();

        $cartItems = CartItem::with('product')
            ->where('user_id', $userId)
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    // 📌 Tambah item ke keranjang
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $product = Product::findOrFail($request->product_id);

        // jika item sudah ada di keranjang → update jumlah
        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cartItem = CartItem::create([
                'user_id'    => $userId,
                'product_id' => $product->id,
                'quantity'   => $request->quantity,
            ]);
        }

        return response()->json($cartItem, 201);
    }

    // 📌 Hapus item dari keranjang
    public function destroy($id)
    {
        $userId = Auth::id();

        $cartItem = CartItem::where('user_id', $userId)
            ->where('id', $id)
            ->firstOrFail();

        $cartItem->delete();

        return response()->json(['message' => 'Item removed from cart']);
    }
}
