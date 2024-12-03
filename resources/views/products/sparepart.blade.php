@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container py-5">
    <h1 class="text-center mb-5 fw-bold" style="color: #6c757d;">Spareparts</h1>

    <!-- Cart Button -->
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('cart.index') }}" class="btn btn-outline-primary btn-lg">
            <i class="fas fa-shopping-cart"></i> View Cart
        </a>
    </div>

    <!-- Product Grid -->
    <div class="row g-4">
        @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                    <!-- Product Image -->
                    <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                        <img src="{{ file_exists(public_path($product->image)) ? asset($product->image) : 'https://placehold.co/300x300/eeeeee/333333' }}"
                             class="card-img-top rounded-top"
                             alt="{{ $product->name }}"
                             style="height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;">
                    </a>
                    <!-- Card Body -->
                    <div class="card-body text-center">
                        <h5 class="card-title text-dark fw-bold">{{ $product->name }}</h5>
                        <p class="card-text text-success fw-bold">Rp. {{ number_format($product->price, 2) }}</p>
                        <div class="d-grid">
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>
</div>
@endsection
