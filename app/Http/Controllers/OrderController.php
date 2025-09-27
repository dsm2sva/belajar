<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //  Lihat daftar pesanan user
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('orders.index', compact('orders'));
    }

    // 📌 Menampilkan detail order
    public function show($id)
    {
        $order = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    //  Proses checkout
    public function store(Request $request)
    {
        $userId = Auth::id();

        // 1. Ambil semua item di cart user
        $cartItems = CartItem::with('product')
            ->where('user_id', $userId)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        // 2. Buat order baru
        $order = Order::create([
            'user_id' => $userId,
            'total' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
            'status' => 'pending', // default status
        ]);

        // 3. Buat order_items dari cart_items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        // 4. Kosongkan cart
        CartItem::where('user_id', $userId)->delete();

        // 5. Redirect ke detail order
        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Checkout berhasil!');
    }

}
