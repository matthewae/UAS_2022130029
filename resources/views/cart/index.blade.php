@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4 fw-bold" style="color: #6c757d;">Your Cart</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (empty($cart))
        <div class="alert alert-info text-center">
            <strong>Your cart is empty.</strong> Start shopping to add items to your cart.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped">
                <thead class="thead-dark">
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
                                <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}" class="img-fluid" style="max-width: 80px; object-fit: cover; border-radius: 8px;">
                            </td>

                            <td>{{ $item['name'] }}</td>
                            <td class="text-end">Rp. {{ number_format($item['price'], 2) }}</td>
                            <td class="text-center">{{ $item['quantity'] }}</td>
                            <td class="text-end">Rp. {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td>
                                <form action="{{ route('cart.destroy', $id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <h4 class="fw-bold">Total: <span class="text-success">Rp. {{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), 2) }}</span></h4>
        </div>

        <!-- Payment Method Dropdown and Buy Button -->
        <div class="mt-4">
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="paymentMethodSelect" class="form-label">Select Payment Method</label>
                    <select id="paymentMethodSelect" class="form-select" name="payment_method" required>
                        @foreach ($paymentMethods as $paymentMethod)
                            <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success w-100 mt-3">
                    <i class="fas fa-check-circle"></i> Proceed to Buy
                </button>
            </form>
        </div>
    @endif
</div>
@endsection
