<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);

        if ($product->stock < $quantity) {
            return back()->with('error', 'Insufficient stock available.');
        }

        // Get or create cart for user
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        // Check if product already in cart
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;
            if ($product->stock < $newQuantity) {
                return back()->with('error', 'Insufficient stock available.');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price
            ]);
        }

        return back()->with('success', 'Product added to cart successfully!');
    }

    public function viewCart()
    {
        $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();
        $cartItems = $cart ? $cart->items : collect();
        return view('cart.index', compact('cartItems'));
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::find($request->product_id);

        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        if ($product->stock < $request->quantity) {
            return back()->with('error', "Insufficient stock. Only {$product->stock} items available.");
        }

        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $request->product_id)
                ->first();

            if ($cartItem) {
                $cartItem->update(['quantity' => $request->quantity]);
            }
        }

        return back()->with('success', 'Cart updated successfully');
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required'
        ]);

        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            CartItem::where('cart_id', $cart->id)
                ->where('product_id', $request->product_id)
                ->delete();
        }

        return back()->with('success', 'Product removed successfully');
    }

    public function checkout(Request $request)
    {
        $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        try {
            DB::beginTransaction();

            $total = 0;
            foreach ($cart->items as $item) {
                $product = $item->product;

                if (!$product) {
                    throw new \Exception("Product not found");
                }

                if ($product->stock < $item->quantity) {
                    throw new \Exception("Insufficient stock for {$product->name}. Only {$product->stock} available.");
                }

                $total += $item->price * $item->quantity;
            }

            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'transaction_date' => now(),
                'total_amount' => $total,
                'status' => 'completed'
            ]);

            foreach ($cart->items as $item) {
                $product = $item->product;

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'base_price' => $item->price,
                    'base_cost' => $product->cost,
                    'subtotal' => $item->price * $item->quantity
                ]);

                $product->decrement('stock', $item->quantity);
            }

            DB::commit();

            // Clear cart after checkout
            $cart->items()->delete();

            return redirect()->route('transactions.show', $transaction)
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }
}
