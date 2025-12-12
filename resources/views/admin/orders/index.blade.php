@extends('layouts.app')

@section('title', 'Admin - Manage Orders')

@section('content')
<section class="py-5" style="background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%); min-height: calc(100vh - 150px);">
    <div class="container">
        <div class="mb-4">
            <p class="text-uppercase small mb-1" style="color: rgba(255,255,255,0.6);">Admin · Orders</p>
            <h1 class="text-white mb-0">Manage Orders</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow" style="background: rgba(74, 144, 226, 0.1); border-left: 4px solid #4a90e2 !important;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-white-50 small mb-1">Total Orders</p>
                                <h3 class="text-white mb-0">{{ $stats['total_orders'] }}</h3>
                            </div>
                            <i class="fas fa-shopping-cart fa-2x" style="color: #4a90e2; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow" style="background: rgba(255, 193, 7, 0.1); border-left: 4px solid #ffc107 !important;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-white-50 small mb-1">Pending</p>
                                <h3 class="text-white mb-0">{{ $stats['pending_orders'] }}</h3>
                            </div>
                            <i class="fas fa-clock fa-2x" style="color: #ffc107; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow" style="background: rgba(76, 175, 80, 0.1); border-left: 4px solid #4caf50 !important;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-white-50 small mb-1">Completed</p>
                                <h3 class="text-white mb-0">{{ $stats['completed_orders'] }}</h3>
                            </div>
                            <i class="fas fa-check-circle fa-2x" style="color: #4caf50; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow" style="background: rgba(76, 175, 80, 0.1); border-left: 4px solid #4caf50 !important;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-white-50 small mb-1">Total Revenue</p>
                                <h3 class="text-white mb-0">PKR {{ number_format($stats['total_revenue'], 0) }}</h3>
                            </div>
                            <i class="fas fa-dollar-sign fa-2x" style="color: #4caf50; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        @if($orders->count() > 0)
        <div class="card border-0 shadow" style="background: #1a1a1a;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>
                                    <span class="fw-bold text-warning">#{{ $order->id }}</span>
                                </td>
                                <td>
                                    <div>{{ $order->user->name }}</div>
                                    <small class="text-white-50">{{ $order->user->email }}</small>
                                </td>
                                <td>
                                    <div>{{ $order->created_at->format('M d, Y') }}</div>
                                    <small class="text-white-50">{{ $order->created_at->format('h:i A') }}</small>
                                </td>
                                <td>{{ $order->orderItems->count() }} item(s)</td>
                                <td>
                                    <span class="fw-bold text-white">PKR {{ number_format($order->total_amount, 2) }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ ucfirst($order->payment_method) }}</span>
                                </td>
                                <td>
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-select form-select-sm bg-dark text-white border-secondary" style="width: auto; display: inline-block;" onchange="if(confirm('Update order status?')) this.form.submit()">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-light me-1">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this order?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
        @endif

        @else
        <div class="card border-0 shadow" style="background: #1a1a1a;">
            <div class="card-body p-5 text-center">
                <i class="fas fa-shopping-cart fa-4x mb-3" style="color: rgba(255,255,255,0.3);"></i>
                <h3 class="text-white mb-3">No Orders Yet</h3>
                <p class="text-white-50 mb-0">No orders have been placed yet.</p>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
