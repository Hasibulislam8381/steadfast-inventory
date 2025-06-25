@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4>Edit Product</h4>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="mb-3">
            <label>Purchase Price</label>
            <input name="purchase_price" class="form-control" type="number" step="0.01" value="{{ $product->purchase_price }}" required>
        </div>
        <div class="mb-3">
            <label>Sell Price</label>
            <input name="sell_price" class="form-control" type="number" step="0.01" value="{{ $product->sell_price }}" required>
        </div>
        <div class="mb-3">
            <label>Stock</label>
            <input name="stock" class="form-control" type="number" value="{{ $product->stock }}" required>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
