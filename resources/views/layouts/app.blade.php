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
    
    <style>
        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-name {
            color: #fff;
            font-weight: 500;
            white-space: nowrap;
        }
        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            white-space: nowrap;
        }
        .logout-btn:hover {
            background: #c82333;
        }
        .main-nav a {
            position: relative;
            white-space: nowrap;
        }
        
        /* User Info Section */
        .user-info-section {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-shrink: 0;
            margin-left: 20px;
        }
        
        .current-user {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .user-icon {
            font-size: 1.2rem;
        }
        
        .current-user .user-name {
            font-size: 14px;
            font-weight: 500;
            color: #fff;
        }
        
        /* Adjust search container */
        .search-container {
            flex-shrink: 0;
            margin-left: 0;
            margin-right: 0;
        }
        
        /* Ensure proper layout */
        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 10px 20px !important;
        }
        
        @media (max-width: 1200px) {
            .main-nav {
                gap: 20px;
            }
            .search-input {
                width: 150px !important;
            }
            .current-user .user-name {
                display: none;
            }
        }
        
        @media (max-width: 992px) {
            .main-nav {
                gap: 15px;
                font-size: 14px;
            }
            .logo img {
                height: 80px !important;
            }
            .user-info-section {
                margin-left: 10px;
            }
        }
    </style>

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
            
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.modules.index') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}" style="color: #ffc107 !important; font-weight: 600;">
                        Admin
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Register</a>
            @endauth
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

        <!-- User Info & Logout -->
        @auth
        <div class="user-info-section">
            <div class="current-user">
                <span class="user-icon">👤</span>
                <span class="user-name">{{ auth()->user()->name }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="display: inline; margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
        @endauth
    </div>
</header>

{{-- MAIN CONTENT --}}
<main>
    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 20px auto; max-width: 1200px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 20px auto; max-width: 1200px;">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 20px auto; max-width: 1200px;">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
