@extends('layouts.app')

@section('title', 'VERTEX — ' . $module['name'])

@section('content')
    <main class="module-detail-section">
        <div class="container">
            <!-- Breadcrumb -->
            <!-- Breadcrumb removed -->

            <!-- Module Detail Content -->
            <div class="module-detail-content">
                <!-- Left Side - Image -->
                <div class="module-image-section">
                    <img src="{{ asset($module['image']) }}" alt="{{ $module['name'] }}" class="module-image">
                </div>

                <!-- Right Side - Module Info -->
                <div class="module-info-section">
                    <h1 class="module-title">{{ $module['name'] }}</h1>
                    
                    <!-- Pricing -->
                    <div class="pricing-section">
                        @if(isset($module['earlybird_fee']))
                            <div class="price-item earlybird">
                                <span class="price-label">Early Bird:</span>
                                <span class="price-value">PKR {{ $module['earlybird_fee'] }}/-</span>
                            </div>
                        @endif
                        <div class="price-item regular">
                            <span class="price-label">
                                @if($module['type'] == 'workshop') Duration: {{ $module['duration'] ?? 'N/A' }}
                                @elseif($module['type'] == 'webinar') Fee:
                                @elseif($module['type'] == 'competition') Entry Fee:
                                @else Entry Fee:
                                @endif
                            </span>
                            <span class="price-value">PKR {{ $module['fee'] }}/-</span>
                        </div>
                        @if(isset($module['team']))
                            <div class="team-info">
                                <span class="team-label">Team:</span>
                                <span class="team-value">{{ $module['team'] }}</span>
                            </div>
                        @endif
                        @if(isset($module['prize']))
                            <div class="prize-info">
                                <span class="prize-label">Prize:</span>
                                <span class="prize-value">PKR {{ $module['prize'] }}/-</span>
                            </div>
                        @endif
                    </div>

                    <!-- Divider Line -->
                    <div class="divider-line"></div>

                    <!-- Description -->
                    <div class="description-section">
                        <h3>Description</h3>
                        <p>{{ $module['description'] }}</p>
                    </div>

                    <!-- Quantity Selector -->
                    <div class="quantity-section">
                        <label for="quantity">Team Size:</label>
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn minus" onclick="changeQuantity(-1)">-</button>
                            <input type="number" id="quantity" name="quantity" value="{{ $module['team_min'] }}" min="{{ $module['team_min'] }}" max="{{ $module['team_max'] }}" readonly>
                            <button type="button" class="quantity-btn plus" onclick="changeQuantity(1)">+</button>
                        </div>
                        <p class="team-info-text">Team size: {{ $module['team'] }} members</p>
                    </div>

                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="success-icon">✓</i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-error">
                            <i class="error-icon">✗</i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Add to Cart Form -->
                    <form method="POST" action="{{ url('/cart/add') }}" class="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="module_id" value="{{ $module['id'] }}">
                        <input type="hidden" name="module_name" value="{{ $module['name'] }}">
                        <input type="hidden" name="module_type" value="{{ $module['type'] }}">
                        <input type="hidden" name="module_image" value="{{ $module['image'] }}">
                        <input type="hidden" name="module_fee" value="{{ $module['fee'] }}">
                        <input type="hidden" name="quantity" id="quantity-hidden" value="{{ $module['team_min'] }}">
                        
                        <div class="action-buttons">
                            <button type="submit" class="btn add-to-cart-btn">
                                <i class="cart-icon">🛒</i> Add to Cart
                            </button>
                            <button type="button" class="btn return-btn" onclick="goBack()">
                                <i class="return-icon">←</i> Return to Previous Page
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Student Reviews Section -->
            <div class="reviews-section">
                <h2 class="reviews-title">Student Reviews</h2>
                
                <!-- Review Form -->
                <div class="review-form">
                    <form id="reviewForm" onsubmit="submitReview(event)">
                        <div class="form-group">
                            <label for="reviewerName">Your Name:</label>
                            <input type="text" id="reviewerName" name="reviewerName" required>
                        </div>

                        <div class="form-group">
                            <label>Rating:</label>
                            <div class="rating-selector">
                                <input type="radio" id="excellent" name="rating" value="5">
                                <label for="excellent" class="rating-option">
                                    <span class="stars">★★★★★</span>
                                    <span class="rating-text">Excellent</span>
                                </label>

                                <input type="radio" id="good" name="rating" value="4">
                                <label for="good" class="rating-option">
                                    <span class="stars">★★★★</span>
                                    <span class="rating-text">Good</span>
                                </label>

                                <input type="radio" id="average" name="rating" value="3">
                                <label for="average" class="rating-option">
                                    <span class="stars">★★★</span>
                                    <span class="rating-text">Average</span>
                                </label>

                                <input type="radio" id="poor" name="rating" value="2">
                                <label for="poor" class="rating-option">
                                    <span class="stars">★★</span>
                                    <span class="rating-text">Poor</span>
                                </label>

                                <input type="radio" id="worst" name="rating" value="1">
                                <label for="worst" class="rating-option">
                                    <span class="stars">★</span>
                                    <span class="rating-text">Worst</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment">Your Comment:</label>
                            <textarea id="comment" name="comment" rows="4" placeholder="Share your experience with this module..." required></textarea>
                        </div>

                        <button type="submit" class="btn submit-review-btn">Submit Review</button>
                    </form>
                </div>

                <!-- Thank You Message -->
                <div id="thank-you-message" class="thank-you-message" style="display: none;">
                    <i class="thank-you-icon">💙</i>
                    <h3>Thank you for your comment!</h3>
                    <p>Your review has been submitted successfully.</p>
                </div>
            </div>
        </div>
    </main>


    <script>
        let currentQuantity = {{ $module['team_min'] }};

        function changeQuantity(change) {
            const quantityInput = document.getElementById('quantity');
            const hiddenQuantity = document.getElementById('quantity-hidden');
            const newQuantity = currentQuantity + change;
            const min = parseInt(quantityInput.min);
            const max = parseInt(quantityInput.max);
            
            if (newQuantity >= min && newQuantity <= max) {
                currentQuantity = newQuantity;
                quantityInput.value = currentQuantity;
                hiddenQuantity.value = currentQuantity;
            }
        }

        function goBack() {
            window.history.back();
        }

        function submitReview(event) {
            event.preventDefault();
            
            const form = document.getElementById('reviewForm');
            const thankYouMessage = document.getElementById('thank-you-message');
            
            // Hide form and show thank you message
            form.style.display = 'none';
            thankYouMessage.style.display = 'block';
        }
    </script>
@endsection
