@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Dashboard</h3>
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Sales</h5>
                    <p class="card-text fs-3">
                        TK {{ number_format(\App\Models\Sale::sum('total'), 2) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Paid</h5>
                    <p class="card-text fs-3">
                        TK {{ number_format(\App\Models\Sale::sum('paid_amount'), 2) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Due</h5>
                    <p class="card-text fs-3">
                        TK {{ number_format(\App\Models\Sale::sum('due_amount'), 2) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text fs-3">
                        {{ \App\Models\Product::count() }}
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
