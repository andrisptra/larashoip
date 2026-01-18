<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $totalRevenue = Transaction::where('status', 'completed')->sum('total_amount');
        $totalOrders = Transaction::where('status', 'completed')->count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $lowStockProducts = Product::where('stock', '<', 10)->count();

        // Recent transactions
        $recentTransactions = Transaction::with('user')
            ->latest()
            ->limit(5)
            ->get();

        // Top selling products
        $topProducts = Product::withCount(['details as total_sold' => function ($query) {
            $query->select(DB::raw('SUM(quantity)'));
        }])
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalProducts',
            'totalCategories',
            'lowStockProducts',
            'recentTransactions',
            'topProducts'
        ));
    }
}
