<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(): View
    {
        return view('index');
    }

    /**
     * Display the about us page.
     */
    public function about(): View
    {
        return view('about');
    }

    /**
     * Display the modules/vertex xperience page.
     */
    public function modules(Request $request): View
    {
        // Get all modules data - comprehensive list
        $allModules = [
            // Modules
            'ui-ux' => [
                'id' => 'ui-ux',
                'name' => 'UI / UX',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 3000,
                'earlybird_fee' => 2500
            ],
            'bridge-designing' => [
                'id' => 'bridge-designing',
                'name' => 'Bridge Designing',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 3,
                'fee' => 1500,
                'earlybird_fee' => 1200
            ],
            'speed-cad' => [
                'id' => 'speed-cad',
                'name' => 'Speed CAD',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1200,
                'earlybird_fee' => 1000
            ],
            'technopreneurship' => [
                'id' => 'technopreneurship',
                'name' => 'Technopreneurship',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1800,
                'earlybird_fee' => 1500
            ],
            'speed-coding' => [
                'id' => 'speed-coding',
                'name' => 'Speed Coding',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1400,
                'earlybird_fee' => 1200
            ],
            'database-designing' => [
                'id' => 'database-designing',
                'name' => 'Database Designing',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1600,
                'earlybird_fee' => 1300
            ],
            '3d-modelling' => [
                'id' => '3d-modelling',
                'name' => '3D Modelling',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 2000,
                'earlybird_fee' => 1700
            ],
            'ethical-hacking' => [
                'id' => 'ethical-hacking',
                'name' => 'Ethical Hacking',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 2200,
                'earlybird_fee' => 1900
            ],
            'debugging' => [
                'id' => 'debugging',
                'name' => 'Debugging',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1300,
                'earlybird_fee' => 1100
            ],
            'graphic-designing' => [
                'id' => 'graphic-designing',
                'name' => 'Graphic Designing',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1700,
                'earlybird_fee' => 1400
            ],
            'internet-of-things' => [
                'id' => 'internet-of-things',
                'name' => 'Internet of Things',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1900,
                'earlybird_fee' => 1600
            ],
            'netquest' => [
                'id' => 'netquest',
                'name' => 'NetQuest',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1200,
                'earlybird_fee' => 1000
            ],
            'portable-robo-display' => [
                'id' => 'portable-robo-display',
                'name' => 'Portable Robo Display',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1500,
                'earlybird_fee' => 1200
            ],
            'neural-network-design' => [
                'id' => 'neural-network-design',
                'name' => 'Neural Network Design',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1800,
                'earlybird_fee' => 1500
            ],
            'machine-learning' => [
                'id' => 'machine-learning',
                'name' => 'Machine Learning',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 2500,
                'earlybird_fee' => 2000
            ],
            'startup-idea' => [
                'id' => 'startup-idea',
                'name' => 'Start-ups 101',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1500,
                'earlybird_fee' => 1200
            ],
            'line-following-robot' => [
                'id' => 'line-following-robot',
                'name' => 'Line Following Robot',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1800,
                'earlybird_fee' => 1500
            ],
            'final-year-project-showcase' => [
                'id' => 'final-year-project-showcase',
                'name' => 'Final Year Project Showcase',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1500,
                'earlybird_fee' => 1200
            ],
            'logic-designing' => [
                'id' => 'logic-designing',
                'name' => 'Logic Designing',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1200,
                'earlybird_fee' => 1000
            ],
            'robowar' => [
                'id' => 'robowar',
                'name' => 'RoboWar',
                'type' => 'module',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1800,
                'earlybird_fee' => 1500
            ],
            
            // Workshops
            'python-bootcamp' => [
                'id' => 'python-bootcamp',
                'name' => 'Python Bootcamp',
                'type' => 'workshop',
                'team_min' => 1,
                'team_max' => 1,
                'fee' => 800,
                'earlybird_fee' => null
            ],
            'robotics-hands-on' => [
                'id' => 'robotics-hands-on',
                'name' => 'Robotics Hands-On',
                'type' => 'workshop',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1200,
                'earlybird_fee' => null
            ],
            'web-development' => [
                'id' => 'web-development',
                'name' => 'Web Development',
                'type' => 'workshop',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1000,
                'earlybird_fee' => null
            ],
            'mobile-app-development' => [
                'id' => 'mobile-app-development',
                'name' => 'Mobile App Development',
                'type' => 'workshop',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1300,
                'earlybird_fee' => null
            ],
            'data-science' => [
                'id' => 'data-science',
                'name' => 'Data Science',
                'type' => 'workshop',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1500,
                'earlybird_fee' => null
            ],
            'graphic-design-crash-course' => [
                'id' => 'graphic-design-crash-course',
                'name' => 'Graphic Design Crash Course',
                'type' => 'workshop',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1200,
                'earlybird_fee' => null
            ],
            'animation-basics' => [
                'id' => 'animation-basics',
                'name' => 'Animation Basics',
                'type' => 'workshop',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 1400,
                'earlybird_fee' => null
            ],
            
            // Webinars
            'ai-in-2026' => [
                'id' => 'ai-in-2026',
                'name' => 'AI in 2026',
                'type' => 'webinar',
                'team_min' => 1,
                'team_max' => 1,
                'fee' => 500,
                'earlybird_fee' => null
            ],
            'cybersecurity-trends' => [
                'id' => 'cybersecurity-trends',
                'name' => 'Cybersecurity Trends',
                'type' => 'webinar',
                'team_min' => 1,
                'team_max' => 1,
                'fee' => 400,
                'earlybird_fee' => null
            ],
            'cloud-computing' => [
                'id' => 'cloud-computing',
                'name' => 'Cloud Computing',
                'type' => 'webinar',
                'team_min' => 1,
                'team_max' => 1,
                'fee' => 600,
                'earlybird_fee' => null
            ],
            'blockchain-technology' => [
                'id' => 'blockchain-technology',
                'name' => 'Blockchain Technology',
                'type' => 'webinar',
                'team_min' => 1,
                'team_max' => 1,
                'fee' => 700,
                'earlybird_fee' => null
            ],
            'iot-innovation' => [
                'id' => 'iot-innovation',
                'name' => 'IoT Innovation',
                'type' => 'webinar',
                'team_min' => 1,
                'team_max' => 1,
                'fee' => 550,
                'earlybird_fee' => null
            ],
            'startups-101' => [
                'id' => 'startups-101',
                'name' => 'Startups 101',
                'type' => 'webinar',
                'team_min' => 1,
                'team_max' => 1,
                'fee' => 600,
                'earlybird_fee' => null
            ],
            
            // Competitions
            'code-sprint-2026' => [
                'id' => 'code-sprint-2026',
                'name' => 'Code Sprint 2026',
                'type' => 'competition',
                'team_min' => 1,
                'team_max' => 3,
                'fee' => 1000,
                'earlybird_fee' => null
            ],
            'hackathon' => [
                'id' => 'hackathon',
                'name' => 'Hackathon',
                'type' => 'competition',
                'team_min' => 2,
                'team_max' => 4,
                'fee' => 1500,
                'earlybird_fee' => null
            ],
            'robowar-challenge' => [
                'id' => 'robowar-challenge',
                'name' => 'RoboWar Challenge',
                'type' => 'competition',
                'team_min' => 2,
                'team_max' => 4,
                'fee' => 1200,
                'earlybird_fee' => null
            ],
            'app-development-contest' => [
                'id' => 'app-development-contest',
                'name' => 'App Development Contest',
                'type' => 'competition',
                'team_min' => 1,
                'team_max' => 3,
                'fee' => 800,
                'earlybird_fee' => null
            ],
            'data-analysis-competition' => [
                'id' => 'data-analysis-competition',
                'name' => 'Data Analysis Competition',
                'type' => 'competition',
                'team_min' => 1,
                'team_max' => 2,
                'fee' => 900,
                'earlybird_fee' => null
            ]
        ];

        // Apply search filter only
        $search = $request->get('search');
        if ($search) {
            $searchTerm = strtolower(trim($search));
            $allModules = array_filter($allModules, function($module) use ($searchTerm) {
                $moduleName = strtolower($module['name']);
                
                // Direct name match
                if (strpos($moduleName, $searchTerm) !== false) {
                    return true;
                }
                
                // Handle common variations
                $variations = [
                    'startup' => ['startup', 'start-ups', 'startups'],
                    'cad' => ['cad', 'speed cad'],
                    'python' => ['python', 'bootcamp'],
                    'robotics' => ['robotics', 'robot', 'robo'],
                    'ai' => ['ai', 'artificial intelligence'],
                    'hackathon' => ['hackathon', 'hack'],
                    'web' => ['web', 'website', 'development'],
                    'mobile' => ['mobile', 'app'],
                    'data' => ['data', 'analysis', 'science'],
                    'cyber' => ['cyber', 'security'],
                    'cloud' => ['cloud', 'computing'],
                    'blockchain' => ['blockchain', 'crypto'],
                    'iot' => ['iot', 'internet of things'],
                    '3d' => ['3d', 'modelling', 'modeling'],
                    'graphic' => ['graphic', 'design'],
                    'animation' => ['animation', 'animate'],
                    'machine' => ['machine', 'learning'],
                    'neural' => ['neural', 'network'],
                    'ethical' => ['ethical', 'hacking'],
                    'debug' => ['debug', 'debugging'],
                    'database' => ['database', 'db'],
                    'logic' => ['logic', 'designing'],
                    'bridge' => ['bridge', 'designing'],
                    'ui' => ['ui', 'ux', 'user interface'],
                    'ux' => ['ux', 'ui', 'user experience']
                ];
                
                foreach ($variations as $key => $terms) {
                    if (in_array($searchTerm, $terms)) {
                        foreach ($terms as $term) {
                            if (strpos($moduleName, $term) !== false) {
                                return true;
                            }
                        }
                    }
                }
                
                return false;
            });
        }

        return view('modules', compact('allModules', 'search'));
    }

    /**
     * Display the contact page.
     */
    public function contact(): View
    {
        return view('contact');
    }

    /**
     * Display the module detail page.
     */
    public function moduleDetail($id): View
    {
        // Module data - in a real app, this would come from a database
        $modules = [
            'ui-ux' => [
                'id' => 'ui-ux',
                'name' => 'UI / UX',
                'image' => 'images/ux-design.png',
                'description' => 'Learn to design user-friendly interfaces for apps and websites. Master the principles of user experience design, create wireframes, prototypes, and beautiful interfaces that users love.',
                'earlybird_fee' => '2,500',
                'fee' => '3,000',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'bridge-designing' => [
                'id' => 'bridge-designing',
                'name' => 'Bridge Designing',
                'image' => 'images/bridge.png',
                'description' => 'Construct virtual or model bridges with engineering principles. Learn structural analysis, load calculations, and create impressive bridge designs using modern engineering software.',
                'earlybird_fee' => '1,200',
                'fee' => '1,500',
                'team_min' => 1,
                'team_max' => 3,
                'team' => '1-3',
                'type' => 'module'
            ],
            'speed-cad' => [
                'id' => 'speed-cad',
                'name' => 'Speed CAD',
                'image' => 'images/software.png',
                'description' => 'Master quick and precise CAD designs. Learn advanced CAD techniques, shortcuts, and create professional technical drawings in record time.',
                'earlybird_fee' => '1,000',
                'fee' => '1,200',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'python-bootcamp' => [
                'id' => 'python-bootcamp',
                'name' => 'Python Bootcamp',
                'image' => 'images/python.png',
                'description' => 'Hands-on Python coding workshop for beginners. Learn Python fundamentals, data structures, and build your first applications in this intensive workshop.',
                'duration' => '3 hours',
                'fee' => '800',
                'team_min' => 1,
                'team_max' => 1,
                'team' => '1',
                'type' => 'workshop'
            ],
            'robotics-hands-on' => [
                'id' => 'robotics-hands-on',
                'name' => 'Robotics Hands-On',
                'image' => 'images/robotic-surgery.png',
                'description' => 'Build and program your first robot from scratch. Learn robotics fundamentals, programming, and create a working robot that you can take home.',
                'duration' => '4 hours',
                'fee' => '1,200',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'workshop'
            ],
            'ai-in-2026' => [
                'id' => 'ai-in-2026',
                'name' => 'AI in 2026',
                'image' => 'images/artificial-intelligence.png',
                'description' => 'Explore the future of artificial intelligence with an expert. Learn about cutting-edge AI technologies, machine learning trends, and what to expect in the coming years.',
                'speaker' => 'Mr. Ahmed',
                'date' => '25th Jan 2026',
                'fee' => '500',
                'team_min' => 1,
                'team_max' => 1,
                'team' => '1',
                'type' => 'webinar'
            ],
            'code-sprint-2026' => [
                'id' => 'code-sprint-2026',
                'name' => 'Code Sprint 2026',
                'image' => 'images/agile.png',
                'description' => 'Solve coding challenges in a timed competitive environment. Test your programming skills against other participants in this exciting coding competition.',
                'team_min' => 1,
                'team_max' => 3,
                'team' => '1-3',
                'fee' => '1,000',
                'prize' => '15,000',
                'type' => 'competition'
            ],
            'hackathon' => [
                'id' => 'hackathon',
                'name' => 'Hackathon',
                'image' => 'images/hackathon.png',
                'description' => 'Collaborate to create innovative tech solutions in a set time. Work in teams to build amazing projects and compete for exciting prizes.',
                'team_min' => 2,
                'team_max' => 4,
                'team' => '2-4',
                'fee' => '1,500',
                'prize' => '25,000',
                'type' => 'competition'
            ],
            'graphic-design-crash-course' => [
                'id' => 'graphic-design-crash-course',
                'name' => 'Graphic Design Crash Course',
                'image' => 'images/pen-tool.png',
                'description' => 'Learn essential tools and techniques for digital design. Master Adobe Creative Suite, create stunning visuals, and develop your creative skills in this intensive workshop.',
                'duration' => '2 hours',
                'fee' => '900',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'workshop'
            ],
            'animation-basics' => [
                'id' => 'animation-basics',
                'name' => 'Animation Basics',
                'image' => 'images/animation.png',
                'description' => 'Create simple animations and motion graphics. Learn the fundamentals of animation, keyframe techniques, and bring your ideas to life with professional animation tools.',
                'duration' => '3 hours',
                'fee' => '1,100',
                'team_min' => 1,
                'team_max' => 1,
                'team' => '1',
                'type' => 'workshop'
            ],
            'startups-101' => [
                'id' => 'startups-101',
                'name' => 'Startups 101',
                'image' => 'images/idea.png',
                'description' => 'Learn the fundamentals of launching and running a startup. Discover business strategies, funding options, and how to turn your innovative ideas into successful ventures.',
                'speaker' => 'Ms. Sana',
                'date' => '28th Jan 2026',
                'fee' => '400',
                'team_min' => 1,
                'team_max' => 1,
                'team' => '1',
                'type' => 'webinar'
            ],
            'robowar-challenge' => [
                'id' => 'robowar-challenge',
                'name' => 'RoboWar Challenge',
                'image' => 'images/military-robot.png',
                'description' => 'Compete with your robot against others in battles. Design, build, and program your robot to compete in exciting robotic combat challenges.',
                'team_min' => 2,
                'team_max' => 5,
                'team' => '2-5',
                'fee' => '2,000',
                'prize' => '30,000',
                'type' => 'competition'
            ],
            'technopreneurship' => [
                'id' => 'technopreneurship',
                'name' => 'Technopreneurship',
                'image' => 'images/business-computer.png',
                'description' => 'Present your major project to peers and mentors. Learn to pitch your ideas, develop business plans, and turn your technical skills into entrepreneurial ventures.',
                'earlybird_fee' => '1,200',
                'fee' => '1,500',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'speed-coding' => [
                'id' => 'speed-coding',
                'name' => 'Speed Coding',
                'image' => 'images/laptop-computer.png',
                'description' => 'Solve coding challenges quickly and efficiently. Master algorithms, data structures, and competitive programming techniques to become a faster, more efficient coder.',
                'earlybird_fee' => '2,300',
                'fee' => '2,500',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'database-designing' => [
                'id' => 'database-designing',
                'name' => 'Database Designing',
                'image' => 'images/database.png',
                'description' => 'Structure data for apps and websites effectively. Learn database design principles, normalization, indexing, and create efficient database schemas for real-world applications.',
                'earlybird_fee' => '1,800',
                'fee' => '2,000',
                'team_min' => 3,
                'team_max' => 5,
                'team' => '3-5',
                'type' => 'module'
            ],
            '3d-modelling' => [
                'id' => '3d-modelling',
                'name' => '3D Modelling',
                'image' => 'images/model.png',
                'description' => 'Create 3D designs for games, models, and prototypes. Master 3D modeling software, learn texturing, lighting, and create stunning 3D assets for various applications.',
                'earlybird_fee' => '4,800',
                'fee' => '5,000',
                'team_min' => 5,
                'team_max' => 6,
                'team' => '5-6',
                'type' => 'module'
            ],
            'ethical-hacking' => [
                'id' => 'ethical-hacking',
                'name' => 'Ethical Hacking',
                'image' => 'images/cyber-attack.png',
                'description' => 'Explore cybersecurity and protect systems ethically. Learn penetration testing, vulnerability assessment, and ethical hacking techniques to secure digital systems.',
                'earlybird_fee' => '1,800',
                'fee' => '2,000',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'debugging' => [
                'id' => 'debugging',
                'name' => 'Debugging',
                'image' => 'images/testing.png',
                'description' => 'Identify and fix programming errors like a pro. Master debugging techniques, learn to use debugging tools, and develop systematic approaches to solve complex programming issues.',
                'earlybird_fee' => '3,800',
                'fee' => '4,000',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'graphic-designing' => [
                'id' => 'graphic-designing',
                'name' => 'Graphic Designing',
                'image' => 'images/graphic-design.png',
                'description' => 'Learn creative design for digital media. Master design principles, typography, color theory, and create stunning visual content for various digital platforms.',
                'earlybird_fee' => '1,000',
                'fee' => '1,200',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'internet-of-things' => [
                'id' => 'internet-of-things',
                'name' => 'Internet of Things',
                'image' => 'images/iot.png',
                'description' => 'Connect devices and build smart systems. Learn IoT architecture, sensor integration, data collection, and create connected solutions for smart environments.',
                'earlybird_fee' => '1,200',
                'fee' => '1,500',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'netquest' => [
                'id' => 'netquest',
                'name' => 'NetQuest',
                'image' => 'images/cyber-security.png',
                'description' => 'Test your networking and cyber knowledge. Challenge yourself with network security scenarios, learn about protocols, and master cybersecurity fundamentals.',
                'earlybird_fee' => '1,000',
                'fee' => '1,200',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'portable-robo-display' => [
                'id' => 'portable-robo-display',
                'name' => 'Portable Robo Display',
                'image' => 'images/robot.png',
                'description' => 'Build and showcase small robotic projects. Learn robotics fundamentals, programming, and create impressive robotic displays for competitions and exhibitions.',
                'earlybird_fee' => '1,200',
                'fee' => '1,500',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'neural-network-design' => [
                'id' => 'neural-network-design',
                'name' => 'Neural Network Design',
                'image' => 'images/neural-network.png',
                'description' => 'Design simple neural networks for AI projects. Learn the fundamentals of artificial neural networks, backpropagation, and create your first AI models.',
                'earlybird_fee' => '1,500',
                'fee' => '1,800',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'machine-learning' => [
                'id' => 'machine-learning',
                'name' => 'Machine Learning',
                'image' => 'images/brain.png',
                'description' => 'Learn how machines can learn from data. Master supervised and unsupervised learning algorithms, data preprocessing, and build predictive models.',
                'earlybird_fee' => '2,000',
                'fee' => '2,500',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'startup-idea' => [
                'id' => 'startup-idea',
                'name' => 'Start-up Idea',
                'image' => 'images/start-up.png',
                'description' => 'Brainstorm and pitch innovative business ideas. Learn entrepreneurship fundamentals, business model canvas, and develop your startup pitch.',
                'earlybird_fee' => '1,200',
                'fee' => '1,500',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'line-following-robot' => [
                'id' => 'line-following-robot',
                'name' => 'Line Following Robot',
                'image' => 'images/delivery.png',
                'description' => 'Build a robot that follows a path automatically. Learn sensor integration, motor control, and create an autonomous line-following robot.',
                'earlybird_fee' => '1,500',
                'fee' => '1,800',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'final-year-project-showcase' => [
                'id' => 'final-year-project-showcase',
                'name' => 'Final Year Project Showcase',
                'image' => 'images/project.png',
                'description' => 'Present your major project to peers and mentors. Showcase your final year project, get feedback from industry experts, and network with potential employers.',
                'earlybird_fee' => '1,200',
                'fee' => '1,500',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'logic-designing' => [
                'id' => 'logic-designing',
                'name' => 'Logic Designing',
                'image' => 'images/logical-thinking.png',
                'description' => 'Practice logical thinking through circuits and designs. Learn digital logic, circuit design, and develop problem-solving skills through hands-on projects.',
                'earlybird_fee' => '1,000',
                'fee' => '1,200',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ],
            'robowar' => [
                'id' => 'robowar',
                'name' => 'RoboWar',
                'image' => 'images/robotic-arm.png',
                'description' => 'Compete in building and battling robots. Design, build, and program combat robots to compete in exciting robotic battles.',
                'earlybird_fee' => '1,500',
                'fee' => '1,800',
                'team_min' => 1,
                'team_max' => 2,
                'team' => '1-2',
                'type' => 'module'
            ]
        ];

        $module = $modules[$id] ?? null;
        
        if (!$module) {
            abort(404);
        }

        return view('module-detail', compact('module'));
    }

    /**
     * Add item to cart.
     */
    public function addToCart(Request $request)
    {
        try {
            // Validate required fields
            $request->validate([
                'module_id' => 'required|string',
                'module_name' => 'required|string',
                'module_type' => 'required|string',
                'module_image' => 'required|string',
                'module_fee' => 'required|string',
                'quantity' => 'required|integer|min:1'
            ]);

            // Get cart from session or create new array
            $cart = session('cart', []);
            
            // Convert fee string to numeric (remove commas)
            $feeNumeric = (float) str_replace(',', '', $request->module_fee);
            
            // Create cart item
            $cartItem = [
                'id' => $request->module_id,
                'name' => $request->module_name,
                'type' => $request->module_type,
                'image' => $request->module_image,
                'price' => $request->module_fee,
                'quantity' => (int) $request->quantity,
                'total' => $feeNumeric * (int) $request->quantity
            ];
            
            // Add to cart
            $cart[] = $cartItem;
            session(['cart' => $cart]);
            
            return redirect()->back()->with('success', 'Module is added to cart');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding item to cart: ' . $e->getMessage());
        }
    }

    /**
     * Display the cart page.
     */
    public function cart(): View
    {
        // Get cart from session
        $cartItems = session('cart', []);
        
        // Calculate totals
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['total'];
        }
        $tax = $subtotal * 0.1; // 10% tax
        $total = $subtotal + $tax;

        return view('cart', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    /**
     * Remove item from cart.
     */
    public function removeFromCart($index)
    {
        $cart = session('cart', []);
        
        if (isset($cart[$index])) {
            unset($cart[$index]);
            $cart = array_values($cart); // Re-index array
            session(['cart' => $cart]);
        }
        
        return redirect()->route('cart')->with('success', 'Item removed from cart successfully!');
    }


    /**
     * Display the checkout page.
     */
    public function checkout(): View
    {
        // Get cart from session
        $cartItems = session('cart', []);
        
        // Calculate totals
        $subtotal = 0;
        $maxQuantity = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['total'];
            $maxQuantity = max($maxQuantity, $item['quantity']);
        }
        $tax = $subtotal * 0.1; // 10% tax
        $total = $subtotal + $tax;

        return view('checkout', compact('cartItems', 'subtotal', 'tax', 'total', 'maxQuantity'));
    }

    /**
     * Process the checkout form submission.
     */
    public function processCheckout(Request $request)
    {
        try {
            // Validate the form data
            $request->validate([
                'participants' => 'required|array',
                'participants.*.name' => 'required|string|max:255',
                'participants.*.email' => 'required|email|max:255',
                'participants.*.mobile' => 'required|string|max:20',
                'participants.*.address' => 'required|string|max:500'
            ]);

            // Get cart items
            $cartItems = session('cart', []);
            
            if (empty($cartItems)) {
                return redirect()->route('cart')->with('error', 'Your cart is empty!');
            }

            // Process the checkout (in a real app, this would save to database)
            $participants = $request->participants;

            // Clear the cart after successful checkout
            session()->forget('cart');

            // Redirect back to modules page with success message
            return redirect()->route('modules')->with('success', 'Registration completed! You will be notified for date and timings on mail shortly.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error processing checkout: ' . $e->getMessage());
        }
    }

}