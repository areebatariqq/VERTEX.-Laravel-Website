@extends('layouts.app')

@section('content')
<main class="cart-section">
    <div class="container">
        <!-- Breadcrumb -->
        <!-- Breadcrumb removed -->

        <!-- Cart Header -->
        <div class="cart-header">
            <h1 class="cart-title">Shopping Cart</h1>
            <p class="cart-subtitle">Review your selected modules, workshops, webinars, and competitions</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="success-icon">✓</i>
                {{ session('success') }}
            </div>
        @endif

        @if(count($cartItems) > 0)
            <!-- Cart Items -->
            <div class="cart-items">
                @foreach($cartItems as $index => $item)
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                        </div>
                        
                        <div class="item-details">
                            <div class="item-header">
                                <h3 class="item-name">{{ $item['name'] }}</h3>
                                <span class="item-type">{{ ucfirst($item['type']) }}</span>
                            </div>
                            
                            <div class="item-info">
                                <div class="price-info">
                                    @if(isset($item['earlybird_price']))
                                        <span class="earlybird-price">Early Bird: PKR {{ $item['earlybird_price'] }}/-</span>
                                    @endif
                                    <span class="regular-price">Price: PKR {{ $item['price'] }}/-</span>
                                </div>
                                
                                <div class="quantity-info">
                                    <span class="quantity-label">Quantity:</span>
                                    <span class="quantity-value">{{ $item['quantity'] }}</span>
                                </div>
                                
                                @if(isset($item['team_members']) && !empty($item['team_members']))
                                <div class="team-info">
                                    <span class="team-label">Team Members:</span>
                                    <div class="team-members">
                                        @foreach($item['team_members'] as $member)
                                            <span class="team-member">{{ $member }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="item-actions">
                            <div class="item-total">
                                <span class="total-label">Total:</span>
                                <span class="total-amount">PKR {{ $item['total'] }}/-</span>
                            </div>
                            <a href="{{ url('/cart/remove/' . $index) }}" class="remove-btn" onclick="return confirm('Are you sure you want to remove this item?')">
                                Remove
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Cart Summary -->
            <div class="cart-summary">
                <div class="summary-header">
                    <h3>Order Summary</h3>
                    <a href="{{ url('/cart') }}" class="generate-summary-btn">
                        Refresh Summary
                    </a>
                </div>
                
                <div class="summary-details" id="order-summary">
                    <div class="summary-row">
                        <span class="summary-label">Subtotal:</span>
                        <span class="summary-value" id="subtotal-display">PKR {{ number_format($subtotal) }}/-</span>
                    </div>
                    
                    <div class="summary-row">
                        <span class="summary-label">Tax (10%):</span>
                        <span class="summary-value" id="tax-display">PKR {{ number_format($tax) }}/-</span>
                    </div>
                    
                    <div class="summary-row total-row">
                        <span class="summary-label">Total:</span>
                        <span class="summary-value" id="total-display">PKR {{ number_format($total) }}/-</span>
                    </div>
                </div>
                
                <div class="checkout-actions">
                    <a href="{{ url('/modules') }}" class="continue-shopping-btn">
                        Continue Shopping
                    </a>
                    <a href="{{ url('/checkout') }}" class="checkout-btn">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="empty-cart">
                <div class="empty-cart-icon">🛒</div>
                <h3>Your cart is empty</h3>
                <p>Add some modules, workshops, webinars, or competitions to get started!</p>
                <a href="{{ url('/modules') }}" class="btn browse-modules-btn">
                    Browse Modules
                </a>
            </div>
        @endif
    </div>
</main>

@endsection
