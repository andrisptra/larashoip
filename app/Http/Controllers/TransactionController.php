<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        if ($product->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Insufficient stock available.'])->withInput();
        }

        DB::transaction(function () use ($request, $product) {
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'transaction_date' => now(),
                'total_amount' => $product->price * $request->quantity,
                'status' => 'completed',
            ]);

            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'base_price' => $product->price,
                'base_cost' => $product->cost,
                'subtotal' => $product->price * $request->quantity,
            ]);

            $product->decrement('stock', $request->quantity);
        });

        return back()->with('success', 'Transaction completed successfully.');
    }

    public function index()
    {
        $transactions = Transaction::with('details.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $transaction->load('details.product', 'user');

        return view('transactions.show', compact('transaction'));
    }
}
