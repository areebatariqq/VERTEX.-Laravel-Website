@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <main class="container page-content">
        <div class="about-content">
            <div class="about-text">
                <h2>About VERTEX.</h2>
                <p>
                    VERTEX is a dynamic, student-driven e-commerce platform designed to connect learners, innovators, and creators from across the globe through exciting competitions, engaging webinars, and skill-based challenges. Founded with the vision of empowering the youth to explore their potential beyond classrooms, VERTEX provides a digital space where passion meets opportunity.
                </p>
                <p>
                    The platform aims to bridge the gap between education and innovation by allowing participants from various universities and disciplines to collaborate, compete, and grow together. From technology, business, and design to entrepreneurship and social innovation, VERTEX offers diverse modules that cater to every student’s unique interests and skills.
                </p>
                <p>
                    Since its creation, VERTEX has been dedicated to fostering creativity and professional growth among students. Our mission is to cultivate an ecosystem of learning where talent is recognized, ideas are celebrated, and skills are honed for real-world success.
                </p>
                <p>
                    Through interactive webinars, panel talks, and industry-led workshops, participants gain exposure to emerging trends and technologies that shape the future of digital industries. We aim to inspire students to think boldly, innovate fearlessly, and build confidently.
                </p>
            </div>

            <div class="about-images">
                <img src="{{ asset('images/img1.jpg') }}" alt="Competition Event">
                <img src="{{ asset('images/img3.jpg') }}" alt="Workshop Activity">
            </div>
        </div>

        <section class="mission">
            <h3>Our Mission</h3>
            <p>
                At VERTEX, our mission is to empower students to transform their knowledge into action by providing a digital platform where innovation, creativity, and collaboration thrive. We strive to bridge the gap between academic learning and real-world experience through nationwide competitions, interactive webinars, and industry-led workshops.
            </p>
            <p>
                By fostering a culture of curiosity and opportunity, VERTEX aims to equip the youth with the confidence, skills, and exposure they need to become future leaders, entrepreneurs, and changemakers. Our goal is to inspire every participant to push boundaries, think beyond limitations, and rise to their fullest potential.
            </p>
        </section>

        <section class="depts">
            <h3>Organizing Departments</h3>
            <ul>
                <li>Computer Science</li>
                <li>Mechatronics Engineering</li>
                <li>Robotics & Artificial Intelligence</li>
                <li>Software Engineering</li>
            </ul>
        </section>
    </main>
@endsection
