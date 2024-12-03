<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\TransactionHistory;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $paymentMethods = PaymentMethod::all();
        return view('cart.index', compact('cart', 'paymentMethods'));
    }


    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->input('quantity', 1);

        // Logic untuk menambahkan produk ke keranjang
        // Misalnya menggunakan session atau database untuk menyimpan keranjang belanja
        // Contoh dengan session
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity; // Menambahkan kuantitas
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
            ];
        }
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }


    public function destroy($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $request->validate([
            'payment_method' => 'required|exists:payment_methods,id',
        ]);

        $paymentMethod = PaymentMethod::findOrFail($request->payment_method);

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'Completed',
            'total_price' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
            'payment_method_id' => $paymentMethod->id,
        ]);

        foreach ($cart as $productId => $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        TransactionHistory::create([
            'user_id' => Auth::id(),
            'order_id' => $order->id,
            'payment_method_id' => $paymentMethod->id,
            'status' => 'Paid',
            'amount' => $order->total_price,
        ]);

        session()->forget('cart');

        return redirect()->route('products.oli-motor')->with('success', 'Payment successful and your order is confirmed!');
    }
}
