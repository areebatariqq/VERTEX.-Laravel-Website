@extends('layouts.app')

@section('title', 'VERTEX — Checkout')

@section('content')
<main class="checkout-section">
    <div class="container">
        <!-- Breadcrumb -->
        <!-- Breadcrumb removed -->

        <!-- Checkout Header -->
        <div class="checkout-header">
            <h1 class="checkout-title">Checkout</h1>
            <p class="checkout-subtitle">Complete your order for modules, workshops, webinars, and competitions</p>
        </div>

        @if(count($cartItems) > 0)
        <div class="checkout-content">
            <!-- Order Summary -->
            <div class="order-summary">
                <h3>Order Summary</h3>
                <div class="summary-items">
                    @foreach($cartItems as $item)
                        <div class="summary-item">
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                            <div class="item-info">
                                <h4>{{ $item['name'] }}</h4>
                                <p>{{ ucfirst($item['type']) }} - Qty: {{ $item['quantity'] }}</p>
                            </div>
                            <span class="item-price">PKR {{ $item['total'] }}/-</span>
                        </div>
                    @endforeach
                </div>
                
                <div class="summary-totals">
                    <div class="total-row">
                        <span>Subtotal:</span>
                        <span>PKR {{ number_format($subtotal) }}/-</span>
                    </div>
                    <div class="total-row">
                        <span>Tax (10%):</span>
                        <span>PKR {{ number_format($tax) }}/-</span>
                    </div>
                    <div class="total-row final-total">
                        <span>Total:</span>
                        <span>PKR {{ number_format($total) }}/-</span>
                    </div>
                </div>
            </div>

            <!-- Personal Information Form -->
            <div class="personal-info-form">
                <h3>Personal Information</h3>
                <p class="form-description">Please provide details for all {{ $maxQuantity }} participant(s) based on your highest quantity selection.</p>
                
                <form method="POST" action="{{ url('/checkout/process') }}" id="checkoutForm">
                    @csrf
                    
                    @for($i = 1; $i <= $maxQuantity; $i++)
                    <div class="participant-section">
                        <h4 class="participant-title">Participant {{ $i }}</h4>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name_{{ $i }}">Full Name</label>
                                <input type="text" id="name_{{ $i }}" name="participants[{{ $i }}][name]" placeholder="Enter full name" required>
                            </div>
                            <div class="form-group">
                                <label for="email_{{ $i }}">Email Address</label>
                                <input type="email" id="email_{{ $i }}" name="participants[{{ $i }}][email]" placeholder="example@email.com" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="mobile_{{ $i }}">Mobile Number</label>
                                <input type="tel" id="mobile_{{ $i }}" name="participants[{{ $i }}][mobile]" placeholder="+92 300 1234567" required>
                            </div>
                            <div class="form-group">
                                <label for="address_{{ $i }}">Address</label>
                                <input type="text" id="address_{{ $i }}" name="participants[{{ $i }}][address]" placeholder="Complete address" required>
                            </div>
                        </div>
                    </div>
                    @endfor
                    
                    <!-- Payment Information -->
                    <div class="payment-section">
                        <h4 class="section-title">Payment Information</h4>
                        <div class="form-group">
                            <label for="payment_method">Payment Method</label>
                            <select id="payment_method" name="payment_method" class="form-control" required>
                                <option value="">Select payment method</option>
                                <option value="cash">Cash on Arrival</option>
                                <option value="card">Credit/Debit Card</option>
                                <option value="online">Online Transfer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="notes">Special Notes (Optional)</label>
                            <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Any special requirements or notes..."></textarea>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <a href="{{ url('/cart') }}" class="back-btn">Back to Cart</a>
                        <button type="submit" class="pay-btn">Complete Registration</button>
                    </div>
                </form>
            </div>
        </div>
        @else
        <!-- Empty Cart Message -->
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
