<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Journal;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->start_date ?? now()->startOfMonth()->toDateString();
        $end = $request->end_date ?? now()->endOfMonth()->toDateString();

        $sales = Sale::whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59'])->get();

        $totalSales = $sales->sum('subtotal');
        $totalDiscount = $sales->sum('discount');
        $totalVat = $sales->sum('vat');
        $totalPaid = $sales->sum('paid_amount');
        $totalDue = $sales->sum('due_amount');

    
        $cogs = 0;
        foreach ($sales as $sale) {
            foreach ($sale->items as $item) {
                $cogs += $item->quantity * $item->product->purchase_price;
            }
        }

        $profit = $totalSales - $totalDiscount - $cogs;

        return view('reports.index', compact('start', 'end', 'totalSales', 'totalDiscount', 'totalVat', 'totalPaid', 'totalDue', 'profit'));
    }
}
