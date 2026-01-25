@extends('layouts.web.app')
@section('content')
<style>
        body {
            font-family: 'Inter', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #800000 0%, #a00000 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #800000 0%, #1e40af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Program Cards */
        .program-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .program-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .program-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #800000, #1e40af);
        }

        /* Subject Badges */
        .subject-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin: 2px;
        }

        .science-subject {
            background-color: rgba(59, 130, 246, 0.1);
            color: #1e40af;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .arts-subject {
            background-color: rgba(139, 92, 246, 0.1);
            color: #7c3aed;
            border: 1px solid rgba(139, 92, 246, 0.3);
        }

        .business-subject {
            background-color: rgba(5, 150, 105, 0.1);
            color: #059669;
            border: 1px solid rgba(5, 150, 105, 0.3);
        }

        .language-subject {
            background-color: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .core-subject {
            background-color: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* Curriculum Tabs */
        .tab-btn {
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }

        .tab-btn.active {
            color: #800000;
            border-bottom-color: #800000;
            font-weight: 600;
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .tab-content.active {
            display: block;
        }

        /* Academic Timeline */
        .academic-timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }

        .academic-timeline::after {
            content: '';
            position: absolute;
            width: 4px;
            background: linear-gradient(to bottom, #800000, #1e40af);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
            border-radius: 2px;
        }

        .timeline-item {
            padding: 10px 40px;
            position: relative;
            width: 50%;
            box-sizing: border-box;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            background-color: white;
            border: 4px solid #800000;
            border-radius: 50%;
            top: 15px;
            z-index: 1;
        }

        .left {
            left: 0;
        }

        .right {
            left: 50%;
        }

        .left::after {
            right: -8px;
        }

        .right::after {
            left: -8px;
        }

        .timeline-content {
            padding: 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #800000;
        }

        .right .timeline-content {
            border-left: none;
            border-right: 4px solid #1e40af;
        }

        @media screen and (max-width: 768px) {
            .academic-timeline::after {
                left: 31px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            .timeline-item::after {
                left: 21px;
            }

            .right {
                left: 0;
            }

            .left::after, .right::after {
                left: 21px;
            }

            .timeline-content {
                border-left: 4px solid #800000 !important;
                border-right: none !important;
            }
        }

        /* Performance Chart */
        .performance-bar {
            height: 20px;
            border-radius: 10px;
            background-color: #e5e7eb;
            overflow: hidden;
            position: relative;
        }

        .performance-fill {
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(90deg, #800000, #a00000);
            transition: width 1.5s ease;
        }

        /* Academic Calendar */
        .calendar-day {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .calendar-day:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .calendar-day.event {
            background: linear-gradient(135deg, #800000, #a00000);
            color: white;
        }

        /* Library Card */
        .library-card {
            transition: all 0.3s ease;
        }

        .library-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        /* Floating Elements */
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        .floating-element.delay-1 {
            animation-delay: 1s;
        }

        .floating-element.delay-2 {
            animation-delay: 2s;
        }
    </style>
</head>

    <!-- Page Header -->
    <section class="gradient-bg text-white py-20 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 rounded-full border-4 border-white floating-element"></div>
            <div class="absolute bottom-1/4 right-1/4 w-48 h-48 rounded-full border-4 border-white floating-element delay-1"></div>
            <div class="absolute top-1/2 right-1/3 w-32 h-32 rounded-full border-4 border-white floating-element delay-2"></div>
            <div class="absolute top-1/3 left-1/3 w-20 h-20 rounded-full border-4 border-white"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center animate-fade-in">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">Academic Excellence</h1>
                <p class="text-xl max-w-3xl mx-auto text-gray-100">Nurturing minds, building futures through quality education and holistic development</p>

                <!-- Breadcrumb -->
                <div class="flex justify-center items-center mt-8 space-x-2 text-sm">
                    <a href="/" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                    <span class="text-gray-300">/</span>
                    <span class="text-white font-medium">Academics</span>
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="fill-current text-gray-50 w-full">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
            </svg>
        </div>
    </section>


    <!-- Academic Programs -->
    <section id="programs" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Academic Programs</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Comprehensive educational programs designed to meet diverse learning needs and career aspirations</p>
            </div>

            <!-- Program Tabs -->
            <div class="mb-8 animate-fade-in">
                <div class="flex flex-wrap justify-center border-b border-gray-200">
                    <button class="tab-btn active px-6 py-3 text-lg font-medium" data-tab="olevel">
                        <i class="fas fa-graduation-cap mr-2"></i> Ordinary Level (S1-S4)
                    </button>
                    <button class="tab-btn px-6 py-3 text-lg font-medium" data-tab="alevel">
                        <i class="fas fa-user-graduate mr-2"></i> Advanced Level (S5-S6)
                    </button>
                    <button class="tab-btn px-6 py-3 text-lg font-medium" data-tab="curriculum">
                        <i class="fas fa-book-open mr-2"></i> Curriculum
                    </button>
                </div>
            </div>

            <!-- O-Level Tab Content -->
            <div class="tab-content active animate-slide-up" id="olevel">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <div class="grid lg:grid-cols-2 gap-12">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Ordinary Level Education (S1-S4)</h3>
                            <p class="text-gray-600 mb-6">
                                Our four-year Ordinary Level program prepares students for the Uganda Certificate of Education (UCE) examinations. The curriculum provides a strong foundation in core subjects while allowing students to explore their interests.
                            </p>

                            <div class="mb-8">
                                <h4 class="font-bold text-gray-900 text-lg mb-4">Key Features:</h4>
                                <ul class="space-y-3">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Broad-based curriculum covering sciences, humanities, and languages</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Practical skills development through laboratory work and projects</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Career guidance to help students choose appropriate A-Level combinations</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Continuous assessment and academic support programs</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-4">Entry Requirements:</h4>
                                <p class="text-gray-600">
                                    Completion of Primary Seven with a First or Second Grade. Students must pass our entrance examination and interview.
                                </p>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900 text-lg mb-6">Core Subjects</h4>
                            <div class="space-y-6">
                                <div>
                                    <h5 class="font-bold text-gray-900 mb-3">Compulsory Subjects</h5>
                                    <div class="flex flex-wrap gap-2 mb-6">
                                        <span class="subject-badge core-subject">English Language</span>
                                        <span class="subject-badge core-subject">Mathematics</span>
                                        <span class="subject-badge core-subject">Physics</span>
                                        <span class="subject-badge core-subject">Chemistry</span>
                                        <span class="subject-badge core-subject">Biology</span>
                                        <span class="subject-badge core-subject">Geography</span>
                                        <span class="subject-badge core-subject">History</span>
                                        <span class="subject-badge core-subject">Christian Religious Education</span>
                                    </div>
                                </div>

                                <div>
                                    <h5 class="font-bold text-gray-900 mb-3">Optional Subjects (Choose 3)</h5>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="subject-badge science-subject">Agriculture</span>
                                        <span class="subject-badge science-subject">Computer Studies</span>
                                        <span class="subject-badge business-subject">Business studies</span>
                                        <span class="subject-badge arts-subject">Fine Art</span>
                                        <span class="subject-badge language-subject">Kiswahili</span>
                                    </div>
                                </div>
                            </div>

                            <!-- O-Level Structure -->
                            <div class="mt-8 bg-gray-50 p-6 rounded-lg">
                                <h5 class="font-bold text-gray-900 mb-4">Program Structure</h5>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 bg-maroon rounded-full flex items-center justify-center text-white font-bold mr-4">S1</div>
                                        <div>
                                            <div class="font-medium">Foundation Year</div>
                                            <div class="text-gray-600 text-sm">Introduction to all core subjects</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 bg-maroon rounded-full flex items-center justify-center text-white font-bold mr-4">S2</div>
                                        <div>
                                            <div class="font-medium">Consolidation Year</div>
                                            <div class="text-gray-600 text-sm">Subject specialization begins</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 bg-maroon rounded-full flex items-center justify-center text-white font-bold mr-4">S3</div>
                                        <div>
                                            <div class="font-medium">Pre-Exam Year</div>
                                            <div class="text-gray-600 text-sm">Intensive preparation for UCE</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 bg-maroon rounded-full flex items-center justify-center text-white font-bold mr-4">S4</div>
                                        <div>
                                            <div class="font-medium">Examination Year</div>
                                            <div class="text-gray-600 text-sm">Final preparation and UCE exams</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- A-Level Tab Content -->
            <div class="tab-content animate-slide-up" id="alevel">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <div class="grid lg:grid-cols-2 gap-12">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Advanced Level Education (S5-S6)</h3>
                            <p class="text-gray-600 mb-6">
                                Our two-year Advanced Level program prepares students for the Uganda Advanced Certificate of Education (UACE) examinations and university education. Students specialize in one of three main combinations.
                            </p>

                            <div class="mb-8">
                                <h4 class="font-bold text-gray-900 text-lg mb-4">Program Highlights:</h4>
                                <ul class="space-y-3">
                                    <li class="flex items-start">
                                        <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                                        <span>Specialized education in Science, Arts, or Business combinations</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                                        <span>University preparatory curriculum with research components</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                                        <span>Career guidance and university application support</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-star text-yellow-500 mt-1 mr-3"></i>
                                        <span>Leadership development and community service projects</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-900 text-lg mb-4">Entry Requirements:</h4>
                                <p class="text-gray-600 mb-4">
                                    Uganda Certificate of Education (UCE) with at least 8 passes including English and Mathematics. Specific subject requirements apply for each combination.
                                </p>
                                <a href="#" class="inline-flex items-center text-maroon font-medium hover:text-red-800">
                                    <i class="fas fa-download mr-2"></i> Download Detailed Requirements
                                </a>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900 text-lg mb-6">A-Level Combinations</h4>

                            <!-- Science Combinations -->
                            <div class="mb-8">
                                <h5 class="font-bold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-flask text-school-blue mr-2"></i> Science Combinations
                                </h5>
                                <div class="space-y-4">
                                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                        <h6 class="font-bold text-gray-900 mb-2">PCM (Physics, Chemistry, Mathematics)</h6>
                                        <p class="text-gray-600 text-sm mb-3">For engineering, medicine, and pure science careers</p>
                                        <div class="flex flex-wrap gap-2">
                                            <span class="subject-badge science-subject">Physics</span>
                                            <span class="subject-badge science-subject">Chemistry</span>
                                            <span class="subject-badge science-subject">Mathematics</span>
                                            <span class="subject-badge core-subject">General Paper</span>
                                        </div>
                                    </div>

                                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                        <h6 class="font-bold text-gray-900 mb-2">PCB (Physics, Chemistry, Biology)</h6>
                                        <p class="text-gray-600 text-sm mb-3">For medicine, pharmacy, and biological sciences</p>
                                        <div class="flex flex-wrap gap-2">
                                            <span class="subject-badge science-subject">Physics</span>
                                            <span class="subject-badge science-subject">Chemistry</span>
                                            <span class="subject-badge science-subject">Biology</span>
                                            <span class="subject-badge core-subject">General Paper</span>
                                        </div>
                                    </div>

                                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                        <h6 class="font-bold text-gray-900 mb-2">BCM (Biology, Chemistry, Mathematics)</h6>
                                        <p class="text-gray-600 text-sm mb-3">For biomedical sciences and biotechnology</p>
                                        <div class="flex flex-wrap gap-2">
                                            <span class="subject-badge science-subject">Biology</span>
                                            <span class="subject-badge science-subject">Chemistry</span>
                                            <span class="subject-badge science-subject">Mathematics</span>
                                            <span class="subject-badge core-subject">General Paper</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Arts & Business Combinations -->
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <h5 class="font-bold text-gray-900 mb-4 flex items-center">
                                        <i class="fas fa-palette text-purple-600 mr-2"></i> Arts Combinations
                                    </h5>
                                    <div class="bg-purple-50 p-4 rounded-lg border border-purple-100">
                                        <h6 class="font-bold text-gray-900 mb-2">HGL (History, Geography, Literature)</h6>
                                        <p class="text-gray-600 text-sm mb-3">For law, education, and social sciences</p>
                                        <div class="flex flex-wrap gap-2">
                                            <span class="subject-badge arts-subject">History</span>
                                            <span class="subject-badge arts-subject">Geography</span>
                                            <span class="subject-badge arts-subject">Literature</span>
                                            <span class="subject-badge core-subject">General Paper</span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h5 class="font-bold text-gray-900 mb-4 flex items-center">
                                        <i class="fas fa-chart-line text-green-600 mr-2"></i> Business Combinations
                                    </h5>
                                    <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                                        <h6 class="font-bold text-gray-900 mb-2">BAM (Economics, Entrepreneurship, Mathematics)</h6>
                                        <p class="text-gray-600 text-sm mb-3">For business, finance, and management</p>
                                        <div class="flex flex-wrap gap-2">
                                            <span class="subject-badge business-subject">Economics</span>
                                            <span class="subject-badge business-subject">Entrepreneurship</span>
                                            <span class="subject-badge science-subject">Mathematics</span>
                                            <span class="subject-badge core-subject">General Paper</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Curriculum Tab Content -->
            <div class="tab-content animate-slide-up" id="curriculum">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Our Curriculum Approach</h3>

                    <div class="grid md:grid-cols-3 gap-8 mb-8">
                        <div class="text-center">
                            <div class="h-16 w-16 bg-maroon rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-brain text-white text-2xl"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-3">Critical Thinking</h4>
                            <p class="text-gray-600 text-sm">Developing analytical and problem-solving skills through inquiry-based learning</p>
                        </div>

                        <div class="text-center">
                            <div class="h-16 w-16 bg-school-blue rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-hands-helping text-white text-2xl"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-3">Collaborative Learning</h4>
                            <p class="text-gray-600 text-sm">Group projects and discussions to enhance teamwork and communication</p>
                        </div>

                        <div class="text-center">
                            <div class="h-16 w-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-lightbulb text-white text-2xl"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-3">Creativity & Innovation</h4>
                            <p class="text-gray-600 text-sm">Encouraging original thinking and application of knowledge</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h4 class="font-bold text-gray-900 text-lg mb-4">Curriculum Framework</h4>
                        <p class="text-gray-600 mb-6">
                            Our curriculum aligns with the Uganda National Curriculum but is enriched with additional components to provide a holistic education. We emphasize:
                        </p>

                        <div class="grid md:grid-cols-2 gap-6">
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>Core academic subjects meeting national standards</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>Digital literacy and ICT integration across subjects</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>Environmental education and sustainability</span>
                                </li>
                            </ul>

                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>Character education and moral values</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>Career guidance and life skills</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span>Physical education and health awareness</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-bold text-gray-900 text-lg mb-4">Teaching Methodology</h4>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                                <div class="text-center">
                                    <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-chalkboard-teacher text-school-blue text-xl"></i>
                                    </div>
                                    <div class="font-medium text-gray-900">Interactive Lectures</div>
                                </div>

                                <div class="text-center">
                                    <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-flask text-green-600 text-xl"></i>
                                    </div>
                                    <div class="font-medium text-gray-900">Practical Experiments</div>
                                </div>

                                <div class="text-center">
                                    <div class="h-12 w-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-laptop-code text-purple-600 text-xl"></i>
                                    </div>
                                    <div class="font-medium text-gray-900">Digital Learning</div>
                                </div>

                                <div class="text-center">
                                    <div class="h-12 w-12 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-project-diagram text-yellow-600 text-xl"></i>
                                    </div>
                                    <div class="font-medium text-gray-900">Project-Based Learning</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Academic Performance -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Academic Performance</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Consistent excellence in national examinations and academic achievements</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Performance Highlights -->
                <div class="animate-slide-in-left">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Examination Results</h3>

                    <div class="space-y-8">
                        <!-- UCE Performance -->
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-bold text-gray-900">UCE Performance (2024)</h4>
                                <span class="bg-maroon text-white px-3 py-1 rounded-full text-sm font-bold">100% Result 1</span>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                        <span>Result 1</span>
                                        <span>100</span>
                                    </div>
                                    <div class="performance-bar">
                                        <div class="performance-fill" data-width="100"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                        <span>Result 2</span>
                                        <span>0</span>
                                    </div>
                                    <div class="performance-bar">
                                        <div class="performance-fill" data-width="0"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- UACE Performance -->
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-bold text-gray-900">UACE Performance (2024)</h4>
                                <span class="bg-school-blue text-white px-3 py-1 rounded-full text-sm font-bold">92% Pass Rate</span>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                        <span>3+ Principals</span>
                                        <span>65%</span>
                                    </div>
                                    <div class="performance-bar">
                                        <div class="performance-fill" style="background: linear-gradient(90deg, #1e40af, #3b82f6);" data-width="65"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                        <span>2 Principals</span>
                                        <span>27%</span>
                                    </div>
                                    <div class="performance-bar">
                                        <div class="performance-fill" style="background: linear-gradient(90deg, #1e40af, #3b82f6);" data-width="27"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                        <span>1 Principal</span>
                                        <span>8%</span>
                                    </div>
                                    <div class="performance-bar">
                                        <div class="performance-fill" style="background: linear-gradient(90deg, #1e40af, #3b82f6);" data-width="8"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Trends -->
                    <div class="mt-8 bg-gray-50 p-6 rounded-lg">
                        <h4 class="font-bold text-gray-900 mb-4">Performance Trends (Last 5 Years)</h4>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-24 text-sm text-gray-600">UCE Division I</div>
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <div class="h-2 bg-green-200 rounded-full flex-1 mr-2">
                                            <div class="h-full bg-green-500 rounded-full" style="width: 85%"></div>
                                        </div>
                                        <span class="text-sm font-medium">↑ 12% increase</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-24 text-sm text-gray-600">University Admission</div>
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <div class="h-2 bg-blue-200 rounded-full flex-1 mr-2">
                                            <div class="h-full bg-blue-500 rounded-full" style="width: 95%"></div>
                                        </div>
                                        <span class="text-sm font-medium">↑ 5% increase</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="w-24 text-sm text-gray-600">Scholarships</div>
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <div class="h-2 bg-purple-200 rounded-full flex-1 mr-2">
                                            <div class="h-full bg-purple-500 rounded-full" style="width: 40%"></div>
                                        </div>
                                        <span class="text-sm font-medium">↑ 15% increase</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Awards & Recognition -->
                <div class="animate-slide-in-right">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Awards & Recognition</h3>

                    <div class="space-y-6">
                        <!-- Award 1 -->
                        <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-start">
                                <div class="h-16 w-16 bg-yellow-100 rounded-xl flex items-center justify-center mr-4">
                                    <i class="fas fa-trophy text-yellow-600 text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-2">Best Performing School - Otuke District 2023</h4>
                                    <p class="text-gray-600 text-sm mb-3">Awarded by the Ministry of Education for overall academic performance in UCE and UACE examinations</p>
                                    <span class="text-xs bg-gray-100 text-gray-800 px-3 py-1 rounded-full">Ministry of Education</span>
                                </div>
                            </div>
                        </div>

                        <!-- Award 2 -->
                        <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-start">
                                <div class="h-16 w-16 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                                    <i class="fas fa-medal text-school-blue text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-2">Excellence in Science Education 2022</h4>
                                    <p class="text-gray-600 text-sm mb-3">Recognized for outstanding performance in science subjects at regional level</p>
                                    <span class="text-xs bg-gray-100 text-gray-800 px-3 py-1 rounded-full">UNEB Regional Office</span>
                                </div>
                            </div>
                        </div>

                        <!-- Award 3 -->
                        <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300">
                            <div class="flex items-start">
                                <div class="h-16 w-16 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                                    <i class="fas fa-award text-green-600 text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-2">Digital Learning Initiative Award 2021</h4>
                                    <p class="text-gray-600 text-sm mb-3">Awarded for innovative integration of technology in teaching and learning</p>
                                    <span class="text-xs bg-gray-100 text-gray-800 px-3 py-1 rounded-full">ICT Association of Uganda</span>
                                </div>
                            </div>
                        </div>

                        <!-- Top Performers -->
                        <div class="bg-gradient-to-r from-maroon to-red-800 text-white rounded-xl p-6">
                            <h4 class="font-bold text-xl mb-4">2023 Top Performers</h4>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-bold">Sarah Adong</div>
                                        <div class="text-gray-200 text-sm">4 A's in UACE (PCM)</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold">Makerere University</div>
                                        <div class="text-gray-200 text-sm">Medicine Scholarship</div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-bold">Peter Okello</div>
                                        <div class="text-gray-200 text-sm">Aggregate 8 in UCE</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold">Uganda Martyrs</div>
                                        <div class="text-gray-200 text-sm">Science Combination</div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-bold">Jane Acen</div>
                                        <div class="text-gray-200 text-sm">3 A's 1B in UACE (BAM)</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold">Kyambogo University</div>
                                        <div class="text-gray-200 text-sm">Business Administration</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Co-curricular Activities -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Co-curricular Activities</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Holistic development through sports, clubs, and creative activities</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Sports -->
                <div class="program-card bg-white rounded-xl p-6">
                    <div class="h-16 w-16 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-futbol text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-3">Sports & Athletics</h3>
                    <p class="text-gray-600 text-sm mb-4">Football, basketball, athletics, netball, volleyball, and more</p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Inter-house competitions</span>
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Regional tournaments</span>
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Annual sports day</span>
                        </li>
                    </ul>
                </div>

                <!-- Clubs & Societies -->
                <div class="program-card bg-white rounded-xl p-6">
                    <div class="h-16 w-16 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-users text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-3">Clubs & Societies</h3>
                    <p class="text-gray-600 text-sm mb-4">25+ clubs including debate, science, journalism, and more</p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Debate & Public Speaking</span>
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Science & Innovation Club</span>
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Young Entrepreneurs</span>
                        </li>
                    </ul>
                </div>

                <!-- Creative Arts -->
                <div class="program-card bg-white rounded-xl p-6">
                    <div class="h-16 w-16 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-paint-brush text-yellow-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-3">Creative Arts</h3>
                    <p class="text-gray-600 text-sm mb-4">Music, dance, drama, visual arts, and crafts</p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>School choir & band</span>
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Drama festivals</span>
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Art exhibitions</span>
                        </li>
                    </ul>
                </div>

                <!-- Community Service -->
                <div class="program-card bg-white rounded-xl p-6">
                    <div class="h-16 w-16 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-hands-helping text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-3">Community Service</h3>
                    <p class="text-gray-600 text-sm mb-4">Environmental conservation, volunteering, and outreach programs</p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Tree planting campaigns</span>
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Community clean-ups</span>
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Elderly support programs</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Clubs Highlight -->
            <div class="bg-gradient-to-r from-school-blue to-blue-800 text-white rounded-xl p-8 animate-fade-in">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold mb-4">Featured Club: Science & Innovation Club</h3>
                    <p class="text-gray-200 max-w-2xl mx-auto">Students conducting research projects and participating in regional science competitions</p>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-white/10 p-6 rounded-lg text-center backdrop-blur-sm">
                        <i class="fas fa-trophy text-3xl mb-4"></i>
                        <div class="font-bold text-lg">3 Gold Medals</div>
                        <div class="text-gray-200 text-sm">Regional Science Fair 2023</div>
                    </div>

                    <div class="bg-white/10 p-6 rounded-lg text-center backdrop-blur-sm">
                        <i class="fas fa-users text-3xl mb-4"></i>
                        <div class="font-bold text-lg">45 Members</div>
                        <div class="text-gray-200 text-sm">Active student participants</div>
                    </div>

                    <div class="bg-white/10 p-6 rounded-lg text-center backdrop-blur-sm">
                        <i class="fas fa-flask text-3xl mb-4"></i>
                        <div class="font-bold text-lg">12 Projects</div>
                        <div class="text-gray-200 text-sm">Research projects completed</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Learning Resources -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Learning Resources</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">State-of-the-art facilities and resources to support quality education</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Library -->
                <div class="library-card bg-white rounded-xl overflow-hidden border border-gray-200">
                    <div class="h-48 bg-gradient-to-br from-purple-600 to-purple-800 relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="font-bold text-xl">School Library</h3>
                            <p class="text-gray-200">Knowledge hub with extensive resources</p>
                        </div>
                        <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs">
                            5,000+ Books
                        </div>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-book text-maroon mr-3"></i>
                                <span>Textbooks and reference materials</span>
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-laptop text-maroon mr-3"></i>
                                <span>Digital learning resources</span>
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-newspaper text-maroon mr-3"></i>
                                <span>Newspapers and periodicals</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Science Labs -->
                <div class="library-card bg-white rounded-xl overflow-hidden border border-gray-200">
                    <div class="h-48 bg-gradient-to-br from-school-blue to-blue-800 relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="font-bold text-xl">Science Laboratories</h3>
                            <p class="text-gray-200">Modern facilities for practical learning</p>
                        </div>
                        <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs">
                            3 Labs
                        </div>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-flask text-school-blue mr-3"></i>
                                <span>Fully equipped chemistry lab</span>
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-dna text-school-blue mr-3"></i>
                                <span>Biology laboratory with specimens</span>
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-atom text-school-blue mr-3"></i>
                                <span>Physics lab with modern equipment</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- ICT Center -->
                <div class="library-card bg-white rounded-xl overflow-hidden border border-gray-200">
                    <div class="h-48 bg-gradient-to-br from-green-600 to-green-800 relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="font-bold text-xl">ICT Center</h3>
                            <p class="text-gray-200">Digital learning and computer literacy</p>
                        </div>
                        <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs">
                            40 Computers
                        </div>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-desktop text-green-600 mr-3"></i>
                                <span>Computer lab with internet access</span>
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-wifi text-green-600 mr-3"></i>
                                <span>School-wide WiFi network</span>
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-chalkboard text-green-600 mr-3"></i>
                                <span>Smart classrooms</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Academic Calendar -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Academic Calendar 2024</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Important dates and events for the current academic year</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8 animate-slide-up">
                <div class="grid md:grid-cols-4 gap-6 mb-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-maroon mb-2">3</div>
                        <div class="text-gray-600">School Terms</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-school-blue mb-2">39</div>
                        <div class="text-gray-600">Weeks of Learning</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600 mb-2">4</div>
                        <div class="text-gray-600">Examination Periods</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-purple-600 mb-2">12</div>
                        <div class="text-gray-600">Major School Events</div>
                    </div>
                </div>

                <!-- Calendar Months -->
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Term 1 -->
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg mb-4 flex items-center">
                            <span class="h-3 w-3 bg-maroon rounded-full mr-2"></span>
                            Term 1: February - May
                        </h4>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <div class="bg-maroon text-white text-xs px-3 py-1 rounded mr-3">Feb 10</div>
                                <div>
                                    <div class="font-medium text-gray-900">Term 1 Begins</div>
                                    <div class="text-gray-600 text-sm">Students report for first term</div>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-yellow-500 text-white text-xs px-3 py-1 rounded mr-3">Mar 15</div>
                                <div>
                                    <div class="font-medium text-gray-900">Sports Day</div>
                                    <div class="text-gray-600 text-sm">Inter-house sports competition</div>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-green-600 text-white text-xs px-3 py-1 rounded mr-3">Apr 5-12</div>
                                <div>
                                    <div class="font-medium text-gray-900">Term 1 Exams</div>
                                    <div class="text-gray-600 text-sm">First term examinations</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Term 2 -->
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg mb-4 flex items-center">
                            <span class="h-3 w-3 bg-school-blue rounded-full mr-2"></span>
                            Term 2: May - August
                        </h4>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <div class="bg-school-blue text-white text-xs px-3 py-1 rounded mr-3">May 13</div>
                                <div>
                                    <div class="font-medium text-gray-900">Term 2 Begins</div>
                                    <div class="text-gray-600 text-sm">Second term commences</div>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-purple-600 text-white text-xs px-3 py-1 rounded mr-3">Jun 20</div>
                                <div>
                                    <div class="font-medium text-gray-900">Science Fair</div>
                                    <div class="text-gray-600 text-sm">Annual science exhibition</div>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-green-600 text-white text-xs px-3 py-1 rounded mr-3">Aug 2-9</div>
                                <div>
                                    <div class="font-medium text-gray-900">Term 2 Exams</div>
                                    <div class="text-gray-600 text-sm">Second term examinations</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Term 3 -->
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg mb-4 flex items-center">
                            <span class="h-3 w-3 bg-green-600 rounded-full mr-2"></span>
                            Term 3: September - November
                        </h4>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <div class="bg-green-600 text-white text-xs px-3 py-1 rounded mr-3">Sep 9</div>
                                <div>
                                    <div class="font-medium text-gray-900">Term 3 Begins</div>
                                    <div class="text-gray-600 text-sm">Third term commences</div>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-pink-600 text-white text-xs px-3 py-1 rounded mr-3">Oct 15</div>
                                <div>
                                    <div class="font-medium text-gray-900">Cultural Day</div>
                                    <div class="text-gray-600 text-sm">Traditional performances</div>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-red-600 text-white text-xs px-3 py-1 rounded mr-3">Nov 4-29</div>
                                <div>
                                    <div class="font-medium text-gray-900">UCE & UACE Exams</div>
                                    <div class="text-gray-600 text-sm">National examinations</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="#" class="inline-flex items-center bg-maroon text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300">
                        <i class="fas fa-download mr-2"></i> Download Full Calendar
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-gradient-to-r from-maroon to-red-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Begin Your Academic Journey</h2>
                <p class="text-xl text-gray-200 max-w-2xl mx-auto mb-8">
                    Join Okwang Secondary School and access quality education that prepares you for success in higher education and beyond.
                </p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="/admissions" class="bg-white text-maroon px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-file-alt mr-2"></i> Apply for Admission
                    </a>
                    <a href="/contact" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:text-gray-900 transition-all duration-300">
                        <i class="fas fa-phone-alt mr-2"></i> Contact Academic Office
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        document.getElementById('menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Animate stats counter
        function animateStats() {
            const statElements = document.querySelectorAll('.stat-number[data-count]');

            statElements.forEach(stat => {
                const target = parseInt(stat.getAttribute('data-count'));
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    stat.textContent = Math.floor(current);
                }, 16);
            });
        }

        // Trigger stats animation when section is in view
        const statsSection = document.querySelector('section.py-12.bg-white');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        if (statsSection) {
            observer.observe(statsSection);
        }

        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');

                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to clicked button and corresponding content
                this.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Animate performance bars
        function animatePerformanceBars() {
            const performanceBars = document.querySelectorAll('.performance-fill');

            performanceBars.forEach(bar => {
                const width = bar.getAttribute('data-width');
                bar.style.width = width + '%';
            });
        }

        // Trigger performance bars animation when section is in view
        const performanceSection = document.querySelector('section.py-16.bg-white');
        const performanceObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(animatePerformanceBars, 300);
                    performanceObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        if (performanceSection) {
            performanceObserver.observe(performanceSection);
        }

        // Program card hover effect enhancement
        const programCards = document.querySelectorAll('.program-card');
        programCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Library card hover effect
        const libraryCards = document.querySelectorAll('.library-card');
        libraryCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.15)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    document.getElementById('mobile-menu').classList.add('hidden');
                }
            });
        });

        // Calendar day hover effects
        const calendarDays = document.querySelectorAll('.calendar-day');
        calendarDays.forEach(day => {
            day.addEventListener('mouseenter', function() {
                if (!this.classList.contains('event')) {
                    this.style.backgroundColor = '#f3f4f6';
                }
            });

            day.addEventListener('mouseleave', function() {
                if (!this.classList.contains('event')) {
                    this.style.backgroundColor = '';
                }
            });
        });

        // Initialize floating elements
        document.addEventListener('DOMContentLoaded', function() {
            // Add delay classes to floating elements
            const floatingElements = document.querySelectorAll('.floating-element');
            floatingElements.forEach((element, index) => {
                if (index === 1) element.classList.add('delay-1');
                if (index === 2) element.classList.add('delay-2');
            });
        });
    </script>
</body>
</html>
