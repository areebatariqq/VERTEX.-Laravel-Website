@extends('layouts.app')

@section('title', 'VERTEX — Home')

@section('content')
    <!-- HERO SECTION -->
    <section class="hero">
        <video autoplay muted loop playsinline class="bg-video">
            <source src="{{ asset('videos/bg-video.mp4') }}" type="video/mp4">
        </video>

        <div class="hero-inner container hero-content">
            <h1 class="hero-title">Reach the Vertex of Innovation.</h1>
            <p class="hero-date">24 &amp; 27 May 2027</p>
            <p class="hero-sub">Inter-University Competition Organized By Departments Of:</p>
            <p class="hero-depts">
                Computer Science • Mechatronics Engineering • Robotics &amp; AI • Software Engineering
            </p>
            <a href="{{ url('/modules') }}" class="btn primary">Register Now</a>
        </div>
    </section>

    <!-- QUICK HIGHLIGHTS -->
    <section class="highlights container">
        <div class="card">20+ Competitions</div>
        <div class="card">Workshops & Seminars</div>
        <div class="card">University Showcase</div>
    </section>

    <!-- EARLY BIRD BANNER -->
    <section class="early-bird-banner">
        <div class="banner-content">
            <h2>HURRY UP! <span>Avail Early Bird Discount</span></h2>
            <p>Sign up now and save big on all modules, workshops & competitions!</p>
            <a href="{{ url('/modules#modules') }}" class="btn banner-btn">Grab Your Spot</a>
        </div>
    </section>
@endsection
