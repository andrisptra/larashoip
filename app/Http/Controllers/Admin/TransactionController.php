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
            ->select(
                'products.id',
                'products.name',
                'products.image',
                'products.price',
                'products.cost',
                DB::raw('SUM(transaction_details.quantity) as total_sold'),
                DB::raw('SUM(transaction_details.subtotal) as revenue'),
                DB::raw('SUM((transaction_details.base_price - products.cost) * transaction_details.quantity) as profit')
            )
            ->groupBy('products.id', 'products.name', 'products.image', 'products.price', 'products.cost')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        // Penjualan per periode
        if ($period === 'daily') {
            $salesData = DB::table('transactions')
                ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                ->join('products', 'transaction_details.product_id', '=', 'products.id')
                ->whereBetween('transactions.created_at', [$startDate, $endDate . ' 23:59:59'])
                ->selectRaw('DATE(transactions.created_at) as period')
                ->selectRaw('COUNT(DISTINCT transactions.id) as orders')
                ->selectRaw('SUM(transaction_details.quantity) as items_sold')
                ->selectRaw('SUM(transactions.total_amount) as revenue')
                ->selectRaw('SUM((transaction_details.base_price - products.cost) * transaction_details.quantity) as profit')
                ->groupBy('period')
                ->orderBy('period')
                ->get();
        } elseif ($period === 'monthly') {
            $salesData = DB::table('transactions')
                ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                ->join('products', 'transaction_details.product_id', '=', 'products.id')
                ->whereBetween('transactions.created_at', [$startDate, $endDate . ' 23:59:59'])
                ->selectRaw('DATE_FORMAT(transactions.created_at, "%Y-%m") as period')
                ->selectRaw('COUNT(DISTINCT transactions.id) as orders')
                ->selectRaw('SUM(transaction_details.quantity) as items_sold')
                ->selectRaw('SUM(transactions.total_amount) as revenue')
                ->selectRaw('SUM((transaction_details.base_price - products.cost) * transaction_details.quantity) as profit')
                ->groupBy('period')
                ->orderBy('period')
                ->get();
        } else {
            $salesData = DB::table('transactions')
                ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                ->join('products', 'transaction_details.product_id', '=', 'products.id')
                ->whereBetween('transactions.created_at', [$startDate, $endDate . ' 23:59:59'])
                ->selectRaw('YEAR(transactions.created_at) as period')
                ->selectRaw('COUNT(DISTINCT transactions.id) as orders')
                ->selectRaw('SUM(transaction_details.quantity) as items_sold')
                ->selectRaw('SUM(transactions.total_amount) as revenue')
                ->selectRaw('SUM((transaction_details.base_price - products.cost) * transaction_details.quantity) as profit')
                ->groupBy('period')
                ->orderBy('period')
                ->get();
        }

        return view('admin.statistics', compact('totalRevenue', 'totalOrders', 'totalItemsSold', 'totalProfit', 'topProducts', 'salesData', 'period', 'startDate', 'endDate'));
    }
}
