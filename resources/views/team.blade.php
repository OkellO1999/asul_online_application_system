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

        /* Team Member Card Styles */
        .team-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .team-card:hover .team-img {
            transform: scale(1.05);
        }

        .team-img {
            transition: transform 0.5s ease;
            width: 100%;
            height: 280px;
            object-fit: cover;
        }

        .team-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(128, 0, 0, 0.9), rgba(128, 0, 0, 0.7), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 20px;
            color: white;
        }

        .team-card:hover .team-overlay {
            opacity: 1;
        }

        /* Department Badges */
        .dept-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .science-badge {
            background-color: rgba(59, 130, 246, 0.1);
            color: #1e40af;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .arts-badge {
            background-color: rgba(139, 92, 246, 0.1);
            color: #7c3aed;
            border: 1px solid rgba(139, 92, 246, 0.3);
        }

        .business-badge {
            background-color: rgba(5, 150, 105, 0.1);
            color: #059669;
            border: 1px solid rgba(5, 150, 105, 0.3);
        }

        .language-badge {
            background-color: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .admin-badge {
            background-color: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .support-badge {
            background-color: rgba(107, 114, 128, 0.1);
            color: #6b7280;
            border: 1px solid rgba(107, 114, 128, 0.3);
        }

        /* Leadership Card */
        .leadership-card {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .leadership-card:hover {
            border-color: #800000;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Staff Filter */
        .filter-btn {
            transition: all 0.3s ease;
        }

        .filter-btn.active {
            background-color: #800000;
            color: white;
        }

        /* Stats Counter Animation */
        .stat-number {
            font-variant-numeric: tabular-nums;
        }

        /* Staff Grid Animation */
        .staff-item {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        /* Modal Styles */
        .team-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background-color: white;
            border-radius: 12px;
            max-width: 800px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }

        @media (max-width: 768px) {
            .team-img {
                height: 220px;
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
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">Meet Our Team</h1>
                <p class="text-xl max-w-3xl mx-auto text-gray-100">Dedicated professionals shaping the future of education in Otuke District</p>

                <!-- Breadcrumb -->
                <div class="flex justify-center items-center mt-8 space-x-2 text-sm">
                    <a href="/" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                    <span class="text-gray-300">/</span>
                    <a href="/about" class="text-gray-300 hover:text-white transition-colors">About Us</a>
                    <span class="text-gray-300">/</span>
                    <span class="text-white font-medium">Our Team</span>
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



    <!-- School Leadership -->
    <section id="leadership" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">School Leadership</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Our dedicated leadership team guiding the school's vision and strategic direction</p>
            </div>

            <!-- Principal's Message -->
            <div class="mb-16 animate-slide-up">
                <div class="leadership-card rounded-xl shadow-lg overflow-hidden">
                    <div class="md:flex">
                        <div class="md:w-1/3 bg-gradient-to-b from-maroon to-red-800 p-8 flex flex-col justify-center relative">
                            <div class="text-white text-center">
                                <div class="h-48 w-48 rounded-full border-4 border-white mx-auto mb-6 overflow-hidden bg-gray-300 flex items-center justify-center">
                                    <i class="fas fa-user-tie text-6xl text-gray-500"></i>
                                </div>
                                <h3 class="text-2xl font-bold">Mr. Engol Geoffrey</h3>
                                <p class="text-gray-200">Headteacher</p>
                                <div class="mt-6">
                                    <div class="text-sm text-gray-300">
                                        <i class="fas fa-graduation-cap mr-2"></i> M.Ed. Educational Management
                                    </div>
                                    <div class="text-sm text-gray-300 mt-2">
                                        <i class="fas fa-award mr-2"></i> 18 Years Experience
                                    </div>
                                </div>
                            </div>
                            <div class="absolute -bottom-6 -right-6 h-32 w-32 bg-white/10 rounded-full"></div>
                        </div>

                        <div class="md:w-2/3 p-8">
                            <div class="flex items-center mb-6">
                                <div class="h-12 w-12 bg-maroon rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-quote-left text-white text-xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900">Message from the Headteacher</h3>
                            </div>

                            <div class="text-gray-600 mb-6">
                                <p class="mb-4">
                                    At Okwang Secondary School, we believe that exceptional teachers and staff are the foundation of quality education. Our team of dedicated professionals is committed to nurturing each student's potential and preparing them for success in higher education and beyond.
                                </p>
                                <p class="mb-4">
                                    Our staff members are not just educators; they are mentors, role models, and guides who inspire students to achieve their dreams. With diverse expertise and a shared passion for education, they create a supportive learning environment where every student can thrive.
                                </p>
                                <p>
                                    I am proud to lead such a committed team of professionals who work tirelessly to maintain our school's tradition of excellence while innovating for the future.
                                </p>
                            </div>

                            <div class="border-l-4 border-maroon pl-4 italic text-gray-700">
                                "Great schools are built by great teachers. At Okwang, we are fortunate to have some of the most dedicated educators in Northern Uganda."
                            </div>

                            <div class="mt-8">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-signature text-gray-600"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold">Mr. Engol Geoffrey</div>
                                        <div class="text-sm text-gray-600">Headteacher, Okwang Secondary School</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leadership Team -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Deputy Principal (Academics) -->
                <div class="leadership-card rounded-xl p-6 animate-slide-up">
                    <div class="text-center mb-6">
                        <div class="h-32 w-32 rounded-full border-4 border-maroon mx-auto mb-4 overflow-hidden bg-gray-300 flex items-center justify-center">
                            <i class="fas fa-user-tie text-5xl text-gray-500"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Mr. Oguma Charlse</h3>
                        <p class="text-maroon font-medium">Deputy Headteacher (Academics)</p>
                        <div class="mt-2">
                            <span class="dept-badge admin-badge">Administration</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> M.Ed. Physics, maths
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Oversees academic programs, teacher development, and curriculum implementation. 12+ years experience in educational leadership.
                        </p>

                        <div class="flex justify-center space-x-3">
                            <a href="#" class="h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-maroon hover:text-white transition-colors">
                                <i class="fas fa-envelope text-xs"></i>
                            </a>
                            <a href="#" class="h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-school-blue hover:text-white transition-colors">
                                <i class="fab fa-linkedin-in text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Deputy Principal (Administration) -->
                <div class="leadership-card rounded-xl p-6 animate-slide-up">
                    <div class="text-center mb-6">
                        <div class="h-32 w-32 rounded-full border-4 border-school-blue mx-auto mb-4 overflow-hidden bg-gray-300 flex items-center justify-center">
                            <i class="fas fa-user-tie text-5xl text-gray-500"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Mr. Edong Richard</h3>
                        <p class="text-school-blue font-medium">Deputy Headteacher (Administration)</p>
                        <div class="mt-2">
                            <span class="dept-badge admin-badge">Administration</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> M.A. Educational Administration
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Manages school operations, facilities, and support services. 10+ years experience in school administration.
                        </p>

                        <div class="flex justify-center space-x-3">
                            <a href="#" class="h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-maroon hover:text-white transition-colors">
                                <i class="fas fa-envelope text-xs"></i>
                            </a>
                            <a href="#" class="h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-school-blue hover:text-white transition-colors">
                                <i class="fab fa-linkedin-in text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Director of Studies -->
                <div class="leadership-card rounded-xl p-6 animate-slide-up">
                    <div class="text-center mb-6">
                        <div class="h-32 w-32 rounded-full border-4 border-green-600 mx-auto mb-4 overflow-hidden bg-gray-300 flex items-center justify-center">
                            <i class="fas fa-user-tie text-5xl text-gray-500"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Mr. Okello Erick</h3>
                        <p class="text-green-600 font-medium">Director of Studies</p>
                        <div class="mt-2">
                            <span class="dept-badge admin-badge">Administration</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> M.Sc. Business education
                        </div>
                        <p class="text-gray-600 text-sm mb-6">
                            Coordinates academic schedules, examinations, and learning resources. 8+ years experience in academic coordination.
                        </p>

                        <div class="flex justify-center space-x-3">
                            <a href="#" class="h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-maroon hover:text-white transition-colors">
                                <i class="fas fa-envelope text-xs"></i>
                            </a>
                            <a href="#" class="h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-school-blue hover:text-white transition-colors">
                                <i class="fab fa-linkedin-in text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Teaching Staff -->
    <section id="teaching" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Teaching Staff</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Our qualified and experienced teaching staff across various departments</p>
            </div>

            <!-- Department Filter -->
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <button class="filter-btn active px-5 py-2 rounded-full bg-maroon text-white font-medium" data-filter="all">
                    All Departments
                </button>
                <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-800 font-medium hover:bg-gray-200" data-filter="science">
                    Science Department
                </button>
                <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-800 font-medium hover:bg-gray-200" data-filter="arts">
                    Arts Department
                </button>
                <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-800 font-medium hover:bg-gray-200" data-filter="business">
                    Business Department
                </button>
                <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-800 font-medium hover:bg-gray-200" data-filter="language">
                    Languages Department
                </button>
            </div>

            <!-- Teaching Staff Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="teaching-staff-grid">
                <!-- Science Teachers -->
                <!-- Teacher 1 -->
                <div class="team-card bg-white rounded-xl overflow-hidden border border-gray-200 staff-item" data-department="science">
                    <div class="h-64 bg-gradient-to-br from-school-blue to-blue-800 relative overflow-hidden">
                        <div class="team-overlay">
                            <div class="dept-badge science-badge mb-2">Science Department</div>
                            <h3 class="font-bold text-lg mb-1">Mr. Odongo Bonny</h3>
                            <p class="text-gray-200 text-sm mb-4">Senior Physics Teacher</p>
                            <p class="text-gray-300 text-xs mb-4">M.Sc. Physics, 15 years experience. Specializes in modern physics and laboratory instruction.</p>
                            <button class="view-profile bg-white text-maroon px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                                View Full Profile
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Mr. Otara Calvin</h3>
                        <p class="text-maroon font-medium mb-3">Senior Physics Teacher</p>
                        <div class="flex items-center text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> M.Sc. Physics
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="dept-badge science-badge">Physics</span>
                            <span class="text-gray-500 text-sm">15 yrs exp</span>
                        </div>
                    </div>
                </div>

                <!-- Teacher 2 -->
                <div class="team-card bg-white rounded-xl overflow-hidden border border-gray-200 staff-item" data-department="science">
                    <div class="h-64 bg-gradient-to-br from-green-600 to-green-800 relative overflow-hidden">
                        <div class="team-overlay">
                            <div class="dept-badge science-badge mb-2">Science Department</div>
                            <h3 class="font-bold text-lg mb-1">Mr. Ogwang Calvin</h3>
                            <p class="text-gray-200 text-sm mb-4">Chemistry Teacher</p>
                            <p class="text-gray-300 text-xs mb-4">M.Sc. Chemistry, 12 years experience. Focus on practical chemistry and safety protocols.</p>
                            <button class="view-profile bg-white text-maroon px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                                View Full Profile
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Mr. Ekom Tonny</h3>
                        <p class="text-green-600 font-medium mb-3">Chemistry Teacher</p>
                        <div class="flex items-center text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> M.Sc. Chemistry
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="dept-badge science-badge">Chemistry</span>
                            <span class="text-gray-500 text-sm">12 yrs exp</span>
                        </div>
                    </div>
                </div>

                <!-- Teacher 3 -->
                <div class="team-card bg-white rounded-xl overflow-hidden border border-gray-200 staff-item" data-department="science">
                    <div class="h-64 bg-gradient-to-br from-purple-600 to-purple-800 relative overflow-hidden">
                        <div class="team-overlay">
                            <div class="dept-badge science-badge mb-2">Science Department</div>
                            <h3 class="font-bold text-lg mb-1">Mr. Allan Okello</h3>
                            <p class="text-gray-200 text-sm mb-4">Biology Teacher</p>
                            <p class="text-gray-300 text-xs mb-4">M.Sc. Biology, 10 years experience. Specializes in human biology and environmental science.</p>
                            <button class="view-profile bg-white text-maroon px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                                View Full Profile
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Mr. Geoffrey Ocen</h3>
                        <p class="text-purple-600 font-medium mb-3">Biology Teacher</p>
                        <div class="flex items-center text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> M.Sc. Biology
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="dept-badge science-badge">Biology</span>
                            <span class="text-gray-500 text-sm">10 yrs exp</span>
                        </div>
                    </div>
                </div>

                <!-- Teacher 4 -->
                <div class="team-card bg-white rounded-xl overflow-hidden border border-gray-200 staff-item" data-department="science">
                    <div class="h-64 bg-gradient-to-br from-teal-600 to-teal-800 relative overflow-hidden">
                        <div class="team-overlay">
                            <div class="dept-badge science-badge mb-2">Science Department</div>
                            <h3 class="font-bold text-lg mb-1">Mr. Ageta Ambrose </h3>
                            <p class="text-gray-200 text-sm mb-4">Mathematics Teacher</p>
                            <p class="text-gray-300 text-xs mb-4">M.Sc. Mathematics, 8 years experience. Focus on calculus and statistics.</p>
                            <button class="view-profile bg-white text-maroon px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                                View Full Profile
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Mr. Oyanga Francis</h3>
                        <p class="text-teal-600 font-medium mb-3">Mathematics Teacher</p>
                        <div class="flex items-center text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> M.Sc. Mathematics
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="dept-badge science-badge">Mathematics</span>
                            <span class="text-gray-500 text-sm">8 yrs exp</span>
                        </div>
                    </div>
                </div>

                <!-- Arts Teachers -->
                <!-- Teacher 5 -->
                <div class="team-card bg-white rounded-xl overflow-hidden border border-gray-200 staff-item" data-department="arts">
                    <div class="h-64 bg-gradient-to-br from-yellow-600 to-yellow-800 relative overflow-hidden">
                        <div class="team-overlay">
                            <div class="dept-badge arts-badge mb-2">Arts Department</div>
                            <h3 class="font-bold text-lg mb-1">Mr. Isiko Paul</h3>
                            <p class="text-gray-200 text-sm mb-4">History Teacher</p>
                            <p class="text-gray-300 text-xs mb-4">M.A. History, 14 years experience. Specializes in African history and political science.</p>
                            <button class="view-profile bg-white text-maroon px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                                View Full Profile
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Mr. Abila Jaspher</h3>
                        <p class="text-yellow-600 font-medium mb-3">History Teacher</p>
                        <div class="flex items-center text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> M.A. History
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="dept-badge arts-badge">History</span>
                            <span class="text-gray-500 text-sm">14 yrs exp</span>
                        </div>
                    </div>
                </div>

                <!-- Teacher 6 -->
                <div class="team-card bg-white rounded-xl overflow-hidden border border-gray-200 staff-item" data-department="arts">
                    <div class="h-64 bg-gradient-to-br from-pink-600 to-pink-800 relative overflow-hidden">
                        <div class="team-overlay">
                            <div class="dept-badge arts-badge mb-2">Arts Department</div>
                            <h3 class="font-bold text-lg mb-1">Mrs. Rose Adoch</h3>
                            <p class="text-gray-200 text-sm mb-4">Geography Teacher</p>
                            <p class="text-gray-300 text-xs mb-4">M.A. Geography, 11 years experience. Focus on physical geography and environmental studies.</p>
                            <button class="view-profile bg-white text-maroon px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                                View Full Profile
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Mr. Ogwel Alex</h3>
                        <p class="text-pink-600 font-medium mb-3">Geography Teacher</p>
                        <div class="flex items-center text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> M.A. Geography
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="dept-badge arts-badge">Geography</span>
                            <span class="text-gray-500 text-sm">11 yrs exp</span>
                        </div>
                    </div>
                </div>

                <!-- Teacher 7 -->
                <div class="team-card bg-white rounded-xl overflow-hidden border border-gray-200 staff-item" data-department="arts">
                    <div class="h-64 bg-gradient-to-br from-indigo-600 to-indigo-800 relative overflow-hidden">
                        <div class="team-overlay">
                            <div class="dept-badge arts-badge mb-2">Arts Department</div>
                            <h3 class="font-bold text-lg mb-1">Mr. Bruno Bonny Okello</h3>
                            <p class="text-gray-200 text-sm mb-4">CRE Teacher</p>
                            <p class="text-gray-300 text-xs mb-4">M.A. Religious Studies, 9 years experience. Specializes in Christian ethics and moral education.</p>
                            <button class="view-profile bg-white text-maroon px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                                View Full Profile
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Mr. Abila Jaspher</h3>
                        <p class="text-indigo-600 font-medium mb-3">CRE Teacher</p>
                        <div class="flex items-center text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> M.A. Religious Studies
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="dept-badge arts-badge">CRE</span>
                            <span class="text-gray-500 text-sm">9 yrs exp</span>
                        </div>
                    </div>
                </div>

                <!-- Teacher 8 -->
                <div class="team-card bg-white rounded-xl overflow-hidden border border-gray-200 staff-item" data-department="business">
                    <div class="h-64 bg-gradient-to-br from-emerald-600 to-emerald-800 relative overflow-hidden">
                        <div class="team-overlay">
                            <div class="dept-badge business-badge mb-2">Business Department</div>
                            <h3 class="font-bold text-lg mb-1">Mr. Bua Samuel</h3>
                            <p class="text-gray-200 text-sm mb-4">Commerce Teacher</p>
                            <p class="text-gray-300 text-xs mb-4">Business Education, 7 years experience. Focus on business principles and entrepreneurship.</p>
                            <button class="view-profile bg-white text-maroon px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                                View Full Profile
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-1"></h3>
                        <p class="text-emerald-600 font-medium mb-3">Commerce Teacher</p>
                        <div class="flex items-center text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> Business. Educ.
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="dept-badge business-badge">Commerce</span>
                            <span class="text-gray-500 text-sm">7 yrs exp</span>
                        </div>
                    </div>
                </div>

                <!-- Teacher 9 -->
                <div class="team-card bg-white rounded-xl overflow-hidden border border-gray-200 staff-item" data-department="business">
                    <div class="h-64 bg-gradient-to-br from-amber-600 to-amber-800 relative overflow-hidden">
                        <div class="team-overlay">
                            <div class="dept-badge business-badge mb-2">Business Department</div>
                            <h3 class="font-bold text-lg mb-1">Mr. Eyit James</h3>
                            <p class="text-gray-200 text-sm mb-4">Economics Teacher</p>
                            <p class="text-gray-300 text-xs mb-4">M.A. Economics, 10 years experience. Specializes in microeconomics and development economics.</p>
                            <button class="view-profile bg-white text-maroon px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                                View Full Profile
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Mr. Okello Erick</h3>
                        <p class="text-amber-600 font-medium mb-3">Economics Teacher</p>
                        <div class="flex items-center text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> M.A. Economics
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="dept-badge business-badge">Economics</span>
                            <span class="text-gray-500 text-sm">10 yrs exp</span>
                        </div>
                    </div>
                </div>

                <!-- Teacher 10 -->
                <div class="team-card bg-white rounded-xl overflow-hidden border border-gray-200 staff-item" data-department="language">
                    <div class="h-64 bg-gradient-to-br from-rose-600 to-rose-800 relative overflow-hidden">
                        <div class="team-overlay">
                            <div class="dept-badge language-badge mb-2">Languages Department</div>
                            <h3 class="font-bold text-lg mb-1">Mrs. Anyinge Monica</h3>
                            <p class="text-gray-200 text-sm mb-4">English Teacher</p>
                            <p class="text-gray-300 text-xs mb-4">M.A. English Literature, 13 years experience. Focus on literature analysis and writing skills.</p>
                            <button class="view-profile bg-white text-maroon px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                                View Full Profile
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Mrs. Janet Arach</h3>
                        <p class="text-rose-600 font-medium mb-3">English Teacher</p>
                        <div class="flex items-center text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> M.A. English Literature
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="dept-badge language-badge">English</span>
                            <span class="text-gray-500 text-sm">13 yrs exp</span>
                        </div>
                    </div>
                </div>

                <!-- Teacher 11 -->
                <div class="team-card bg-white rounded-xl overflow-hidden border border-gray-200 staff-item" data-department="language">
                    <div class="h-64 bg-gradient-to-br from-cyan-600 to-cyan-800 relative overflow-hidden">
                        <div class="team-overlay">
                            <div class="dept-badge language-badge mb-2">Languages Department</div>
                            <h3 class="font-bold text-lg mb-1">Mr. Eyen Francis</h3>
                            <p class="text-gray-200 text-sm mb-4">Luganda Teacher</p>
                            <p class="text-gray-300 text-xs mb-4">M.A. African Languages, 8 years experience. Specializes in Luganda literature and grammar.</p>
                            <button class="view-profile bg-white text-maroon px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                                View Full Profile
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Mr. Safari Ronald</h3>
                        <p class="text-cyan-600 font-medium mb-3">Kiswahili Teacher</p>
                        <div class="flex items-center text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> Kiswahili. Educ.
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="dept-badge language-badge">Kiswahili</span>
                            <span class="text-gray-500 text-sm">8 yrs exp</span>
                        </div>
                    </div>
                </div>

                <!-- Teacher 12 -->
                <div class="team-card bg-white rounded-xl overflow-hidden border border-gray-200 staff-item" data-department="science">
                    <div class="h-64 bg-gradient-to-br from-blue-600 to-blue-800 relative overflow-hidden">
                        <div class="team-overlay">
                            <div class="dept-badge science-badge mb-2">Science Department</div>
                            <h3 class="font-bold text-lg mb-1">Mr. Kasirye Ronald</h3>
                            <p class="text-gray-200 text-sm mb-4">Head of ICT dept.</p>
                            <p class="text-gray-300 text-xs mb-4">B.Sc. Computer Science, 6 years experience. Focus on programming and digital literacy.</p>
                            <button class="view-profile bg-white text-maroon px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition-colors">
                                View Full Profile
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-1">Mr. Okello Emmanuel</h3>
                        <p class="text-blue-600 font-medium mb-3">ICT Teacher</p>
                        <div class="flex items-center text-gray-600 text-sm mb-4">
                            <i class="fas fa-graduation-cap mr-2"></i> B.Sc. Computer Science
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="dept-badge science-badge">ICT</span>
                            <span class="text-gray-500 text-sm">6 yrs exp</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12" id="load-more-container">
                <button id="load-more-staff" class="bg-maroon text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300">
                    <i class="fas fa-users mr-2"></i> View More Teaching Staff
                </button>
            </div>
        </div>
    </section>

    <!-- Support Staff -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Support Staff</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Our dedicated support staff who ensure the smooth operation of our school</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Support Staff 1 -->
                <div class="bg-white rounded-xl p-6 text-center border border-gray-200 hover:shadow-lg transition-all duration-300 animate-slide-up">
                    <div class="h-24 w-24 rounded-full bg-gradient-to-br from-maroon to-red-800 mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-user-nurse text-3xl text-white"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-2">Ms. Rebecca Auma</h3>
                    <p class="text-maroon font-medium mb-3">School Nurse</p>
                    <p class="text-gray-600 text-sm mb-4">Diploma in Nursing, 5 years experience. Provides health services and first aid to students.</p>
                    <span class="dept-badge support-badge">Health Services</span>
                </div>

                <!-- Support Staff 2 -->
                <div class="bg-white rounded-xl p-6 text-center border border-gray-200 hover:shadow-lg transition-all duration-300 animate-slide-up">
                    <div class="h-24 w-24 rounded-full bg-gradient-to-br from-school-blue to-blue-800 mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-user-shield text-3xl text-white"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-2">Mr. Samuel Okello</h3>
                    <p class="text-school-blue font-medium mb-3">Security Officer</p>
                    <p class="text-gray-600 text-sm mb-4">Certified security professional, 8 years experience. Ensures campus safety and security.</p>
                    <span class="dept-badge support-badge">Security</span>
                </div>

                <!-- Support Staff 3 -->
                <div class="bg-white rounded-xl p-6 text-center border border-gray-200 hover:shadow-lg transition-all duration-300 animate-slide-up">
                    <div class="h-24 w-24 rounded-full bg-gradient-to-br from-green-600 to-green-800 mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-utensils text-3xl text-white"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-2">Mrs. Grace Adong</h3>
                    <p class="text-green-600 font-medium mb-3">Head Cook</p>
                    <p class="text-gray-600 text-sm mb-4">Certificate in Catering, 10 years experience. Manages school kitchen and meal preparation.</p>
                    <span class="dept-badge support-badge">Catering</span>
                </div>

                <!-- Support Staff 4 -->
                <div class="bg-white rounded-xl p-6 text-center border border-gray-200 hover:shadow-lg transition-all duration-300 animate-slide-up">
                    <div class="h-24 w-24 rounded-full bg-gradient-to-br from-purple-600 to-purple-800 mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-broom text-3xl text-white"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-2">Mr. Thomas Ocen</h3>
                    <p class="text-purple-600 font-medium mb-3">Maintenance Supervisor</p>
                    <p class="text-gray-600 text-sm mb-4">15 years experience. Oversees school facilities maintenance and repairs.</p>
                    <span class="dept-badge support-badge">Maintenance</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Our Team -->
    <section class="py-16 bg-gradient-to-r from-maroon to-red-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="animate-slide-in-left">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Join Our Team</h2>
                    <p class="text-xl text-gray-200 mb-8">
                        Are you passionate about education and want to make a difference in the lives of students? We're always looking for talented educators and support staff to join our team.
                    </p>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-300 mt-1 mr-3"></i>
                            <span>Competitive salary and benefits package</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-300 mt-1 mr-3"></i>
                            <span>Professional development opportunities</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-300 mt-1 mr-3"></i>
                            <span>Supportive and collaborative work environment</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-300 mt-1 mr-3"></i>
                            <span>Opportunity to shape future generations</span>
                        </li>
                    </ul>
                </div>

                <div class="animate-slide-in-right">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20">
                        <h3 class="text-2xl font-bold mb-6">Current Vacancies</h3>

                        <div class="space-y-6">
                            <div class="bg-white/5 p-4 rounded-lg border border-white/10">
                                <h4 class="font-bold text-lg mb-2">Mathematics Teacher</h4>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <span class="text-xs bg-white/20 px-3 py-1 rounded-full">Full-time</span>
                                    <span class="text-xs bg-white/20 px-3 py-1 rounded-full">S1-S4</span>
                                </div>
                                <p class="text-gray-200 text-sm mb-3">Minimum requirement: B.Sc. Mathematics with Teaching Certificate</p>
                                <a href="#" class="text-white font-medium hover:underline inline-flex items-center">
                                    Apply Now <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>

                            <div class="bg-white/5 p-4 rounded-lg border border-white/10">
                                <h4 class="font-bold text-lg mb-2">Laboratory Technician</h4>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    <span class="text-xs bg-white/20 px-3 py-1 rounded-full">Full-time</span>
                                    <span class="text-xs bg-white/20 px-3 py-1 rounded-full">Science Department</span>
                                </div>
                                <p class="text-gray-200 text-sm mb-3">Minimum requirement: Diploma in Laboratory Technology</p>
                                <a href="#" class="text-white font-medium hover:underline inline-flex items-center">
                                    Apply Now <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>

                        <div class="mt-8">
                            <a href="#" class="inline-flex items-center bg-white text-maroon px-6 py-3 rounded-lg font-bold hover:bg-gray-100 transition-all duration-300 w-full justify-center">
                                <i class="fas fa-briefcase mr-2"></i> View All Vacancies
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Modal -->
    <div id="team-modal" class="team-modal">
        <div class="modal-content">
            <div class="p-8">
                <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-2xl"></i>
                </button>

                <div id="modal-content">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

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
            const statElements = document.querySelectorAll('.stat-number');

            statElements.forEach(stat => {
                const target = parseInt(stat.getAttribute('data-count'));
                const duration = 2000; // 2 seconds
                const increment = target / (duration / 16); // 60fps
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

        // Staff Filtering
        const filterButtons = document.querySelectorAll('.filter-btn[data-filter]');
        const staffItems = document.querySelectorAll('.staff-item');

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

                // Animate items out
                staffItems.forEach(item => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';

                    setTimeout(() => {
                        if (filterValue === 'all' || item.getAttribute('data-department') === filterValue) {
                            item.style.display = 'block';
                            // Animate back in
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'translateY(0)';
                            }, 50);
                        } else {
                            item.style.display = 'none';
                        }
                    }, 300);
                });
            });
        });

        // Load More Staff (simulated)
        const loadMoreBtn = document.getElementById('load-more-staff');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                // In a real implementation, this would load more staff from a server
                // For demo purposes, we'll show a message
                this.innerHTML = '<i class="fas fa-check mr-2"></i> All Staff Loaded';
                this.disabled = true;
                this.classList.add('opacity-50', 'cursor-not-allowed');

                // Show success message
                const successMsg = document.createElement('div');
                successMsg.className = 'mt-4 p-4 bg-green-100 text-green-800 rounded-lg';
                successMsg.innerHTML = '<i class="fas fa-check-circle mr-2"></i> All teaching staff are now displayed.';
                document.getElementById('load-more-container').appendChild(successMsg);
            });
        }

        // Team Modal
        const modal = document.getElementById('team-modal');
        const closeModalBtn = modal.querySelector('button');
        const modalContent = document.getElementById('modal-content');
        const viewProfileButtons = document.querySelectorAll('.view-profile');

        // Close modal
        closeModalBtn.addEventListener('click', function() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });

        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        // View Profile buttons
        viewProfileButtons.forEach(button => {
            button.addEventListener('click', function() {
                const card = this.closest('.team-card');
                const name = card.querySelector('h3').textContent;
                const position = card.querySelector('.font-medium').textContent;
                const department = card.querySelector('.dept-badge').textContent;
                const qualification = card.querySelector('.fa-graduation-cap').parentElement.textContent.trim();
                const experience = card.querySelector('.text-gray-500').textContent;
                const description = card.querySelector('.team-overlay p:nth-child(4)').textContent;

                // Populate modal with staff details
                modalContent.innerHTML = `
                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="md:col-span-1">
                            <div class="h-64 rounded-xl bg-gradient-to-br from-maroon to-red-800 mb-6 flex items-center justify-center">
                                <i class="fas fa-user-tie text-8xl text-white"></i>
                            </div>
                            <div class="text-center">
                                <h3 class="text-2xl font-bold text-gray-900">${name}</h3>
                                <p class="text-maroon font-medium mb-4">${position}</p>
                                <span class="dept-badge ${department === 'Science' ? 'science-badge' : department === 'Arts' ? 'arts-badge' : department === 'Business' ? 'business-badge' : 'language-badge'}">${department}</span>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <h4 class="text-xl font-bold text-gray-900 mb-6">Professional Profile</h4>

                            <div class="space-y-6">
                                <div>
                                    <h5 class="font-bold text-gray-900 mb-2">Qualifications</h5>
                                    <p class="text-gray-600">${qualification}</p>
                                </div>

                                <div>
                                    <h5 class="font-bold text-gray-900 mb-2">Experience</h5>
                                    <p class="text-gray-600">${experience} of teaching experience at Okwang Secondary School and other institutions.</p>
                                </div>

                                <div>
                                    <h5 class="font-bold text-gray-900 mb-2">Specialization</h5>
                                    <p class="text-gray-600">${description}</p>
                                </div>

                                <div>
                                    <h5 class="font-bold text-gray-900 mb-2">Teaching Philosophy</h5>
                                    <p class="text-gray-600">Believes in creating an engaging and inclusive learning environment where every student can achieve their full potential. Focuses on practical applications of subject matter and critical thinking development.</p>
                                </div>

                                <div>
                                    <h5 class="font-bold text-gray-900 mb-2">Contact</h5>
                                    <div class="flex space-x-4">
                                        <a href="#" class="h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-maroon hover:text-white transition-colors">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                        <a href="#" class="h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-school-blue hover:text-white transition-colors">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // Show modal
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
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

        // Initialize staff items with staggered animation
        document.addEventListener('DOMContentLoaded', function() {
            const staffItems = document.querySelectorAll('.staff-item');
            staffItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>
