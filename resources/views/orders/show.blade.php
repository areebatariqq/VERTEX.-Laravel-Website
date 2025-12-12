@extends('layouts.app')

@section('title', 'Order Details - VERTEX')

@section('content')
<section class="py-5" style="background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%); min-height: calc(100vh - 150px);">
    <div class="container">
        <!-- Header -->
        <div class="mb-4">
            <a href="{{ route('orders.index') }}" class="text-warning text-decoration-none mb-2 d-inline-block">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
            <p class="text-uppercase small mb-1" style="color: rgba(255,255,255,0.6);">Order · Details</p>
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

                <!-- Participant Information -->
                @if(session('checkout_participants'))
                <div class="card border-0 shadow" style="background: #1a1a1a;">
                    <div class="card-body p-4">
                        <h4 class="text-white mb-4">Participant Information</h4>
                        @foreach(session('checkout_participants') as $index => $participant)
                        <div class="mb-3 pb-3" style="border-bottom: 1px solid #333;">
                            <h6 class="text-warning mb-2">Participant {{ $index }}</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <small class="text-white-50 d-block">Name:</small>
                                    <p class="text-white mb-2">{{ $participant['name'] }}</p>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-white-50 d-block">Email:</small>
                                    <p class="text-white mb-2">{{ $participant['email'] }}</p>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-white-50 d-block">Mobile:</small>
                                    <p class="text-white mb-2">{{ $participant['mobile'] }}</p>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-white-50 d-block">Address:</small>
                                    <p class="text-white mb-2">{{ $participant['address'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Order Summary Sidebar -->
            <div class="col-lg-4">
                <!-- Order Status -->
                <div class="card border-0 shadow mb-4" style="background: #1a1a1a;">
                    <div class="card-body p-4">
                        <h5 class="text-white mb-3">Order Status</h5>
                        <div class="text-center mb-3">
                            @if($order->status == 'pending')
                                <div class="mb-2">
                                    <i class="fas fa-clock fa-3x text-warning"></i>
                                </div>
                                <span class="badge bg-warning text-dark fs-6">Pending</span>
                            @elseif($order->status == 'processing')
                                <div class="mb-2">
                                    <i class="fas fa-spinner fa-3x text-info"></i>
                                </div>
                                <span class="badge bg-info fs-6">Processing</span>
                            @elseif($order->status == 'completed')
                                <div class="mb-2">
                                    <i class="fas fa-check-circle fa-3x text-success"></i>
                                </div>
                                <span class="badge bg-success fs-6">Completed</span>
                            @else
                                <div class="mb-2">
                                    <i class="fas fa-times-circle fa-3x text-danger"></i>
                                </div>
                                <span class="badge bg-danger fs-6">Cancelled</span>
                            @endif
                        </div>
                        <div class="text-center text-white-50 small">
                            Order placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="card border-0 shadow" style="background: #1a1a1a;">
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

                        @if($order->notes)
                        <div class="mb-3">
                            <small class="text-white-50 d-block mb-1">Notes:</small>
                            <p class="text-white small mb-0">{{ $order->notes }}</p>
                        </div>
                        @endif

                        @if($order->status == 'pending')
                        <form action="{{ route('orders.update', $order->id) }}" method="POST" class="mt-3" onsubmit="return confirm('Are you sure you want to cancel this order?')">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-outline-danger w-100">
                                <i class="fas fa-times"></i> Cancel Order
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
