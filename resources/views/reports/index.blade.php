@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Financial Report</h4>

    <form method="GET" action="{{ route('reports.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label>Start Date</label>
            <input type="date" name="start_date" value="{{ $start }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label>End Date</label>
            <input type="date" name="end_date" value="{{ $end }}" class="form-control" required>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <table class="table table-bordered">
        <tr>
            <th>Total Sales (TK)</th>
            <td>{{ number_format($totalSales, 2) }}</td>
        </tr>
        <tr>
            <th>Total Discount (TK)</th>
            <td>{{ number_format($totalDiscount, 2) }}</td>
        </tr>
        <tr>
            <th>Total VAT Collected (TK)</th>
            <td>{{ number_format($totalVat, 2) }}</td>
        </tr>
        <tr>
            <th>Total Paid (TK)</th>
            <td>{{ number_format($totalPaid, 2) }}</td>
        </tr>
        <tr>
            <th>Total Due (TK)</th>
            <td>{{ number_format($totalDue, 2) }}</td>
        </tr>
        <tr>
            <th>Estimated Profit (TK)</th>
            <td>{{ number_format($profit, 2) }}</td>
        </tr>
    </table>
</div>
@endsection
