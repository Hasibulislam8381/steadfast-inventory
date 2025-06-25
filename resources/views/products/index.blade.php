@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Product List</h4>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">Add Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Purchase Price</th>
                <th>Sell Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->purchase_price }}</td>
                <td>{{ $product->sell_price }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this product?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
