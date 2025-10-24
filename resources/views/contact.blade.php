@extends('layouts.app')

@section('title', 'VERTEX — Contact')

@section('content')
    <main class="contact-page">
        <div class="container">
            <!-- Page Header -->
            <div class="contact-header">
                <h1 class="page-title">Contact Us</h1>
                <p class="page-subtitle">Get in touch with the VERTEX team. We're here to help and answer any questions you may have.</p>
            </div>

            <div class="contact-content">
                <!-- Contact Information -->
                <section class="contact-info-section">
                    <div class="info-card">
                        <h3>Contact Information</h3>
                        <form class="contact-form" onsubmit="event.preventDefault(); showMessage('contact');">
                            <div class="form-group">
                                <label for="contact-address">Address</label>
                                <input type="text" id="contact-address" name="address">
                            </div>
                            <div class="form-group">
                                <label for="contact-email">Email</label>
                                <input type="email" id="contact-email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="contact-phone">Phone</label>
                                <input type="tel" id="contact-phone" name="phone">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Contact Info</button>
                        </form>
                    </div>
                </section>

                <!-- Social Media Links -->
                <section class="social-media-section">
                    <div class="info-card">
                        <h3>Follow Us</h3>
                        <div class="social-links">
                            <a href="#" class="social-link instagram">
                                <span class="social-icon">📷</span>
                                <span class="social-platform">Instagram</span>
                                <span class="social-handle">@vertex_official</span>
                            </a>
                            <a href="#" class="social-link facebook">
                                <span class="social-icon">📘</span>
                                <span class="social-platform">Facebook</span>
                                <span class="social-handle">Vertex University</span>
                            </a>
                            <a href="#" class="social-link linkedin">
                                <span class="social-icon">💼</span>
                                <span class="social-platform">LinkedIn</span>
                                <span class="social-handle">Vertex University</span>
                            </a>
                            <a href="#" class="social-link twitter">
                                <span class="social-icon">🐦</span>
                                <span class="social-platform">Twitter</span>
                                <span class="social-handle">@vertex_university</span>
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Brand Ambassador Application -->
                <section class="ambassador-section">
                    <div class="info-card ambassador-card">
                        <h3>Apply for Brand Ambassador</h3>
                        <p>Join our team as a VERTEX Brand Ambassador and help promote our events across universities. Represent VERTEX and earn exciting rewards!</p>
                        
                        <div class="ambassador-benefits">
                            <h4>Benefits:</h4>
                            <ul>
                                <li>Exclusive merchandise and goodies</li>
                                <li>Certificate of recognition</li>
                                <li>Networking opportunities</li>
                                <li>Performance-based rewards</li>
                                <li>Leadership experience</li>
                            </ul>
                        </div>

                        <form class="ambassador-form" onsubmit="event.preventDefault(); showMessage('ambassador');">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="ambassador-name">Full Name *</label>
                                    <input type="text" id="ambassador-name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="ambassador-reg">Registration Number *</label>
                                    <input type="text" id="ambassador-reg" name="reg_number" required>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="ambassador-uni">University Name *</label>
                                    <input type="text" id="ambassador-uni" name="university" required>
                                </div>
                                <div class="form-group">
                                    <label for="ambassador-degree">Degree Program *</label>
                                    <input type="text" id="ambassador-degree" name="degree" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="ambassador-phone">Phone Number *</label>
                                    <input type="tel" id="ambassador-phone" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="ambassador-email">Email Address *</label>
                                    <input type="email" id="ambassador-email" name="email" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ambassador-experience">Previous Experience (Optional)</label>
                                <textarea id="ambassador-experience" name="experience" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="ambassador-motivation">Why do you want to be a VERTEX Brand Ambassador? *</label>
                                <textarea id="ambassador-motivation" name="motivation" rows="4" required></textarea>
                            </div>

                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="terms" required>
                                    <span class="checkmark"></span>
                                    I agree to the terms and conditions and understand that this is a voluntary position.
                                </label>
                            </div>

                            <button type="submit" class="btn btn-ambassador">Apply Now</button>
                        </form>
                    </div>
                </section>

                <!-- Newsletter section removed -->
            </div>
        </div>

        <!-- Success Messages -->
        <div id="success-message" class="success-message" style="display: none;">
            <div class="message-content">
                <h3>Thank You!</h3>
                <p id="message-text"></p>
            </div>
        </div>
    </main>

    <script>
        function showMessage(type) {
            const messageDiv = document.getElementById('success-message');
            const messageText = document.getElementById('message-text');
            
            let message = '';
            switch(type) {
                case 'contact':
                    message = 'Your contact information has been submitted successfully. We will get back to you soon.';
                    break;
                case 'ambassador':
                    message = 'Thank you for applying to be a VERTEX Brand Ambassador! We will review your application and contact you shortly if you are shortlisted.';
                    break;
                // Newsletter case removed
            }
            
            messageText.textContent = message;
            messageDiv.style.display = 'flex';
            
            // Hide message after 5 seconds
            setTimeout(() => {
                messageDiv.style.display = 'none';
            }, 5000);
        }
    </script>
@endsection
