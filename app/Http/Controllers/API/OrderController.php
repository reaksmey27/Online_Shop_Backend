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
            'shipping_address' => 'required|string|max:500',
            'payment_method'   => 'required|string|in:cash,card,mobile,credit_card,debit_card,paypal,bank_transfer,cash_on_delivery',
            'order_notes'      => 'nullable|string|max:500',
        ]);

        $cartItems = CartItem::with('product')
            ->where('user_id', $request->user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Your cart is empty.'], 422);
        }

        // Validate stock for all items before touching the DB
        foreach ($cartItems as $item) {
            if (! $item->product || ! $item->product->is_active) {
                return response()->json([
                    'message' => "Product \"{$item->product?->name}\" is no longer available.",
                ], 422);
            }
            if ($item->product->stock < $item->quantity) {
                return response()->json([
                    'message' => "Insufficient stock for: {$item->product->name}",
                ], 422);
            }
        }

        $order = null;

        DB::transaction(function () use ($request, $cartItems, &$order) {
            $total = $cartItems->sum(fn ($i) => $i->product->price * $i->quantity);

            // Cash on delivery stays unpaid until delivery; others mark paid
            $paymentStatus = in_array($request->payment_method, ['cash', 'cash_on_delivery']) ? 'unpaid' : 'paid';

            $order = Order::create([
                'user_id'          => $request->user()->id,
                'total_amount'     => $total,
                'status'           => 'pending',
                'shipping_address' => $request->shipping_address,
                'payment_method'   => $request->payment_method,
                'payment_status'   => $paymentStatus,
                'order_notes'      => $request->order_notes,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            CartItem::where('user_id', $request->user()->id)->delete();
        });

        return response()->json([
            'message' => 'Order placed successfully.',
            'order'   => $order?->load('items.product'),
        ], 201);
    }

    /**
     * Customer can cancel their own pending order and restore stock.
     */
    public function cancel(Request $request, $id)
    {
        $order = Order::with('items.product')
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        if ($order->status !== 'pending') {
            return response()->json([
                'message' => 'Only pending orders can be cancelled.',
            ], 422);
        }

        DB::transaction(function () use ($order) {
            // Restore stock
            foreach ($order->items as $item) {
                $item->product?->increment('stock', $item->quantity);
            }

            $order->update([
                'status'         => 'cancelled',
                'payment_status' => 'refunded',
            ]);
        });

        return response()->json([
            'message' => 'Order cancelled successfully.',
            'order'   => $order->fresh('items.product'),
        ]);
    }
}
