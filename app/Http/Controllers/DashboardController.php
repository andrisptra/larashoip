<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get user's recent transactions
        $recentTransactions = Transaction::where('user_id', $user->id)
            ->with(['details.product'])
            ->latest()
            ->take(5)
            ->get();

        // Get all products for browsing
        $products = Product::with('category')
            ->where('stock', '>', 0)
            ->latest()
            ->paginate(8);

        // Get categories
        $categories = Category::withCount('products')->get();

        return view('dashboard', compact('recentTransactions', 'products', 'categories'));
    }
}
