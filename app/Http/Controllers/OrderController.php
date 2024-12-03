<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\PaymentMethod;

class OrderController extends Controller
{
    public function checkoutForm()
    {
        $paymentMethods = PaymentMethod::all();

        return view('checkout', compact('paymentMethods'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string|min:10',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $totalPrice = 0;
        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['id']);
            $totalPrice += $product->price * $productData['quantity'];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'payment_method_id' => $request->payment_method_id,
            'total_price' => $totalPrice,
            'status' => 'Pending',
            'order_date' => now(),
        ]);

        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->save();

        foreach ($request->products as $productData) {
            $order->products()->attach($productData['id'], [
                'quantity' => $productData['quantity'],
            ]);
        }

        return redirect()->route('order.success', ['order' => $order->id])
            ->with('success', 'Order placed successfully!');
    }

    public function orderSuccess($orderId)
    {
        $order = Order::findOrFail($orderId);

        return view('order-success', compact('order'));
    }
}
