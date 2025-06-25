<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('items.product')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_ids.*' => 'required|exists:products,id',
            'quantities.*' => 'required|integer|min:1',
            'paid_amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $subtotal = 0;
            $items = [];

            foreach ($request->product_ids as $index => $productId) {
                $product = Product::findOrFail($productId);
                $qty = $request->quantities[$index];

                if ($product->stock < $qty) {
                    throw new \Exception("Not enough stock for {$product->name}");
                }

                $subtotal += $product->sell_price * $qty;
                $items[] = [
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'unit_price' => $product->sell_price,
                ];

                $product->decrement('stock', $qty);
            }

            $discount = $request->discount ?? 0;
            $vat = ($subtotal - $discount) * 0.05;
            $total = $subtotal - $discount + $vat;
            $paid = $request->paid_amount;
            $due = $total - $paid;

            $sale = Sale::create([
                'subtotal' => $subtotal,
                'discount' => $discount,
                'vat' => $vat,
                'total' => $total,
                'paid_amount' => $paid,
                'due_amount' => $due,
            ]);

            foreach ($items as $item) {
                $item['sale_id'] = $sale->id;
                SaleItem::create($item);
            }

            Journal::insert([
                ['sale_id' => $sale->id, 'type' => 'sales', 'amount' => $subtotal, 'created_at' => now(), 'updated_at' => now()],
                ['sale_id' => $sale->id, 'type' => 'discount', 'amount' => $discount, 'created_at' => now(), 'updated_at' => now()],
                ['sale_id' => $sale->id, 'type' => 'vat', 'amount' => $vat, 'created_at' => now(), 'updated_at' => now()],
                ['sale_id' => $sale->id, 'type' => 'payment', 'amount' => $paid, 'created_at' => now(), 'updated_at' => now()],
                ['sale_id' => $sale->id, 'type' => 'due', 'amount' => $due, 'created_at' => now(), 'updated_at' => now()],
            ]);
        });

        return redirect()->route('sales.index')->with('success', 'Sale completed successfully.');
    }
}
