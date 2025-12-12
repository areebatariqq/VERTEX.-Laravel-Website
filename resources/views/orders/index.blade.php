@extends('layouts.app')

@section('title', 'Orders - VERTEX')

@section('content')
<section class="py-5" style="background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%); min-height: calc(100vh - 150px);">
    <div class="container">
        <div class="mb-4">
            <p class="text-uppercase small mb-1" style="color: rgba(255,255,255,0.6);">Account · Orders</p>
            <h1 class="text-white mb-0">Orders</h1>
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

        @if($orders->count() > 0)
        <div class="card border-0 shadow" style="background: #1a1a1a;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total Amount</th>
                                <th>Payment Method</th>
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
                                    <div>{{ $order->created_at->format('M d, Y') }}</div>
                                    <small class="text-white-50">{{ $order->created_at->format('h:i A') }}</small>
                                </td>
                                <td>{{ $order->orderItems->count() }} item(s)</td>
                                <td>
                                    <span class="fw-bold text-white">PKR {{ number_format($order->total_amount, 2) }}/-</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ ucfirst($order->payment_method) }}</span>
                                </td>
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge bg-info">Processing</span>
                                    @elseif($order->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-light me-1">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    @if($order->status == 'pending')
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-times"></i> Cancel
                                        </button>
                                    </form>
                                    @endif
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
                <i class="fas fa-shopping-bag fa-4x mb-3" style="color: rgba(255,255,255,0.3);"></i>
                <h3 class="text-white mb-3">No Orders Yet</h3>
                <p class="text-white-50 mb-4">You haven't placed any orders yet. Browse our modules and start your journey!</p>
                <a href="{{ route('modules') }}" class="btn btn-warning text-dark fw-semibold">
                    <i class="fas fa-layer-group"></i> Browse Modules
                </a>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
