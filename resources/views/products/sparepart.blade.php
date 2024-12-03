@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container py-5">
    <h1 class="text-center mb-5 text-info fw-bold">Spareparts</h1>

    <!-- Search and Cart Section -->
    <div class="d-flex justify-content-between mb-4">
        <!-- Search Bar -->
        <form action="{{ route('products.index') }}" method="GET" class="d-flex" style="max-width: 400px;">
            <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-info">
                <i class="fas fa-search"></i> Search
            </button>
        </form>
        <!-- Cart Button -->
        <a href="{{ route('cart.index') }}" class="btn btn-outline-info">
            <i class="fas fa-shopping-cart"></i> View Cart
        </a>
    </div>

    <!-- Product Grid -->
    <div class="row g-4">
        @forelse ($products as $product)
            <div class="col-md-4">
                <!-- Product Card -->
                <div class="card h-100 border-0 shadow" style="border-radius: 15px; background-color: #2c3e50; color: #ecf0f1;">
                    <!-- Image Section -->
                    <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                        <img src="{{ Storage::url('/' . $product->image) }}"
                             class="card-img-top rounded-top"
                             alt="{{ $product->name }}"
                             style="height: 200px; object-fit: cover; filter: brightness(0.9); border-radius: 15px 15px 0 0;">
                    </a>
                    <!-- Card Body -->
                    <div class="card-body text-center">
                        <h5 class="card-title text-light fw-bold">{{ $product->name }}</h5>
                        <p class="card-text text-warning fw-bold">Rp. {{ number_format($product->price, 2) }}</p>
                        <!-- Add to Cart Form -->
                        <form action="{{ route('cart.store') }}" method="POST" class="d-inline-block">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <!-- Quantity Input -->
                            <div class="mb-2">
                                <input type="number" name="quantity" min="1" value="1" class="form-control text-center" style="width: 60px; margin: 0 auto;">
                            </div>
                            <button type="submit" class="btn btn-warning w-100 text-dark fw-bold">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </form>
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
