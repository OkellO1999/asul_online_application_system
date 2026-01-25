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

        /* Job Card Styles */
        .job-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-left-color: #800000;
        }

        .job-card.featured {
            border-left-color: #f59e0b;
        }

        .job-type-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .full-time {
            background-color: rgba(5, 150, 105, 0.1);
            color: #059669;
            border: 1px solid rgba(5, 150, 105, 0.3);
        }

        .part-time {
            background-color: rgba(59, 130, 246, 0.1);
            color: #1e40af;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .contract {
            background-color: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        /* Application Form */
        .application-form {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease;
        }

        .application-form.open {
            max-height: 2000px;
        }

        /* Benefits Icons */
        .benefit-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
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

        /* Filter Buttons */
        .filter-btn {
            transition: all 0.3s ease;
        }

        .filter-btn.active {
            background-color: #800000;
            color: white;
        }

        /* Timeline */
        .process-step {
            position: relative;
            padding-left: 2rem;
        }

        .process-step::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0.25rem;
            width: 1rem;
            height: 1rem;
            background-color: #800000;
            border-radius: 50%;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .process-step {
                padding-left: 1.5rem;
            }
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
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center animate-fade-in">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">Build Your Career With Us</h1>
                <p class="text-xl max-w-3xl mx-auto text-gray-100">Join our team of dedicated educators and staff shaping the future of education in Otuke District</p>

                <!-- Breadcrumb -->
                <div class="flex justify-center items-center mt-8 space-x-2 text-sm">
                    <a href="/" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                    <span class="text-gray-300">/</span>
                    <span class="text-white font-medium">Careers</span>
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

    <!-- Why Work With Us -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Why Work at Okwang Secondary School?</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Join a community that values excellence, professional growth, and making a difference in students' lives</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Benefit 1 -->
                <div class="text-center animate-slide-up">
                    <div class="benefit-icon bg-red-100 text-maroon mx-auto">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-3">Professional Development</h3>
                    <p class="text-gray-600 text-sm">Continuous training, workshops, and opportunities for further education to advance your career</p>
                </div>

                <!-- Benefit 2 -->
                <div class="text-center animate-slide-up">
                    <div class="benefit-icon bg-blue-100 text-school-blue mx-auto">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-3">Competitive Compensation</h3>
                    <p class="text-gray-600 text-sm">Attractive salary packages with benefits including housing allowance, medical insurance, and pension</p>
                </div>

                <!-- Benefit 3 -->
                <div class="text-center animate-slide-up">
                    <div class="benefit-icon bg-green-100 text-green-600 mx-auto">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-3">Supportive Community</h3>
                    <p class="text-gray-600 text-sm">Work in a collaborative environment with dedicated colleagues who share your passion for education</p>
                </div>

                <!-- Benefit 4 -->
                <div class="text-center animate-slide-up">
                    <div class="benefit-icon bg-purple-100 text-purple-600 mx-auto">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-3">Work-Life Balance</h3>
                    <p class="text-gray-600 text-sm">Reasonable workload with scheduled breaks, holidays, and support for personal commitments</p>
                </div>
            </div>

            <!-- Additional Benefits -->
            <div class="mt-16 bg-gray-50 rounded-xl p-8 border border-gray-200 animate-fade-in">
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Our Work Culture</h3>
                        <p class="text-gray-600 mb-6">
                            At Okwang Secondary School, we foster a culture of mutual respect, collaboration, and innovation. We believe that our staff are our greatest asset, and we invest in their growth and well-being.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span>Regular team-building activities and staff events</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span>Open-door policy with school administration</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span>Opportunities for leadership and innovation</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span>Recognition programs for outstanding performance</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Staff Testimonials</h3>
                        <div class="bg-white p-6 rounded-lg border border-gray-200">
                            <div class="flex items-center mb-4">
                                <div class="h-12 w-12 bg-maroon rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-quote-left text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">Mr. David Opio</h4>
                                    <p class="text-gray-600 text-sm">Physics Teacher, 5 years at Okwang</p>
                                </div>
                            </div>
                            <p class="text-gray-600 italic">
                                "Teaching at Okwang has been incredibly rewarding. The school administration truly values its staff and provides ample opportunities for professional growth. The students are motivated, and the community is supportive."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Current Job Openings -->
    <section id="jobs" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Current Job Openings</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Explore exciting career opportunities to join our team of dedicated educators and staff</p>
            </div>

            <!-- Job Filters -->
            <div class="flex flex-wrap justify-center gap-3 mb-8">
                <button class="filter-btn active px-5 py-2 rounded-full bg-maroon text-white font-medium" data-filter="all">
                    All Positions
                </button>
                <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-800 font-medium hover:bg-gray-200" data-filter="teaching">
                    Teaching Positions
                </button>
                <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-800 font-medium hover:bg-gray-200" data-filter="non-teaching">
                    Non-Teaching Positions
                </button>
                <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-800 font-medium hover:bg-gray-200" data-filter="administrative">
                    Administrative Positions
                </button>
            </div>

            <!-- Job Listings -->
            <div class="space-y-6">
                <!-- Featured Job -->
                <div class="job-card featured bg-white rounded-xl p-6 border border-gray-200 animate-slide-up" data-category="teaching">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div class="mb-4 md:mb-0">
                            <div class="flex items-center mb-3">
                                <span class="job-type-badge full-time mr-3">Full-time</span>
                                <span class="text-sm bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full">
                                    <i class="fas fa-star mr-1"></i> Featured
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Mathematics Teacher (S1-S4)</h3>
                            <div class="flex flex-wrap items-center text-gray-600 text-sm gap-4">
                                <span><i class="fas fa-graduation-cap mr-2"></i> Minimum: B.Sc. Mathematics + Teaching Certificate</span>
                                <span><i class="fas fa-map-marker-alt mr-2"></i> Otuke District, Okwang Town Council</span>
                                <span><i class="far fa-clock mr-2"></i> Application Deadline: June 30, 2024</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-start md:items-end">
                            <div class="text-lg font-bold text-gray-900 mb-2">Attractive Package</div>
                            <button class="apply-btn bg-maroon text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300" data-job="math-teacher">
                                <i class="fas fa-paper-plane mr-2"></i> Apply Now
                            </button>
                        </div>
                    </div>

                    <!-- Job Details (Hidden by default) -->
                    <div class="mt-6 pt-6 border-t border-gray-200 hidden job-details">
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <h4 class="font-bold text-gray-900 mb-4">Job Description</h4>
                                <ul class="space-y-3 text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Teach Mathematics to Ordinary Level students (S1-S4)</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Develop lesson plans and teaching materials</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Assess student progress and provide feedback</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Participate in curriculum development and staff meetings</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Supervise extracurricular activities and clubs</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-900 mb-4">Requirements</h4>
                                <ul class="space-y-3 text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Bachelor's degree in Mathematics (minimum)</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Valid teaching certificate from recognized institution</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Minimum 2 years teaching experience (fresh graduates may apply)</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Strong communication and classroom management skills</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Passion for teaching and student development</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h4 class="font-bold text-gray-900 mb-4">Benefits</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="bg-gray-50 p-4 rounded-lg text-center">
                                    <i class="fas fa-home text-maroon text-xl mb-2"></i>
                                    <div class="text-sm font-medium">Housing Allowance</div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg text-center">
                                    <i class="fas fa-heartbeat text-maroon text-xl mb-2"></i>
                                    <div class="text-sm font-medium">Medical Insurance</div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg text-center">
                                    <i class="fas fa-graduation-cap text-maroon text-xl mb-2"></i>
                                    <div class="text-sm font-medium">Training Opportunities</div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg text-center">
                                    <i class="fas fa-umbrella-beach text-maroon text-xl mb-2"></i>
                                    <div class="text-sm font-medium">Paid Leave</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <button class="view-details text-maroon font-medium hover:text-red-800 transition-colors">
                            <i class="fas fa-chevron-down mr-2"></i> View Job Details
                        </button>
                        <span class="text-sm text-gray-500">Posted: May 15, 2024</span>
                    </div>
                </div>

                <!-- Job 2 -->
                <div class="job-card bg-white rounded-xl p-6 border border-gray-200 animate-slide-up" data-category="teaching">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div class="mb-4 md:mb-0">
                            <div class="flex items-center mb-3">
                                <span class="job-type-badge full-time mr-3">Full-time</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">English Language Teacher (S5-S6)</h3>
                            <div class="flex flex-wrap items-center text-gray-600 text-sm gap-4">
                                <span><i class="fas fa-graduation-cap mr-2"></i> Minimum: B.A. English + Teaching Certificate</span>
                                <span><i class="fas fa-map-marker-alt mr-2"></i> Otuke District, Okwang Town Council</span>
                                <span><i class="far fa-clock mr-2"></i> Application Deadline: July 15, 2024</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-start md:items-end">
                            <div class="text-lg font-bold text-gray-900 mb-2">Competitive Salary</div>
                            <button class="apply-btn bg-maroon text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300" data-job="english-teacher">
                                <i class="fas fa-paper-plane mr-2"></i> Apply Now
                            </button>
                        </div>
                    </div>

                    <!-- Job Details (Hidden by default) -->
                    <div class="mt-6 pt-6 border-t border-gray-200 hidden job-details">
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <h4 class="font-bold text-gray-900 mb-4">Job Description</h4>
                                <ul class="space-y-3 text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Teach English Language and Literature to A-Level students</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Prepare students for UNEB examinations</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Develop reading and writing skills programs</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Coordinate English club and debate activities</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-900 mb-4">Requirements</h4>
                                <ul class="space-y-3 text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Bachelor's degree in English Language/Literature</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Valid teaching certificate with specialization in English</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Minimum 3 years teaching experience at A-Level</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Excellent command of written and spoken English</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <button class="view-details text-maroon font-medium hover:text-red-800 transition-colors">
                            <i class="fas fa-chevron-down mr-2"></i> View Job Details
                        </button>
                        <span class="text-sm text-gray-500">Posted: May 10, 2024</span>
                    </div>
                </div>

                <!-- Job 3 -->
                <div class="job-card bg-white rounded-xl p-6 border border-gray-200 animate-slide-up" data-category="non-teaching">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div class="mb-4 md:mb-0">
                            <div class="flex items-center mb-3">
                                <span class="job-type-badge full-time mr-3">Full-time</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Laboratory Technician</h3>
                            <div class="flex flex-wrap items-center text-gray-600 text-sm gap-4">
                                <span><i class="fas fa-graduation-cap mr-2"></i> Diploma in Laboratory Technology</span>
                                <span><i class="fas fa-map-marker-alt mr-2"></i> Otuke District, Okwang Town Council</span>
                                <span><i class="far fa-clock mr-2"></i> Application Deadline: June 25, 2024</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-start md:items-end">
                            <div class="text-lg font-bold text-gray-900 mb-2">Attractive Package</div>
                            <button class="apply-btn bg-maroon text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300" data-job="lab-technician">
                                <i class="fas fa-paper-plane mr-2"></i> Apply Now
                            </button>
                        </div>
                    </div>

                    <!-- Job Details (Hidden by default) -->
                    <div class="mt-6 pt-6 border-t border-gray-200 hidden job-details">
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <h4 class="font-bold text-gray-900 mb-4">Job Description</h4>
                                <ul class="space-y-3 text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Prepare laboratory materials and equipment for science practicals</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Maintain laboratory safety standards and protocols</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Manage inventory of laboratory supplies and chemicals</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Assist teachers during practical lessons</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-900 mb-4">Requirements</h4>
                                <ul class="space-y-3 text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Diploma in Laboratory Technology or related field</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Knowledge of laboratory safety procedures</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Experience in school laboratory setting preferred</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Attention to detail and organizational skills</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <button class="view-details text-maroon font-medium hover:text-red-800 transition-colors">
                            <i class="fas fa-chevron-down mr-2"></i> View Job Details
                        </button>
                        <span class="text-sm text-gray-500">Posted: May 5, 2024</span>
                    </div>
                </div>

                <!-- Job 4 -->
                <div class="job-card bg-white rounded-xl p-6 border border-gray-200 animate-slide-up" data-category="administrative">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div class="mb-4 md:mb-0">
                            <div class="flex items-center mb-3">
                                <span class="job-type-badge contract mr-3">Contract (1 Year)</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Administrative Assistant</h3>
                            <div class="flex flex-wrap items-center text-gray-600 text-sm gap-4">
                                <span><i class="fas fa-graduation-cap mr-2"></i> Diploma in Office Management</span>
                                <span><i class="fas fa-map-marker-alt mr-2"></i> Otuke District, Okwang Town Council</span>
                                <span><i class="far fa-clock mr-2"></i> Application Deadline: June 20, 2024</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-start md:items-end">
                            <div class="text-lg font-bold text-gray-900 mb-2">Competitive Salary</div>
                            <button class="apply-btn bg-maroon text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300" data-job="admin-assistant">
                                <i class="fas fa-paper-plane mr-2"></i> Apply Now
                            </button>
                        </div>
                    </div>

                    <!-- Job Details (Hidden by default) -->
                    <div class="mt-6 pt-6 border-t border-gray-200 hidden job-details">
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <h4 class="font-bold text-gray-900 mb-4">Job Description</h4>
                                <ul class="space-y-3 text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Provide administrative support to school administration</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Manage correspondence, filing, and record keeping</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Coordinate meetings and prepare minutes</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Assist with student admissions and registration processes</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-900 mb-4">Requirements</h4>
                                <ul class="space-y-3 text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Diploma in Office Management, Secretarial Studies or related field</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Proficiency in Microsoft Office and computer applications</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Excellent communication and organizational skills</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Minimum 2 years administrative experience</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <button class="view-details text-maroon font-medium hover:text-red-800 transition-colors">
                            <i class="fas fa-chevron-down mr-2"></i> View Job Details
                        </button>
                        <span class="text-sm text-gray-500">Posted: May 1, 2024</span>
                    </div>
                </div>

                <!-- Job 5 -->
                <div class="job-card bg-white rounded-xl p-6 border border-gray-200 animate-slide-up" data-category="non-teaching">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div class="mb-4 md:mb-0">
                            <div class="flex items-center mb-3">
                                <span class="job-type-badge part-time mr-3">Part-time</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Guidance and Counseling Officer</h3>
                            <div class="flex flex-wrap items-center text-gray-600 text-sm gap-4">
                                <span><i class="fas fa-graduation-cap mr-2"></i> Degree in Counseling Psychology</span>
                                <span><i class="fas fa-map-marker-alt mr-2"></i> Otuke District, Okwang Town Council</span>
                                <span><i class="far fa-clock mr-2"></i> Application Deadline: July 10, 2024</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-start md:items-end">
                            <div class="text-lg font-bold text-gray-900 mb-2">Attractive Package</div>
                            <button class="apply-btn bg-maroon text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300" data-job="counseling-officer">
                                <i class="fas fa-paper-plane mr-2"></i> Apply Now
                            </button>
                        </div>
                    </div>

                    <!-- Job Details (Hidden by default) -->
                    <div class="mt-6 pt-6 border-t border-gray-200 hidden job-details">
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <h4 class="font-bold text-gray-900 mb-4">Job Description</h4>
                                <ul class="space-y-3 text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Provide counseling services to students</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Develop and implement guidance programs</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Assist with career guidance and university applications</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Support students with personal and academic challenges</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-900 mb-4">Requirements</h4>
                                <ul class="space-y-3 text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Bachelor's degree in Counseling Psychology or related field</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Certification in guidance and counseling</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Experience working with adolescents</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                        <span>Strong interpersonal and listening skills</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <button class="view-details text-maroon font-medium hover:text-red-800 transition-colors">
                            <i class="fas fa-chevron-down mr-2"></i> View Job Details
                        </button>
                        <span class="text-sm text-gray-500">Posted: April 25, 2024</span>
                    </div>
                </div>
            </div>

            <!-- No Jobs Message (Hidden by default) -->
            <div id="no-jobs" class="hidden text-center py-12">
                <div class="bg-gray-100 rounded-xl p-8 max-w-md mx-auto">
                    <i class="fas fa-search text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">No Jobs Found</h3>
                    <p class="text-gray-600 mb-6">There are currently no job openings matching your selected filter.</p>
                    <button class="filter-btn active px-5 py-2 rounded-full bg-maroon text-white font-medium" data-filter="all">
                        Show All Positions
                    </button>
                </div>
            </div>

            <!-- Email Alerts -->
            <div class="mt-12 text-center">
                <div class="bg-white rounded-xl p-8 border border-gray-200 max-w-2xl mx-auto">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Get Job Alerts</h3>
                    <p class="text-gray-600 mb-6">Subscribe to receive email notifications when new positions that match your interests become available.</p>
                    <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                        <input type="email" placeholder="Your email address" class="flex-grow px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                        <button type="submit" class="bg-maroon text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-800 transition-colors whitespace-nowrap">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Apply -->
    <section id="apply" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">How to Apply</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Follow these steps to submit your application for any position at Okwang Secondary School</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <!-- Step 1 -->
                <div class="text-center animate-slide-up">
                    <div class="h-16 w-16 bg-maroon rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">1</div>
                    <h3 class="font-bold text-gray-900 text-lg mb-3">Prepare Documents</h3>
                    <p class="text-gray-600 text-sm">Gather your CV, certificates, and other required documents</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center animate-slide-up">
                    <div class="h-16 w-16 bg-maroon rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">2</div>
                    <h3 class="font-bold text-gray-900 text-lg mb-3">Complete Application</h3>
                    <p class="text-gray-600 text-sm">Fill out the application form with accurate information</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center animate-slide-up">
                    <div class="h-16 w-16 bg-maroon rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">3</div>
                    <h3 class="font-bold text-gray-900 text-lg mb-3">Submit Application</h3>
                    <p class="text-gray-600 text-sm">Submit your application before the deadline</p>
                </div>

                <!-- Step 4 -->
                <div class="text-center animate-slide-up">
                    <div class="h-16 w-16 bg-maroon rounded-full flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">4</div>
                    <h3 class="font-bold text-gray-900 text-lg mb-3">Interview & Selection</h3>
                    <p class="text-gray-600 text-sm">Shortlisted candidates will be contacted for interviews</p>
                </div>
            </div>

            <!-- Application Requirements -->
            <div class="bg-gray-50 rounded-xl p-8 border border-gray-200 animate-fade-in">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Application Requirements</h3>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="font-bold text-gray-900 mb-4">Required Documents</h4>
                        <ul class="space-y-3">
                            <li class="process-step">
                                <span class="font-medium">Updated Curriculum Vitae (CV)</span>
                                <p class="text-gray-600 text-sm mt-1">Include detailed work history and qualifications</p>
                            </li>
                            <li class="process-step">
                                <span class="font-medium">Academic Certificates</span>
                                <p class="text-gray-600 text-sm mt-1">Copies of all relevant academic certificates</p>
                            </li>
                            <li class="process-step">
                                <span class="font-medium">Professional Certificates</span>
                                <p class="text-gray-600 text-sm mt-1">Teaching certificates, licenses, or other professional qualifications</p>
                            </li>
                            <li class="process-step">
                                <span class="font-medium">National ID</span>
                                <p class="text-gray-600 text-sm mt-1">Copy of national identification document</p>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold text-gray-900 mb-4">General Requirements</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span>Meet minimum qualifications for the position</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span>Good character and professional conduct</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span>Commitment to the school's values and mission</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span>Ability to work collaboratively in a team</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span>Passion for education and student development</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Application Process Timeline -->
            <div class="mt-12 animate-fade-in">
                <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Application Process Timeline</h3>
                <div class="relative">
                    <!-- Timeline line -->
                    <div class="absolute left-0 md:left-1/2 top-0 bottom-0 w-1 bg-gray-200 transform md:-translate-x-1/2"></div>

                    <!-- Timeline items -->
                    <div class="space-y-12 relative">
                        <!-- Item 1 -->
                        <div class="flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:pr-12 md:text-right mb-4 md:mb-0">
                                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                    <h4 class="font-bold text-gray-900 mb-2">Application Submission</h4>
                                    <p class="text-gray-600 text-sm">Submit complete application before the deadline</p>
                                    <div class="mt-3">
                                        <span class="text-sm bg-maroon text-white px-3 py-1 rounded-full">Week 1-2</span>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute left-0 md:left-1/2 transform -translate-x-1/2 md:-translate-x-1/2">
                                <div class="h-6 w-6 bg-maroon rounded-full border-4 border-white"></div>
                            </div>
                            <div class="md:w-1/2 md:pl-12"></div>
                        </div>

                        <!-- Item 2 -->
                        <div class="flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:pr-12"></div>
                            <div class="absolute left-0 md:left-1/2 transform -translate-x-1/2 md:-translate-x-1/2">
                                <div class="h-6 w-6 bg-maroon rounded-full border-4 border-white"></div>
                            </div>
                            <div class="md:w-1/2 md:pl-12 mb-4 md:mb-0">
                                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                    <h4 class="font-bold text-gray-900 mb-2">Application Review</h4>
                                    <p class="text-gray-600 text-sm">HR department reviews all applications</p>
                                    <div class="mt-3">
                                        <span class="text-sm bg-school-blue text-white px-3 py-1 rounded-full">Week 3</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:pr-12 md:text-right mb-4 md:mb-0">
                                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                    <h4 class="font-bold text-gray-900 mb-2">Interviews</h4>
                                    <p class="text-gray-600 text-sm">Shortlisted candidates are invited for interviews</p>
                                    <div class="mt-3">
                                        <span class="text-sm bg-green-600 text-white px-3 py-1 rounded-full">Week 4-5</span>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute left-0 md:left-1/2 transform -translate-x-1/2 md:-translate-x-1/2">
                                <div class="h-6 w-6 bg-maroon rounded-full border-4 border-white"></div>
                            </div>
                            <div class="md:w-1/2 md:pl-12"></div>
                        </div>

                        <!-- Item 4 -->
                        <div class="flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:pr-12"></div>
                            <div class="absolute left-0 md:left-1/2 transform -translate-x-1/2 md:-translate-x-1/2">
                                <div class="h-6 w-6 bg-maroon rounded-full border-4 border-white"></div>
                            </div>
                            <div class="md:w-1/2 md:pl-12 mb-4 md:mb-0">
                                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                    <h4 class="font-bold text-gray-900 mb-2">Final Selection & Offer</h4>
                                    <p class="text-gray-600 text-sm">Successful candidates receive job offers</p>
                                    <div class="mt-3">
                                        <span class="text-sm bg-purple-600 text-white px-3 py-1 rounded-full">Week 6</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Application Form Modal -->
    <div id="application-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-gray-900" id="modal-title">Apply for Position</h3>
                <button class="text-gray-500 hover:text-gray-700" id="close-modal">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <div class="p-6">
                <form id="application-form">
                    <div class="space-y-6">
                        <!-- Personal Information -->
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Personal Information</h4>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 mb-2" for="first-name">First Name *</label>
                                    <input type="text" id="first-name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2" for="last-name">Last Name *</label>
                                    <input type="text" id="last-name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2" for="email">Email Address *</label>
                                    <input type="email" id="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2" for="phone">Phone Number *</label>
                                    <input type="tel" id="phone" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                                </div>
                            </div>
                        </div>

                        <!-- Position Applied For -->
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Position Information</h4>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 mb-2" for="position">Position Applied For *</label>
                                    <input type="text" id="position" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent" readonly>
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2" for="job-reference">Job Reference Number</label>
                                    <input type="text" id="job-reference" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Qualifications -->
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Qualifications & Experience</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-gray-700 mb-2" for="qualifications">Highest Qualification *</label>
                                    <input type="text" id="qualifications" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent" placeholder="e.g., B.Sc. Mathematics">
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2" for="experience">Years of Relevant Experience *</label>
                                    <input type="number" id="experience" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent" min="0" max="50">
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2" for="cover-letter">Cover Letter *</label>
                                    <textarea id="cover-letter" rows="4" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent" placeholder="Tell us why you're interested in this position and why you would be a good fit..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- File Uploads -->
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Required Documents</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-gray-700 mb-2" for="cv">Curriculum Vitae (CV) *</label>
                                    <input type="file" id="cv" accept=".pdf,.doc,.docx" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                                    <p class="text-gray-500 text-sm mt-1">PDF or Word document, maximum 5MB</p>
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2" for="certificates">Academic Certificates *</label>
                                    <input type="file" id="certificates" accept=".pdf,.jpg,.jpeg,.png" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent" multiple>
                                    <p class="text-gray-500 text-sm mt-1">PDF or image files, maximum 10MB total</p>
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2" for="other-documents">Other Supporting Documents</label>
                                    <input type="file" id="other-documents" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent" multiple>
                                    <p class="text-gray-500 text-sm mt-1">Optional: Reference letters, publications, etc.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6 border-t border-gray-200">
                            <button type="submit" class="w-full bg-maroon text-white px-6 py-4 rounded-lg font-bold hover:bg-red-800 transition-all duration-300 text-lg">
                                <i class="fas fa-paper-plane mr-2"></i> Submit Application
                            </button>
                            <p class="text-gray-500 text-sm mt-4 text-center">
                                By submitting this application, you agree to our <a href="#" class="text-maroon hover:underline">Privacy Policy</a> and consent to the processing of your personal data.
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Talent Pool -->
    <section class="py-16 bg-gradient-to-r from-maroon to-red-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Join Our Talent Pool</h2>
                <div class="w-24 h-1 bg-white mx-auto mb-6"></div>
                <p class="text-xl text-gray-200 max-w-2xl mx-auto">Not seeing a position that matches your skills? Submit your CV to be considered for future opportunities</p>
            </div>

            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20 max-w-3xl mx-auto animate-slide-up">
                <form id="talent-pool-form">
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-200 mb-2" for="pool-name">Full Name *</label>
                            <input type="text" id="pool-name" required class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-white">
                        </div>
                        <div>
                            <label class="block text-gray-200 mb-2" for="pool-email">Email Address *</label>
                            <input type="email" id="pool-email" required class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-white">
                        </div>
                        <div>
                            <label class="block text-gray-200 mb-2" for="pool-specialization">Area of Specialization *</label>
                            <select id="pool-specialization" required class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-white">
                                <option value="" class="text-gray-900">Select your specialization</option>
                                <option value="science" class="text-gray-900">Science Teaching</option>
                                <option value="arts" class="text-gray-900">Arts & Humanities Teaching</option>
                                <option value="business" class="text-gray-900">Business Studies Teaching</option>
                                <option value="languages" class="text-gray-900">Languages Teaching</option>
                                <option value="administrative" class="text-gray-900">Administrative Staff</option>
                                <option value="support" class="text-gray-900">Support Staff</option>
                                <option value="other" class="text-gray-900">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-200 mb-2" for="pool-cv">Upload CV *</label>
                            <input type="file" id="pool-cv" accept=".pdf,.doc,.docx" required class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-white/20 file:text-white hover:file:bg-white/30">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-200 mb-2" for="pool-message">Additional Information</label>
                        <textarea id="pool-message" rows="3" class="w-full px-4 py-3 bg-white/10 border border-white/30 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-white" placeholder="Tell us about your skills, experience, and career interests..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-white text-maroon px-6 py-4 rounded-lg font-bold hover:bg-gray-100 transition-all duration-300">
                        <i class="fas fa-user-plus mr-2"></i> Join Talent Pool
                    </button>
                </form>
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

        // Job Filtering
        const filterButtons = document.querySelectorAll('.filter-btn[data-filter]');
        const jobCards = document.querySelectorAll('.job-card');
        const noJobsMessage = document.getElementById('no-jobs');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'bg-maroon', 'text-white');
                    btn.classList.add('bg-gray-100', 'text-gray-800');
                });

                // Add active class to clicked button
                this.classList.add('active', 'bg-maroon', 'text-white');
                this.classList.remove('bg-gray-100', 'text-gray-800');

                const filterValue = this.getAttribute('data-filter');
                let visibleCount = 0;

                // Show/hide job cards based on filter
                jobCards.forEach(card => {
                    const category = card.getAttribute('data-category');

                    if (filterValue === 'all' || category === filterValue) {
                        card.style.display = 'block';
                        card.style.animation = 'slideUp 0.5s ease';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show/hide no jobs message
                if (visibleCount === 0) {
                    noJobsMessage.classList.remove('hidden');
                } else {
                    noJobsMessage.classList.add('hidden');
                }
            });
        });

        // View Job Details Toggle
        const viewDetailsButtons = document.querySelectorAll('.view-details');

        viewDetailsButtons.forEach(button => {
            button.addEventListener('click', function() {
                const card = this.closest('.job-card');
                const details = card.querySelector('.job-details');
                const icon = this.querySelector('i');

                if (details.classList.contains('hidden')) {
                    details.classList.remove('hidden');
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                    this.innerHTML = '<i class="fas fa-chevron-up mr-2"></i> Hide Job Details';
                } else {
                    details.classList.add('hidden');
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                    this.innerHTML = '<i class="fas fa-chevron-down mr-2"></i> View Job Details';
                }
            });
        });

        // Application Modal
        const applyButtons = document.querySelectorAll('.apply-btn');
        const applicationModal = document.getElementById('application-modal');
        const closeModal = document.getElementById('close-modal');
        const modalTitle = document.getElementById('modal-title');
        const positionField = document.getElementById('position');

        applyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const job = this.getAttribute('data-job');
                const card = this.closest('.job-card');
                const jobTitle = card.querySelector('h3').textContent;

                // Set modal title and position field
                modalTitle.textContent = `Apply for: ${jobTitle}`;
                positionField.value = jobTitle;

                // Generate job reference (in real app, this would come from backend)
                const jobRef = `OSS-${job.toUpperCase()}-${new Date().getFullYear()}`;
                document.getElementById('job-reference').value = jobRef;

                // Show modal
                applicationModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
        });

        // Close modal
        closeModal.addEventListener('click', function() {
            applicationModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        });

        // Close modal when clicking outside
        applicationModal.addEventListener('click', function(e) {
            if (e.target === applicationModal) {
                applicationModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });

        // Application Form Submission
        const applicationForm = document.getElementById('application-form');

        applicationForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // In a real application, this would submit to a backend
            // For demo purposes, we'll show a success message

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Submitting...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Show success message
                applicationForm.innerHTML = `
                    <div class="text-center py-12">
                        <div class="h-20 w-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-check text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Application Submitted Successfully!</h3>
                        <p class="text-gray-600 mb-6">Thank you for applying for the position. We have received your application and will review it shortly. Shortlisted candidates will be contacted for interviews.</p>
                        <button id="close-success" class="bg-maroon text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-800 transition-colors">
                            Close
                        </button>
                    </div>
                `;

                // Add event listener to close button
                document.getElementById('close-success').addEventListener('click', function() {
                    applicationModal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                    // Reset form (in a real app, you might want to reload the page)
                    location.reload();
                });
            }, 1500);
        });

        // Talent Pool Form Submission
        const talentPoolForm = document.getElementById('talent-pool-form');

        talentPoolForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Submitting...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Show success message
                talentPoolForm.innerHTML = `
                    <div class="text-center py-8">
                        <div class="h-16 w-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-check text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Thank You!</h3>
                        <p class="text-gray-200 mb-6">Your CV has been added to our talent pool. We will contact you if a suitable position becomes available.</p>
                        <button type="button" onclick="location.reload()" class="bg-white text-maroon px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            Submit Another
                        </button>
                    </div>
                `;
            }, 1500);
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

        // Job Alerts Subscription
        const jobAlertsForm = document.querySelector('form:not(#application-form):not(#talent-pool-form)');
        if (jobAlertsForm) {
            jobAlertsForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const email = this.querySelector('input[type="email"]').value;

                // Show success message
                const button = this.querySelector('button');
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check mr-2"></i> Subscribed!';
                button.disabled = true;
                button.classList.add('bg-green-600', 'hover:bg-green-600');

                // Reset after 3 seconds
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                    button.classList.remove('bg-green-600', 'hover:bg-green-600');
                    this.reset();
                }, 3000);
            });
        }
    </script>
</body>
</html>
