@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Create Sale</h4>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody id="product-rows">
                <tr>
                    <td>
                        <select name="product_ids[]" class="form-control" required>
                            <option value="">-- Select Product --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }} (Tk {{ $product->sell_price }})
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="quantities[]" class="form-control" min="1" required></td>
                </tr>
            </tbody>
        </table>

        <button type="button" id="add-row" class="btn btn-secondary mb-3">Add Product</button>

        <div class="mb-3">
            <label>Discount (TK)</label>
            <input type="number" name="discount" class="form-control" value="0">
        </div>

        <div class="mb-3">
            <label>Paid Amount (TK)</label>
            <input type="number" name="paid_amount" class="form-control" value="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Complete Sale</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('add-row').addEventListener('click', () => {
        const row = document.querySelector('#product-rows tr');
        document.getElementById('product-rows').appendChild(row.cloneNode(true));
    });
</script>
@endpush
