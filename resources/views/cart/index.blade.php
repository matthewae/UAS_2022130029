@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Your Cart</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (empty($cart))
        <p class="text-center">Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $id => $item)
                    <tr>
                        <td>
                            <img src="{{ file_exists(public_path($item['image'])) ? asset($item['image']) : 'https://placehold.co/150x150' }}" alt="{{ $item['name'] }}" style="width: 50px;">
                        </td>
                        <td>{{ $item['name'] }}</td>
                        <td>Rp. {{ number_format($item['price'], 2) }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>Rp. {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        <td>
                            <form action="{{ route('cart.destroy', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <div class="total-amount">
                <h4>Total: Rp. {{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), 2) }}</h4>
            </div>
        </div>

        <!-- Payment Method Dropdown and Buy Button -->
        <div class="mt-4">
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="paymentMethodSelect">Select Payment Method</label>
                    <select id="paymentMethodSelect" class="form-control" name="payment_method">
                        @foreach ($paymentMethods as $paymentMethod)
                            <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success mt-3">Proceed to Buy</button>
            </form>
        </div>
    @endif
</div>
@endsection
