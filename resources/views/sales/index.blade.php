@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Sales</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">New Sale</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Subtotal</th>
                <th>Discount</th>
                <th>VAT</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Due</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
            <tr>
                <td>{{ $sale->created_at->format('d M Y') }}</td>
                <td>{{ $sale->subtotal }}</td>
                <td>{{ $sale->discount }}</td>
                <td>{{ $sale->vat }}</td>
                <td>{{ $sale->total }}</td>
                <td>{{ $sale->paid_amount }}</td>
                <td>{{ $sale->due_amount }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
