@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product List</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Create Product</a>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Category</th>
                <th class="text-center">Stocks</th>
                <th class="text-center">Price</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="text-center">{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->stock }}</td>
                    <td class="text-right">{{ number_format($product->price, 2) }}</td>
                    <td class="text-center">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this product?');
    }
</script>
@endsection
