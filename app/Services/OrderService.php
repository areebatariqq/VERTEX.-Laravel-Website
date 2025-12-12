<?php
namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Get all orders.
     */
    public function getAllOrders()
    {
        return Order::with(['user', 'orderItems'])->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get a single order.
     */
    public function showOrder($id)
    {
        return Order::with(['user', 'orderItems.module'])->findOrFail($id);
    }

    /**
     * Create a new order.
     */
    public function createOrder(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subtotal' => 'required|numeric',
            'tax' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'payment_method' => 'required|in:cash,card,online',
            'notes' => 'nullable|string|max:500',
            'items' => 'required|array',
            'items.*.module_id' => 'required|exists:modules,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => $request->user_id,
                'subtotal' => $request->subtotal,
                'tax' => $request->tax,
                'total_amount' => $request->total_amount,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'notes' => $request->notes,
            ]);

            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'module_id' => $item['module_id'],
                    'module_name' => $item['module_name'] ?? '',
                    'module_type' => $item['module_type'] ?? '',
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['quantity'] * $item['price'],
                    'team_members' => $item['team_members'] ?? null,
                ]);
            }

            DB::commit();
            return ['success' => true, 'message' => 'Order created successfully!', 'order_id' => $order->id];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Something went wrong. Please try again later.'];
        }
    }

    /**
     * Update an order's status.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($request->id);

        if ($order) {
            try {
                $order->update(['status' => $request->status]);
                return ['success' => true, 'message' => 'Order updated successfully!'];
            } catch (\Exception $e) {
                Log::error('Update Failed. ' . $e->getMessage());
                return ['success' => false, 'message' => 'Something went wrong. Please try again later.'];
            }
        }

        return ['success' => false, 'message' => 'Invalid Order ID'];
    }

    /**
     * Delete an order.
     */
    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);

        try {
            $order->delete();
            return ['success' => true, 'message' => 'Order deleted successfully!'];
        } catch (\Exception $e) {
            Log::error('Delete operation failed. ' . $e->getMessage());
            return ['success' => false, 'message' => 'Something went wrong. Please try again later.'];
        }
    }
}
