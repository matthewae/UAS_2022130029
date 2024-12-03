@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-4 fw-bold" style="color: #6c757d;">Edit Product</h1>

        <div class="card shadow-sm border-0 p-4">
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Menggunakan metode PUT untuk update -->

                <!-- Product Name -->
                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold">Product Name</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}"
                        placeholder="Enter product name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Product Price -->
                <div class="mb-4">
                    <label for="price" class="form-label fw-semibold">Price (Rp.)</label>
                    <input type="number" name="price" id="price"
                        class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('price', $product->price) }}" placeholder="Enter product price">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Product Category -->
                <div class="mb-4">
                    <label for="category_id" class="form-label fw-semibold">Category</label>
                    <select name="category_id" id="category_id"
                        class="form-select @error('category_id') is-invalid @enderror">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Product Description -->
                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4"
                        placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Product Stock -->
                <div class="mb-4">
                    <label for="stock" class="form-label fw-semibold">Stock</label>
                    <input type="number" name="stock" id="stock"
                        class="form-control @error('stock') is-invalid @enderror"
                        value="{{ old('stock', $product->stock) }}" placeholder="Enter product stock" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Product Image -->
                <div class="mb-4">
                    <label for="image" class="form-label fw-semibold">Product Image</label>
                    <input type="file" name="image" id="image"
                        class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($product->image)
                        <img src="{{ Storage::url('/' . $product->image) }}" alt="Product Image"
                            class="mt-3 img-thumbnail" style="max-width: 150px;">
                    @else
                        <img src="https://placehold.co/150x150" alt="Placeholder Image" class="mt-3 img-thumbnail"
                            style="max-width: 150px;">
                    @endif

                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Product
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Home
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
