@extends('layouts.app')

@section('title', 'VERTEX — Vertex Xperience')

@section('content')
    <main id="modules" class="modules-section">
        <div class="container">
        <!-- PAGE HEADING -->
        <h2 class="modules-heading">Vertex Xperience</h2>
        <p class="modules-subheading">
            Explore our diverse range of modules, workshops, webinars, and competitions designed to challenge your skills and creativity.
        </p>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="success-icon">✓</i>
                {{ session('success') }}
            </div>
        @endif


        <!-- ================== MODULES ================== -->
        <h2 class="section-heading">Modules</h2>
        <p class="modules-subheading">
            Structured learning programs and skill-based courses to enhance your expertise.
        </p>

        @if(isset($search) && $search)
            <div class="search-results-info">
                <p>Search results for: <strong>"{{ $search }}"</strong></p>
                <p>Found {{ count($allModules) }} result(s)</p>
            </div>
            
            @if(count($allModules) > 0)
                <div class="search-results">
                    @foreach($allModules as $module)
                        <div class="module-card">
                            <img src="{{ asset('images/' . $module['id'] . '.png') }}" alt="{{ $module['name'] }}" onerror="this.src='{{ asset('images/project.png') }}'">
                            <h3>{{ $module['name'] }}</h3>
                            <p class="description">{{ ucfirst($module['type']) }} - Team: {{ $module['team_min'] }}-{{ $module['team_max'] }}</p>
                            @if($module['earlybird_fee'])
                                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR {{ number_format($module['earlybird_fee']) }}/-</span></p>
                            @endif
                            <p class="fee"><span class="bold-text">Fee: PKR {{ number_format($module['fee']) }}/-</span></p>
                            <a href="{{ url('/module/' . $module['id']) }}" class="btn view-details">View Details</a>
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
        <div class="modules-year">
            <div class="module-card">
                <img src="{{ asset('images/ux-design.png') }}" alt="UI / UX">
                <h3>UI / UX</h3>
                <p class="description">Learn to design user-friendly interfaces for apps and websites.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 2,500/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 3,000/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/ui-ux') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/bridge.png') }}" alt="Bridge Designing">
                <h3>Bridge Designing</h3>
                <p class="description">Construct virtual or model bridges with engineering principles.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 800/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,000/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/bridge-designing') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/software.png') }}" alt="Speed CAD">
                <h3>Speed CAD</h3>
                <p class="description">Master quick and precise CAD designs.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 1,000/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,200/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/speed-cad') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/business-computer.png') }}" alt="Technopreneurship">
                <h3>Technopreneurship</h3>
                <p class="description">Present your major project to peers and mentors.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 1,200/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,500/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/technopreneurship') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/laptop-computer.png') }}" alt="Speed Coding">
                <h3>Speed Coding</h3>
                <p class="description">Solve coding challenges quickly and efficiently.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 2,300/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 2,500/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/speed-coding') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/database.png') }}" alt="Database Designing">
                <h3>Database Designing</h3>
                <p class="description">Structure data for apps and websites effectively.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 1,800/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 2,000/-</span></p>
                <p class="team"><span class="bold-text">Team: 3-5</span></p>
                <a href="{{ url('/module/database-designing') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/model.png') }}" alt="3D Modelling">
                <h3>3D Modelling</h3>
                <p class="description">Create 3D designs for games, models, and prototypes.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 4,800/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 5,000/-</span></p>
                <p class="team"><span class="bold-text">Team: 5-6</span></p>
                <a href="{{ url('/module/3d-modelling') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/cyber-attack.png') }}" alt="Ethical Hacking">
                <h3>Ethical Hacking</h3>
                <p class="description">Explore cybersecurity and protect systems ethically.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 1,800/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 2,000/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/ethical-hacking') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/testing.png') }}" alt="Debugging">
                <h3>Debugging</h3>
                <p class="description">Identify and fix programming errors like a pro.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 3,800/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 4,000/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/debugging') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/graphic-design.png') }}" alt="Graphic Designing">
                <h3>Graphic Designing</h3>
                <p class="description">Learn creative design for digital media.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 1,000/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,200/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/graphic-designing') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/iot.png') }}" alt="Internet Of Things">
                <h3>Internet of Things</h3>
                <p class="description">Connect devices and build smart systems.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 1,200/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,500/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/internet-of-things') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/cyber-security.png') }}" alt="NetQuest">
                <h3>NetQuest</h3>
                <p class="description">Test your networking and cyber knowledge.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 1,000/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,200/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/netquest') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/robot.png') }}" alt="Portable Robo Display">
                <h3>Portable Robo Display</h3>
                <p class="description">Build and showcase small robotic projects.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 1,200/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,500/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/portable-robo-display') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/neural-network.png') }}" alt="Neural Network Design">
                <h3>Neural Network Design</h3>
                <p class="description">Design simple neural networks for AI projects.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 1,500/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,800/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/neural-network-design') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/brain.png') }}" alt="Machine Learning">
                <h3>Machine Learning</h3>
                <p class="description">Learn how machines can learn from data.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 2,000/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 2,500/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/machine-learning') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/start-up.png') }}" alt="Start-up Idea">
                <h3>Start-up Idea</h3>
                <p class="description">Brainstorm and pitch innovative business ideas.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 1,200/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,500/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/startup-idea') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/delivery.png') }}" alt="Line Following Robot">
                <h3>Line Following Robot</h3>
                <p class="description">Build a robot that follows a path automatically.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 1,500/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,800/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/line-following-robot') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/project.png') }}" alt="Final Year Project Showcase">
                <h3>Final Year Project Showcase</h3>
                <p class="description">Present your major project to peers and mentors.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 1,200/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,500/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/final-year-project-showcase') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/logical-thinking.png') }}" alt="Logic Designing">
                <h3>Logic Designing</h3>
                <p class="description">Practice logical thinking through circuits and designs.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 1,000/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,200/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/logic-designing') }}" class="btn view-details">View Details</a>
            </div>

            <div class="module-card">
                <img src="{{ asset('images/robotic-arm.png') }}" alt="RoboWar">
                <h3>RoboWar</h3>
                <p class="description">Compete in building and battling robots.</p>
                <p class="earlybird-fee"><span class="bold-text">Early Bird: PKR 1,500/-</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,800/-</span></p>
                <p class="team"><span class="bold-text">Team: 1-2</span></p>
                <a href="{{ url('/module/robowar') }}" class="btn view-details">View Details</a>
            </div>
        </div>

        <!-- ================== WORKSHOPS ================== -->
        <h2 class="section-heading">Workshops</h2>
        <p class="workshops-subheading">
            Hands-on short programs and crash courses to boost your practical skills.
        </p>
        <div class="workshops-year">
            <div class="workshop-card">
                <img src="{{ asset('images/python.png') }}" alt="Python Bootcamp">
                <h3>Python Bootcamp</h3>
                <p class="description">Hands-on Python coding workshop for beginners.</p>
                <p class="duration"><span class="bold-text">Duration: 2 hours</span></p>
                <p class="fee"><span class="bold-text">Fee: PKR 500/-</span></p>
                <a href="{{ url('/module/python-bootcamp') }}" class="btn view-details">View Details</a>
            </div>

            <div class="workshop-card">
                <img src="{{ asset('images/robotic-surgery.png') }}" alt="Robotics Hands-On">
                <h3>Robotics Hands-On</h3>
                <p class="description">Build and program your first robot from scratch.</p>
                <p class="duration"><span class="bold-text">Duration: 3 hours</span></p>
                <p class="fee"><span class="bold-text">Fee: PKR 700/-</span></p>
                <a href="{{ url('/module/robotics-hands-on') }}" class="btn view-details">View Details</a>
            </div>

            <div class="workshop-card">
                <img src="{{ asset('images/pen-tool.png') }}" alt="Graphic Design Crash Course">
                <h3>Graphic Design Crash Course</h3>
                <p class="description">Learn essential tools and techniques for digital design.</p>
                <p class="duration"><span class="bold-text">Duration: 3 hours</span></p>
                <p class="fee"><span class="bold-text">Fee: PKR 700/-</span></p>
                <a href="{{ url('/module/graphic-design-crash-course') }}" class="btn view-details">View Details</a>
            </div>

            <div class="workshop-card">
                <img src="{{ asset('images/animation.png') }}" alt="Animation Basics">
                <h3>Animation Basics</h3>
                <p class="description">Create simple animations and motion graphics.</p>
                <p class="duration"><span class="bold-text">Duration: 3 hours</span></p>
                <p class="fee"><span class="bold-text">Fee: PKR 700/-</span></p>
                <a href="{{ url('/module/animation-basics') }}" class="btn view-details">View Details</a>
            </div>
        </div>

        <!-- ================== WEBINARS ================== -->
        <h2 class="section-heading">Webinars</h2>
        <p class="webinars-subheading">
            Expert talks, lectures, and online sessions to expand your knowledge.
        </p>
        <div class="webinars-year">
            <div class="webinars-card">
                <img src="{{ asset('images/artificial-intelligence.png') }}" alt="AI in 2026">
                <h3>AI in 2026</h3>
                <p class="description">Explore the future of artificial intelligence with an expert.</p>
                <p class="speaker"><span class="bold-text">Speaker: Mr. Ahmed</span></p>
                <p class="date"><span class="bold-text">Date: 25th Jan 2026</span></p>
                <p class="fee"><span class="bold-text">Fee: PKR 300/-</span></p>
                <a href="{{ url('/module/ai-in-2026') }}" class="btn view-details">View Details</a>
            </div>

            <div class="webinars-card">
                <img src="{{ asset('images/idea.png') }}" alt="Startups 101">
                <h3>Startups 101</h3>
                <p class="description">Learn the fundamentals of launching and running a startup.</p>
                <p class="speaker"><span class="bold-text">Speaker: Ms. Sana</span></p>
                <p class="date"><span class="bold-text">Date: 28th Jan 2026</span></p>
                <p class="fee"><span class="bold-text">Fee: PKR 300/-</span></p>
                <a href="{{ url('/module/startups-101') }}" class="btn view-details">View Details</a>
            </div>
        </div>

        <!-- ================== COMPETITIONS ================== -->
        <h2 class="section-heading">Competitions</h2>
        <p class="competitions-subheading">
            Challenge yourself and compete for exciting prizes.
        </p>
        <div class="competitions-year">
            <div class="competition-card">
                <img src="{{ asset('images/agile.png') }}" alt="Code Sprint">
                <h3>Code Sprint 2026</h3>
                <p class="description">Solve coding challenges in a timed competitive environment.</p>
                <p class="team"><span class="bold-text">Team: 1-3</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 800/-</span></p>
                <p class="prize"><span class="bold-text">Prize: PKR 10,000/-</span></p>
                <a href="{{ url('/module/code-sprint-2026') }}" class="btn view-details">View Details</a>
            </div>

            <div class="competition-card">
                <img src="{{ asset('images/hackathon.png') }}" alt="Hackathon">
                <h3>Hackathon</h3>
                <p class="description">Collaborate to create innovative tech solutions in a set time.</p>
                <p class="team"><span class="bold-text">Team: 2-4</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,200/-</span></p>
                <p class="prize"><span class="bold-text">Prize: PKR 15,000/-</span></p>
                <a href="{{ url('/module/hackathon') }}" class="btn view-details">View Details</a>
            </div>

            <div class="competition-card">
                <img src="{{ asset('images/military-robot.png') }}" alt="RoboWar Challenge">
                <h3>RoboWar Challenge</h3>
                <p class="description">Compete with your robot against others in battles.</p>
                <p class="team"><span class="bold-text">Team: 2-4</span></p>
                <p class="fee"><span class="bold-text">Entry Fee: PKR 1,200/-</span></p>
                <p class="prize"><span class="bold-text">Prize: PKR 15,000/-</span></p>
                <a href="{{ url('/module/robowar-challenge') }}" class="btn view-details">View Details</a>
            </div>
        </div>
        @endif
    </main>

@endsection