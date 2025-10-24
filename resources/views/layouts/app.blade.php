<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="VERTEX - Inter-University Competition Event Platform">
    <meta name="keywords" content="competition, university, technology, innovation, vertex">
    <title>@yield('title', 'VERTEX')</title>

    {{-- Preconnect for performance --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Google Font - Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap for responsiveness --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('extra_css')
</head>
<body>

{{-- HEADER --}}
<header class="site-header">
    <div class="container nav-container">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="VERTEX Logo">
        </a>
        <nav class="main-nav">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
            <a href="{{ route('modules') }}" class="{{ request()->routeIs('modules') ? 'active' : '' }}">Vertex Xperience</a>
            <a href="{{ route('cart') }}" class="{{ request()->routeIs('cart') ? 'active' : '' }}">
                <i class="cart-icon">🛒</i> Cart
            </a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </nav>
        
        <!-- Search Bar -->
        <div class="search-container">
            <form action="{{ route('modules') }}" method="GET" class="search-form">
                <div class="search-input-group">
                    <input type="text" name="search" placeholder="Search modules, workshops, webinars, competitions..." 
                           value="{{ request('search') }}" class="search-input">
                    <button type="submit" class="search-btn">
                        <i class="search-icon">Search</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</header>

{{-- MAIN CONTENT --}}
<main>
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="site-footer">
    <div class="container footer-grid">

        <div class="footer-col">
            <strong>VERTEX.</strong>
            <p>Inter-University Competition Event Platform connecting students worldwide through innovation and technology.</p>
        </div>


        <div class="footer-col">
            <strong>Useful Links</strong>
            <ul>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Support</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <strong>Contact</strong>
            <p>VERTEX.</p>
            <p>District East, Block 14</p>
            <p>Near Civic Center</p>
            <p>Karachi, Pakistan</p>
            <p><a href="mailto:vertex@gmail.com">vertex@gmail.com</a></p>
        </div>
    </div>

    <div class="copyright">
        <p>&copy; {{ date('Y') }} VERTEX. All rights reserved.</p>
    </div>
</footer>

{{-- Bootstrap JS Bundle --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@yield('extra_js')

</body>
</html>
