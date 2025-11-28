@extends('layouts.app')

@section('title', 'VERTEX — Vertex Xperience')

@section('content')
    <main id="modules" class="modules-section">
        <div class="container">
            <!-- PAGE HEADING -->
            <h2 class="modules-heading">Vertex Xperience</h2>
            <p class="modules-subheading">
                Explore our diverse range of modules, workshops, webinars, and competitions designed to challenge your
                skills and creativity.
            </p>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="success-icon">✓</i>
                    {{ session('success') }}
                </div>
            @endif

            @if(isset($search) && $search)
                <div class="search-results-info">
                    <p>Search results for: <strong>"{{ $search }}"</strong></p>
                    <p>Found {{ count($modules) }} result(s)</p>
                </div>

                @if(count($modules) > 0)
                    <div class="search-results">
                        @foreach($modules as $module)
                            <div class="module-card">
                                <img src="{{ asset($module->image) }}" alt="{{ $module->name }}"
                                    onerror="this.src='{{ asset('images/project.png') }}'">
                                <h3>{{ $module->name }}</h3>
                                <p class="description">{{ ucfirst($module->type) }} - Team:
                                    {{ $module->team_min }}-{{ $module->team_max }}</p>
                                @if($module->earlybird_fee)
                                    <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR
                                            {{ number_format($module->earlybird_fee) }}/-</span></p>
                                @endif
                                <p class="fee"><span class="bold-text">Fee: PKR {{ number_format($module->fee) }}/-</span></p>
                                <a href="{{ url('/module/' . $module->slug) }}" class="btn view-details">View Details</a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-results">
                        <h3>No results found</h3>
                        <p>Try adjusting your search terms.</p>
                    </div>
                @endif
            @else
                <!-- ================== MODULES ================== -->
                <h2 class="section-heading">Modules</h2>
                <p class="modules-subheading">
                    Structured learning programs and skill-based courses to enhance your expertise.
                </p>
                <div class="modules-year">
                    @foreach($modules->where('type', 'module') as $module)
                        <div class="module-card">
                            <img src="{{ asset($module->image) }}" alt="{{ $module->name }}"
                                onerror="this.src='{{ asset('images/project.png') }}'">
                            <h3>{{ $module->name }}</h3>
                            <p class="description">{{ Str::limit($module->description, 100) }}</p>
                            @if($module->earlybird_fee)
                                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR
                                        {{ number_format($module->earlybird_fee) }}/-</span></p>
                            @endif
                            <p class="fee"><span class="bold-text">Entry Fee: PKR {{ number_format($module->fee) }}/-</span></p>
                            <p class="team"><span class="bold-text">Team: {{ $module->team_min }}-{{ $module->team_max }}</span></p>
                            <a href="{{ url('/module/' . $module->slug) }}" class="btn view-details">View Details</a>
                        </div>
                    @endforeach
                </div>

                <!-- ================== WORKSHOPS ================== -->
                <h2 class="section-heading">Workshops</h2>
                <p class="workshops-subheading">
                    Hands-on short programs and crash courses to boost your practical skills.
                </p>
                <div class="workshops-year">
                    @foreach($modules->where('type', 'workshop') as $module)
                        <div class="workshop-card">
                            <img src="{{ asset($module->image) }}" alt="{{ $module->name }}"
                                onerror="this.src='{{ asset('images/project.png') }}'">
                            <h3>{{ $module->name }}</h3>
                            <p class="description">{{ Str::limit($module->description, 100) }}</p>
                            @if($module->duration)
                                <p class="duration"><span class="bold-text">Duration: {{ $module->duration }}</span></p>
                            @endif
                            <p class="fee"><span class="bold-text">Fee: PKR {{ number_format($module->fee) }}/-</span></p>
                            <a href="{{ url('/module/' . $module->slug) }}" class="btn view-details">View Details</a>
                        </div>
                    @endforeach
                </div>

                <!-- ================== WEBINARS ================== -->
                <h2 class="section-heading">Webinars</h2>
                <p class="webinars-subheading">
                    Expert talks, lectures, and online sessions to expand your knowledge.
                </p>
                <div class="webinars-year">
                    @foreach($modules->where('type', 'webinar') as $module)
                        <div class="webinars-card">
                            <img src="{{ asset($module->image) }}" alt="{{ $module->name }}"
                                onerror="this.src='{{ asset('images/project.png') }}'">
                            <h3>{{ $module->name }}</h3>
                            <p class="description">{{ Str::limit($module->description, 100) }}</p>
                            @if($module->date)
                                <p class="date"><span class="bold-text">Date:
                                        {{ \Carbon\Carbon::parse($module->date)->format('jS M Y') }}</span></p>
                            @endif
                            <p class="fee"><span class="bold-text">Fee: PKR {{ number_format($module->fee) }}/-</span></p>
                            <a href="{{ url('/module/' . $module->slug) }}" class="btn view-details">View Details</a>
                        </div>
                    @endforeach
                </div>

                <!-- ================== COMPETITIONS ================== -->
                <h2 class="section-heading">Competitions</h2>
                <p class="competitions-subheading">
                    Challenge yourself and compete for exciting prizes.
                </p>
                <div class="competitions-year">
                    @foreach($modules->where('type', 'competition') as $module)
                        <div class="competition-card">
                            <img src="{{ asset($module->image) }}" alt="{{ $module->name }}"
                                onerror="this.src='{{ asset('images/project.png') }}'">
                            <h3>{{ $module->name }}</h3>
                            <p class="description">{{ Str::limit($module->description, 100) }}</p>
                            <p class="team"><span class="bold-text">Team: {{ $module->team_min }}-{{ $module->team_max }}</span></p>
                            <p class="fee"><span class="bold-text">Entry Fee: PKR {{ number_format($module->fee) }}/-</span></p>
                            <a href="{{ url('/module/' . $module->slug) }}" class="btn view-details">View Details</a>
                        </div>
                    @endforeach
                </div>
            @endif
    </main>

@endsection