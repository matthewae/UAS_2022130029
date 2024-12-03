@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">{{ $product->name }}</h1>

    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2>Price: Rp. {{ $product->price }}</h2>
            <p>{{ $product->description }}</p>
            <p>Category: {{ $product->category->name }}</p>
            <p>Stock: {{ $product->stock }}</p>
        </div>
    </div>
</div>
@endsection
