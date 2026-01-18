<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'details.product')
            ->latest()
            ->paginate(15);

        return view('admin.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('details.product', 'user');
        return view('admin.transactions.show', compact('transaction'));
    }

    public function statistics(Request $request)
    {
        $period = $request->get('period', 'daily');
        $startDate = $request->get('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->format('Y-m-d'));

        // Total omset dan keuntungan
        $totalRevenue = Transaction::whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
            ->sum('total_amount');
        $totalOrders = Transaction::whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
            ->count();
        $totalItemsSold = TransactionDetail::join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->whereBetween('transactions.created_at', [$startDate, $endDate . ' 23:59:59'])
            ->sum('transaction_details.quantity');
        $totalProfit = TransactionDetail::join('products', 'transaction_details.product_id', '=', 'products.id')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->whereBetween('transactions.created_at', [$startDate, $endDate . ' 23:59:59'])
            ->selectRaw('SUM((transaction_details.base_price - products.cost) * transaction_details.quantity) as profit')
            ->value('profit') ?? 0;

        // Produk terlaris
        $topProducts = DB::table('transaction_details')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->whereBetween('transactions.created_at', [$startDate, $endDate . ' 23:59:59'])
            ->select('products.name', DB::raw('SUM(transaction_details.quantity) as total_sold'))
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        // Penjualan per periode
        if ($period === 'daily') {
            $salesData = Transaction::selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(total_amount) as revenue')
                ->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
                ->groupBy('date')
                ->orderBy('date')
                ->get();
        } elseif ($period === 'monthly') {
            $salesData = Transaction::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count, SUM(total_amount) as revenue')
                ->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        } else {
            $salesData = Transaction::selectRaw('YEAR(created_at) as year, COUNT(*) as count, SUM(total_amount) as revenue')
                ->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
                ->groupBy('year')
                ->orderBy('year')
                ->get();
        }

        return view('admin.statistics', compact('totalRevenue', 'totalOrders', 'totalItemsSold', 'totalProfit', 'topProducts', 'salesData', 'period', 'startDate', 'endDate'));
    }
}
