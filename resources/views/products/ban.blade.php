@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <h1 class="text-center mb-4">Ban Motor</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('cart.index') }}" class="btn btn-primary">
            View Cart
        </a>
    </div>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ file_exists(public_path($product->image)) ? asset($product->image) : 'https://placehold.co/150x150' }}"
                             class="card-img-top"
                             alt="{{ $product->name }}"
                             width="500"
                             height="500"
                             style="object-fit: cover;">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Price: Rp. {{ number_format($product->price, 2) }}</p>
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-success w-100">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection
