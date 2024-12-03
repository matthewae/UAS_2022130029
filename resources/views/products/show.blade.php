@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Product Card -->
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h1 class="text-center mb-4 text-primary">{{ $product->name }}</h1>
            <div class="row">
                <!-- Image Section -->
                <div class="col-md-6 text-center">
                    <div class="p-3">
                        @if ($product->image)
                            <img src="{{ Storage::url('/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-height: 350px;">
                        @else
                            <img src="{{ Storage::url('images/placeholder.png') }}" alt="No image available" class="img-fluid rounded" style="max-height: 350px;">
                        @endif
                    </div>
                </div>
                <!-- Product Details Section -->
                <div class="col-md-6">
                    <h3 class="text-success">Price: Rp. {{ number_format($product->price, 2) }}</h3>
                    <p class="text-muted mb-4">{{ $product->description }}</p>
                    <div class="mb-3">
                        <!-- Apply different background color based on category -->
                        <span class="badge" style="background-color: {{ getCategoryColor($product->category->name) }};">
                            Category: {{ $product->category->name }}
                        </span>
                    </div>
                    <p class="text-dark"><strong>Stock:</strong> {{ $product->stock }}</p>
                    <!-- Add to Cart Button -->
                    <button class="btn btn-primary btn-lg mt-4">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="mt-5">
                <ul class="nav nav-tabs" id="productDetailsTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">
                            Description
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab" aria-controls="specifications" aria-selected="false">
                            Specifications
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">
                            Reviews
                        </button>
                    </li>
                </ul>
                <div class="tab-content p-4 border border-top-0 rounded-bottom shadow-sm">
                    <!-- Description Tab -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <p>{{ $product->description }}</p>
                    </div>
                    <!-- Specifications Tab -->
                    <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                        <ul>
                            @if ($product->specifications && is_array($product->specifications))
                                @foreach ($product->specifications as $spec)
                                    <li>{{ $spec }}</li>
                                @endforeach
                            @else
                                <li>No specifications available.</li>
                            @endif
                        </ul>
                    </div>
                    <!-- Reviews Tab -->
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <p>No reviews available at the moment.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@php
// Helper function to return category color
function getCategoryColor($categoryName) {
    $colors = [
        'Oli Motor' => '#FF4C4C',    // Red
        'Lampu Motor' => '#FFC107',  // Yellow
        'Ban Motor' => '#28A745',    // Green
        'Sparepart' => '#007BFF',    // Blue
    ];

    return $colors[$categoryName] ?? '#6C757D'; // Default color
}
@endphp
