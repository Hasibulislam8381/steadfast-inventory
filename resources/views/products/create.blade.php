@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4>Add Product</h4>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Purchase Price</label>
            <input name="purchase_price" class="form-control" type="number" step="0.01" required>
        </div>
        <div class="mb-3">
            <label>Sell Price</label>
            <input name="sell_price" class="form-control" type="number" step="0.01" required>
        </div>
        <div class="mb-3">
            <label>Opening Stock</label>
            <input name="stock" class="form-control" type="number" required>
        </div>
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
