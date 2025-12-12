@extends('layouts.app')

@section('title', 'Admin - Order Details')

@section('content')
<section class="py-5" style="background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%); min-height: calc(100vh - 150px);">
    <div class="container">
        <!-- Header -->
        <div class="mb-4">
            <a href="{{ route('admin.orders.index') }}" class="text-warning text-decoration-none mb-2 d-inline-block">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
            <p class="text-uppercase small mb-1" style="color: rgba(255,255,255,0.6);">Admin · Order Details</p>
            <h1 class="text-white mb-0">Order #{{ $order->id }}</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- Order Information -->
            <div class="col-lg-8">
                <!-- Customer Info -->
                <div class="card border-0 shadow mb-4" style="background: #1a1a1a;">
                    <div class="card-body p-4">
                        <h4 class="text-white mb-4">Customer Information</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-white-50 d-block mb-1">Name:</small>
                                <p class="text-white mb-3">{{ $order->user->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-white-50 d-block mb-1">Email:</small>
                                <p class="text-white mb-3">{{ $order->user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="card border-0 shadow mb-4" style="background: #1a1a1a;">
                    <div class="card-body p-4">
                        <h4 class="text-white mb-4">Order Items</h4>
                        
                        @foreach($order->orderItems as $item)
                        <div class="row mb-3 pb-3" style="border-bottom: 1px solid #333;">
                            <div class="col-md-2">
                                @if($item->module && $item->module->image)
                                <img src="{{ asset($item->module->image) }}" alt="{{ $item->module_name }}" class="img-fluid rounded">
                                @else
                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                                    <i class="fas fa-image text-white-50"></i>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-7">
                                <h5 class="text-white mb-1">{{ $item->module_name }}</h5>
                                <p class="text-white-50 mb-2">
                                    <span class="badge bg-{{ $item->module_type == 'workshop' ? 'primary' : ($item->module_type == 'competition' ? 'success' : 'info') }}">
                                        {{ ucfirst($item->module_type) }}
                                    </span>
                                </p>
                                
                                @if($item->team_members && count($item->team_members) > 0)
                                <div class="mt-2">
                                    <small class="text-white-50 d-block mb-1">Team Members:</small>
                                    @foreach($item->team_members as $member)
                                        <span class="badge bg-dark text-white me-1 mb-1">{{ $member }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <div class="col-md-3 text-md-end">
                                <div class="text-white-50 mb-1">Qty: {{ $item->quantity }}</div>
                                <div class="text-white-50 mb-1">PKR {{ number_format($item->price, 2) }}/-</div>
                                <div class="fw-bold text-warning">PKR {{ number_format($item->total, 2) }}/-</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="col-lg-4">
                <!-- Order Status -->
                <div class="card border-0 shadow mb-4" style="background: #1a1a1a;">
                    <div class="card-body p-4">
                        <h5 class="text-white mb-3">Update Status</h5>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select bg-dark text-white border-secondary mb-3">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-warning text-dark w-100">
                                <i class="fas fa-save"></i> Update Status
                            </button>
                        </form>

                        <div class="text-center text-white-50 small mt-3">
                            Current Status:
                            @if($order->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($order->status == 'processing')
                                <span class="badge bg-info">Processing</span>
                            @elseif($order->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="card border-0 shadow mb-4" style="background: #1a1a1a;">
                    <div class="card-body p-4">
                        <h5 class="text-white mb-3">Order Summary</h5>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-white-50">Subtotal:</span>
                            <span class="text-white">PKR {{ number_format($order->subtotal, 2) }}/-</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-white-50">Tax (10%):</span>
                            <span class="text-white">PKR {{ number_format($order->tax, 2) }}/-</span>
                        </div>
                        
                        <hr style="border-color: #333;">
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-white fw-bold">Total:</span>
                            <span class="text-warning fw-bold fs-5">PKR {{ number_format($order->total_amount, 2) }}/-</span>
                        </div>

                        <div class="mb-3">
                            <small class="text-white-50 d-block mb-1">Payment Method:</small>
                            <span class="badge bg-secondary">{{ ucfirst($order->payment_method) }}</span>
                        </div>

                        <div class="mb-3">
                            <small class="text-white-50 d-block mb-1">Order Date:</small>
                            <p class="text-white small mb-0">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>

                        @if($order->notes)
                        <div class="mb-3">
                            <small class="text-white-50 d-block mb-1">Customer Notes:</small>
                            <p class="text-white small mb-0">{{ $order->notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Delete Order -->
                <div class="card border-0 shadow" style="background: #1a1a1a;">
                    <div class="card-body p-4">
                        <h5 class="text-white mb-3">Danger Zone</h5>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100">
                                <i class="fas fa-trash"></i> Delete Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
