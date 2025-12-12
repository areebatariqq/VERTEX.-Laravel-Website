<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Display user's order history
    public function index()
    {
        $orders = Auth::user()->orders()
            ->with('orderItems')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    // Show single order details
    public function show($id)
    {
        $order = Auth::user()->orders()
            ->with(['orderItems.module'])
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    // Create order from cart (called during checkout)
    public function store(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to complete your order.');
        }

        $request->validate([
            'payment_method' => 'required|in:cash,card,online',
            'notes' => 'nullable|string|max:500',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }

        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['total'];
        }
        $tax = $subtotal * 0.10;
        $total = $subtotal + $tax;

        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'notes' => $request->notes,
            ]);

            // Create order items
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'module_id' => $item['id'],
                    'module_name' => $item['name'],
                    'module_type' => $item['type'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['total'],
                    'team_members' => $item['team_members'] ?? null,
                ]);
            }

            DB::commit();

            // Clear cart
            session()->forget('cart');

            // Redirect to modules page with success message
            return redirect()->route('modules')
                ->with('success', 'Order placed successfully! Order ID: #' . $order->id . '. You will be notified for date and timings on mail shortly.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Order creation failed: ' . $e->getMessage());
            return redirect()->route('cart')
                ->with('error', 'Failed to create order: ' . $e->getMessage());
        }
    }

    // Update order status (for users - cancel only)
    public function update(Request $request, $id)
    {
        $order = Auth::user()->orders()->findOrFail($id);

        // Users can only cancel pending orders
        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'You can only cancel pending orders.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('orders.index')
            ->with('success', 'Order cancelled successfully.');
    }

    // Admin: View all orders
    public function adminIndex()
    {
        $orders = Order::with(['user', 'orderItems'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    // Admin: Show single order
    public function adminShow($id)
    {
        $order = Order::with(['user', 'orderItems.module'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Admin: Update order status
    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->back()
            ->with('success', 'Order status updated successfully.');
    }

    // Admin: Delete order
    public function adminDestroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
