<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('items.product')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json($orders);
    }

    public function show(Request $request, $id)
    {
        $order = Order::with('items.product')
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        return response()->json($order);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'payment_method'   => 'required|string',
        ]);

        $cartItems = CartItem::with('product')
            ->where('user_id', $request->user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 422);
        }

        // Check stock for all items
        foreach ($cartItems as $item) {
            if ($item->product->stock < $item->quantity) {
                return response()->json([
                    'message' => "Insufficient stock for: {$item->product->name}"
                ], 422);
            }
        }

        $order = null;

        DB::transaction(function () use ($request, $cartItems, &$order) {
            $total = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);

            $order = Order::create([
                'user_id'          => $request->user()->id,
                'total_amount'     => $total,
                'status'           => 'pending',
                'shipping_address' => $request->shipping_address,
                'payment_method'   => $request->payment_method,
                'payment_status'   => 'unpaid',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);

                // Deduct stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear cart
            CartItem::where('user_id', $request->user()->id)->delete();
        });

        return response()->json([
            'message' => 'Order placed successfully',
            'order'   => $order?->load('items.product'),
        ], 201);
    }
}