@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container py-5">
    <h1 class="text-center mb-5 fw-bold" style="color: #6c757d;">Ban Motor</h1>

    <!-- Search and Cart Section -->
    <div class="d-flex justify-content-between mb-4">
        <!-- Search Bar -->
        <form action="{{ route('products.index') }}" method="GET" class="d-flex" style="max-width: 400px;">
            <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-dark">
                <i class="fas fa-search"></i> Search
            </button>
        </form>
        <!-- Cart Button -->
        <a href="{{ route('cart.index') }}" class="btn btn-outline-dark btn-lg">
            <i class="fas fa-shopping-cart"></i> View Cart
        </a>
    </div>

    <!-- Product Grid -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($products as $product)
            <div class="col">
                <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                    <!-- Product Image -->
                    <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                        <img src="{{ file_exists(public_path($product->image)) ? asset($product->image) : 'https://placehold.co/300x300/eeeeee/333333' }}"
                             class="card-img-top rounded-top"
                             alt="{{ $product->name }}"
                             style="height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;">
                    </a>
                    <!-- Card Body -->
                    <div class="card-body">
                        <h5 class="card-title text-center text-dark">{{ $product->name }}</h5>
                        <p class="card-text text-center text-success fw-bold">Rp. {{ number_format($product->price, 2) }}</p>
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
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No products found matching your search.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>
</div>
@endsection
