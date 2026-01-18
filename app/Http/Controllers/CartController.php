<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if ($product->stock < $quantity) {
            return back()->with('error', 'Insufficient stock available.');
        }

        if (isset($cart[$product->id])) {
            $newQuantity = $cart[$product->id]['quantity'] + $quantity;
            if ($product->stock < $newQuantity) {
                return back()->with('error', 'Insufficient stock available.');
            }
            $cart[$product->id]['quantity'] = $newQuantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Product added to cart successfully!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart');
        $product = Product::find($request->product_id);

        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        if ($product->stock < $request->quantity) {
            return back()->with('error', "Insufficient stock. Only {$product->stock} items available.");
        }

        $cart[$request->product_id]["quantity"] = $request->quantity;
        session()->put('cart', $cart);
        return back()->with('success', 'Cart updated successfully');
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required'
        ]);

        $cart = session()->get('cart');
        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }
        return back()->with('success', 'Product removed successfully');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        try {
            DB::beginTransaction();

            $total = 0;
            foreach ($cart as $id => $details) {
                $product = Product::find($id);

                if (!$product) {
                    throw new \Exception("Product not found: $id");
                }

                if ($product->stock < $details['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}. Only {$product->stock} available.");
                }

                $total += $details['price'] * $details['quantity'];
            }

            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'transaction_date' => now(),
                'total_amount' => $total,
                'status' => 'completed'
            ]);

            foreach ($cart as $id => $details) {
                $product = Product::find($id);

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'base_price' => $details['price'],
                    'base_cost' => $product->cost,
                    'subtotal' => $details['price'] * $details['quantity']
                ]);

                $product->decrement('stock', $details['quantity']);
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('transactions.show', $transaction)
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }
}
