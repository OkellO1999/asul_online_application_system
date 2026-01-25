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

        /* News Card Styles */
        .news-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .news-card:hover .news-image {
            transform: scale(1.05);
        }

        .news-image {
            transition: transform 0.5s ease;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .news-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.3), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 20px;
            color: white;
        }

        .news-card:hover .news-overlay {
            opacity: 1;
        }

        /* Event Card Styles */
        .event-card {
            transition: all 0.3s ease;
            position: relative;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .event-date {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            border-radius: 8px;
            flex-shrink: 0;
        }

        /* Category Badges */
        .category-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .news-badge {
            background-color: rgba(59, 130, 246, 0.1);
            color: #1e40af;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .event-badge {
            background-color: rgba(5, 150, 105, 0.1);
            color: #059669;
            border: 1px solid rgba(5, 150, 105, 0.3);
        }

        .announcement-badge {
            background-color: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .achievement-badge {
            background-color: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        /* Calendar Styles */
        .calendar-day {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .calendar-day.event-day {
            background-color: #fee2e2;
            color: #991b1b;
            font-weight: 600;
        }

        .calendar-day.today {
            background-color: #800000;
            color: white;
            font-weight: 600;
        }

        .calendar-day:hover {
            background-color: #f3f4f6;
        }

        .calendar-day.event-day:hover {
            background-color: #fecaca;
        }

        /* Ticker Styles */
        .news-ticker {
            overflow: hidden;
            white-space: nowrap;
            position: relative;
        }

        .news-ticker-content {
            display: inline-block;
            animation: ticker 30s linear infinite;
        }

        .news-ticker:hover .news-ticker-content {
            animation-play-state: paused;
        }

        /* Modal Styles */
        .news-modal {
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
            .news-image {
                height: 180px;
            }

            .event-date {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>


    <!-- Page Header -->
    <section class="gradient-bg text-white py-20 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 rounded-full border-4 border-white"></div>
            <div class="absolute bottom-1/4 right-1/4 w-48 h-48 rounded-full border-4 border-white"></div>
            <div class="absolute top-1/2 right-1/3 w-32 h-32 rounded-full border-4 border-white"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center animate-fade-in">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">News & Events</h1>
                <p class="text-xl max-w-3xl mx-auto text-gray-100">Stay updated with the latest happenings, announcements, and activities at Okwang Secondary School</p>

                <!-- Breadcrumb -->
                <div class="flex justify-center items-center mt-8 space-x-2 text-sm">
                    <a href="/" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                    <span class="text-gray-300">/</span>
                    <span class="text-white font-medium">News & Events</span>
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

    <!-- Featured News -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured News</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Highlighting the most important updates from our school community</p>
            </div>

            <!-- Featured News Carousel -->
            <div class="relative overflow-hidden rounded-2xl shadow-2xl mb-12 animate-slide-up">
                <div class="grid lg:grid-cols-2">
                    <!-- Featured Image -->
                    <div class="h-96 lg:h-auto bg-gradient-to-br from-maroon to-red-800 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/30"></div>
                        <div class="absolute inset-0 flex items-center justify-center p-8">
                            <div class="text-center text-white">
                                <div class="text-sm bg-white/20 backdrop-blur-sm inline-block px-4 py-2 rounded-full mb-4">FEATURED STORY</div>
                                <h3 class="text-3xl font-bold mb-4">2024 Admissions: Record Number of Applications</h3>
                                <p class="text-gray-200 text-lg">Our school receives highest ever applications for the 2024 academic year</p>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Content -->
                    <div class="bg-white p-8 lg:p-12">
                        <div class="flex items-center mb-6">
                            <div class="h-12 w-12 bg-maroon rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-newspaper text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">Admissions Update 2024</h3>
                                <div class="flex items-center text-gray-600 text-sm mt-1">
                                    <i class="far fa-calendar-alt mr-2"></i> May 15, 2024 •
                                    <i class="far fa-clock ml-4 mr-2"></i> 3 min read
                                </div>
                            </div>
                        </div>

                        <div class="text-gray-600 mb-6">
                            <p class="mb-4">
                                Okwang Secondary School has received a record number of applications for the 2024 academic year, with over 1,200 applications for just 300 available slots. This represents a 25% increase compared to last year and reflects growing confidence in our educational standards.
                            </p>
                            <p class="mb-4">
                                The admissions office reported that applications came from all districts in Northern Uganda, with particularly strong interest in our Science and Business combinations. The school administration attributes this increase to our consistent performance in national examinations and improved facilities.
                            </p>
                            <p>
                                "We are thrilled by the overwhelming response from parents and students," said Mr. John Okello, the Principal. "This shows that our commitment to quality education is being recognized across the region."
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-3 mb-8">
                            <span class="category-badge announcement-badge">Admissions</span>
                            <span class="category-badge news-badge">School News</span>
                            <span class="category-badge achievement-badge">Achievement</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="#" class="inline-flex items-center text-maroon font-bold hover:text-red-800">
                                Read Full Story <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                            <div class="flex space-x-3">
                                <button class="text-gray-500 hover:text-maroon transition-colors">
                                    <i class="far fa-share-square"></i>
                                </button>
                                <button class="text-gray-500 hover:text-maroon transition-colors">
                                    <i class="far fa-bookmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News -->
    <section id="latest-news" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 animate-fade-in">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Latest News</h2>
                    <div class="w-24 h-1 bg-maroon mb-6"></div>
                    <p class="text-gray-600">Stay informed with recent updates from our school</p>
                </div>

                <!-- News Filter -->
                <div class="mt-4 md:mt-0">
                    <div class="flex flex-wrap gap-2">
                        <button class="filter-btn active px-4 py-2 rounded-full bg-maroon text-white text-sm font-medium" data-filter="all">
                            All News
                        </button>
                        <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 text-gray-800 text-sm font-medium hover:bg-gray-300" data-filter="announcement">
                            Announcements
                        </button>
                        <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 text-gray-800 text-sm font-medium hover:bg-gray-300" data-filter="academic">
                            Academic
                        </button>
                        <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 text-gray-800 text-sm font-medium hover:bg-gray-300" data-filter="sports">
                            Sports
                        </button>
                        <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 text-gray-800 text-sm font-medium hover:bg-gray-300" data-filter="events">
                            Events
                        </button>
                    </div>
                </div>
            </div>

            <!-- News Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- News 1 -->
                <div class="news-card bg-white rounded-xl overflow-hidden border border-gray-200 animate-slide-up" data-category="academic">
                    <div class="relative">
                        <div class="h-48 bg-gradient-to-br from-school-blue to-blue-800"></div>
                        <div class="news-overlay">
                            <span class="category-badge news-badge mb-2">Academic News</span>
                            <h3 class="font-bold text-lg mb-2">Science Lab Upgrades Complete</h3>
                            <p class="text-gray-200 text-sm">New equipment installed for better practical learning</p>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="category-badge news-badge">Academic</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-3">Science Laboratory Upgrades Complete</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            Our science laboratories have been upgraded with modern equipment to enhance practical learning. The new installations include digital microscopes, updated chemistry sets, and safety equipment.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-500 text-sm">
                                <i class="far fa-calendar-alt mr-2"></i> May 10, 2024
                            </div>
                            <a href="#" class="text-maroon font-medium hover:text-red-800 text-sm">Read More →</a>
                        </div>
                    </div>
                </div>

                <!-- News 2 -->
                <div class="news-card bg-white rounded-xl overflow-hidden border border-gray-200 animate-slide-up" data-category="announcement">
                    <div class="relative">
                        <div class="h-48 bg-gradient-to-br from-green-600 to-green-800"></div>
                        <div class="news-overlay">
                            <span class="category-badge announcement-badge mb-2">Announcement</span>
                            <h3 class="font-bold text-lg mb-2">School Calendar 2024/25 Released</h3>
                            <p class="text-gray-200 text-sm">Important dates for the upcoming academic year</p>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="category-badge announcement-badge">Announcement</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-3">2024/25 Academic Calendar Released</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            The school administration has released the academic calendar for the 2024/2025 academic year. Key dates include term openings, examinations, and holiday periods.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-500 text-sm">
                                <i class="far fa-calendar-alt mr-2"></i> May 5, 2024
                            </div>
                            <a href="#" class="text-maroon font-medium hover:text-red-800 text-sm">Read More →</a>
                        </div>
                    </div>
                </div>

                <!-- News 3 -->
                <div class="news-card bg-white rounded-xl overflow-hidden border border-gray-200 animate-slide-up" data-category="sports">
                    <div class="relative">
                        <div class="h-48 bg-gradient-to-br from-yellow-600 to-yellow-800"></div>
                        <div class="news-overlay">
                            <span class="category-badge achievement-badge mb-2">Sports Achievement</span>
                            <h3 class="font-bold text-lg mb-2">Football Team Wins District Championship</h3>
                            <p class="text-gray-200 text-sm">First district win in 5 years for our football team</p>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="category-badge achievement-badge">Sports</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-3">Football Team Wins District Championship</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            Our school football team clinched the district championship after an exciting final match against Lira Secondary School. This marks our first district win in 5 years.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-500 text-sm">
                                <i class="far fa-calendar-alt mr-2"></i> April 28, 2024
                            </div>
                            <a href="#" class="text-maroon font-medium hover:text-red-800 text-sm">Read More →</a>
                        </div>
                    </div>
                </div>

                <!-- News 4 -->
                <div class="news-card bg-white rounded-xl overflow-hidden border border-gray-200 animate-slide-up" data-category="academic">
                    <div class="relative">
                        <div class="h-48 bg-gradient-to-br from-purple-600 to-purple-800"></div>
                        <div class="news-overlay">
                            <span class="category-badge news-badge mb-2">Academic News</span>
                            <h3 class="font-bold text-lg mb-2">New Computer Lab Inaugurated</h3>
                            <p class="text-gray-200 text-sm">40 new computers installed for ICT education</p>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="category-badge news-badge">Academic</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-3">New Computer Lab Officially Opened</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            A new computer laboratory with 40 modern computers was officially inaugurated. The lab will enhance digital literacy and ICT skills among our students.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-500 text-sm">
                                <i class="far fa-calendar-alt mr-2"></i> April 20, 2024
                            </div>
                            <a href="#" class="text-maroon font-medium hover:text-red-800 text-sm">Read More →</a>
                        </div>
                    </div>
                </div>

                <!-- News 5 -->
                <div class="news-card bg-white rounded-xl overflow-hidden border border-gray-200 animate-slide-up" data-category="events">
                    <div class="relative">
                        <div class="h-48 bg-gradient-to-br from-pink-600 to-pink-800"></div>
                        <div class="news-overlay">
                            <span class="category-badge event-badge mb-2">Upcoming Event</span>
                            <h3 class="font-bold text-lg mb-2">Annual Cultural Day Preparations</h3>
                            <p class="text-gray-200 text-sm">Students preparing traditional performances</p>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="category-badge event-badge">Events</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-3">Annual Cultural Day Preparations Underway</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            Students are actively preparing for the annual cultural day celebration. The event will feature traditional dances, music, food, and cultural exhibitions from various Ugandan tribes.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-500 text-sm">
                                <i class="far fa-calendar-alt mr-2"></i> April 15, 2024
                            </div>
                            <a href="#" class="text-maroon font-medium hover:text-red-800 text-sm">Read More →</a>
                        </div>
                    </div>
                </div>

                <!-- News 6 -->
                <div class="news-card bg-white rounded-xl overflow-hidden border border-gray-200 animate-slide-up" data-category="announcement">
                    <div class="relative">
                        <div class="h-48 bg-gradient-to-br from-teal-600 to-teal-800"></div>
                        <div class="news-overlay">
                            <span class="category-badge announcement-badge mb-2">Announcement</span>
                            <h3 class="font-bold text-lg mb-2">Scholarship Opportunities Announced</h3>
                            <p class="text-gray-200 text-sm">10 full scholarships available for bright students</p>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="category-badge announcement-badge">Announcement</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 text-lg mb-3">Scholarship Opportunities for 2024</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            The school has announced 10 full scholarships for bright but financially disadvantaged students. Applications are now open for S1 and S5 entrants.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-500 text-sm">
                                <i class="far fa-calendar-alt mr-2"></i> April 10, 2024
                            </div>
                            <a href="#" class="text-maroon font-medium hover:text-red-800 text-sm">Read More →</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button id="load-more-news" class="bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 transition-all duration-300">
                    <i class="fas fa-plus-circle mr-2"></i> Load More News
                </button>
            </div>
        </div>
    </section>

    <!-- Upcoming Events -->
    <section id="events" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Upcoming Events</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Mark your calendar for important school events and activities</p>
            </div>

            <!-- Events Calendar and List -->
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Events Calendar -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 mb-8 animate-slide-up">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Events Calendar</h3>
                            <div class="flex space-x-2">
                                <button class="month-nav p-2 rounded-lg hover:bg-gray-100">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <div class="px-4 py-2 bg-gray-100 rounded-lg font-medium">June 2024</div>
                                <button class="month-nav p-2 rounded-lg hover:bg-gray-100">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Calendar Days -->
                        <div class="grid grid-cols-7 gap-2 mb-4">
                            <div class="text-center font-medium text-gray-500 text-sm py-2">Sun</div>
                            <div class="text-center font-medium text-gray-500 text-sm py-2">Mon</div>
                            <div class="text-center font-medium text-gray-500 text-sm py-2">Tue</div>
                            <div class="text-center font-medium text-gray-500 text-sm py-2">Wed</div>
                            <div class="text-center font-medium text-gray-500 text-sm py-2">Thu</div>
                            <div class="text-center font-medium text-gray-500 text-sm py-2">Fri</div>
                            <div class="text-center font-medium text-gray-500 text-sm py-2">Sat</div>
                        </div>

                        <!-- Calendar Grid -->
                        <div class="grid grid-cols-7 gap-2">
                            <!-- Generate calendar days (simplified for demo) -->
                            <div class="calendar-day">26</div>
                            <div class="calendar-day">27</div>
                            <div class="calendar-day">28</div>
                            <div class="calendar-day">29</div>
                            <div class="calendar-day">30</div>
                            <div class="calendar-day">31</div>
                            <div class="calendar-day">1</div>
                            <div class="calendar-day">2</div>
                            <div class="calendar-day">3</div>
                            <div class="calendar-day">4</div>
                            <div class="calendar-day event-day" data-event="parent-teacher">5</div>
                            <div class="calendar-day">6</div>
                            <div class="calendar-day">7</div>
                            <div class="calendar-day">8</div>
                            <div class="calendar-day">9</div>
                            <div class="calendar-day event-day" data-event="science-fair">10</div>
                            <div class="calendar-day">11</div>
                            <div class="calendar-day">12</div>
                            <div class="calendar-day">13</div>
                            <div class="calendar-day">14</div>
                            <div class="calendar-day event-day today" data-event="sports-day">15</div>
                            <div class="calendar-day">16</div>
                            <div class="calendar-day">17</div>
                            <div class="calendar-day">18</div>
                            <div class="calendar-day">19</div>
                            <div class="calendar-day">20</div>
                            <div class="calendar-day event-day" data-event="cultural-day">21</div>
                            <div class="calendar-day">22</div>
                            <div class="calendar-day">23</div>
                            <div class="calendar-day">24</div>
                            <div class="calendar-day">25</div>
                            <div class="calendar-day">26</div>
                            <div class="calendar-day">27</div>
                            <div class="calendar-day">28</div>
                            <div class="calendar-day">29</div>
                            <div class="calendar-day">30</div>
                            <div class="calendar-day">1</div>
                            <div class="calendar-day">2</div>
                            <div class="calendar-day">3</div>
                            <div class="calendar-day">4</div>
                            <div class="calendar-day">5</div>
                            <div class="calendar-day">6</div>
                        </div>

                        <!-- Event Legend -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="font-medium text-gray-900 mb-3">Event Legend</h4>
                            <div class="flex flex-wrap gap-3">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                                    <span class="text-sm text-gray-600">Parent-Teacher Meeting</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                                    <span class="text-sm text-gray-600">Science Fair</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                                    <span class="text-sm text-gray-600">Sports Day</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-purple-500 mr-2"></div>
                                    <span class="text-sm text-gray-600">Cultural Day</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Events List -->
                    <div class="space-y-6">
                        <!-- Event 1 -->
                        <div class="event-card bg-white rounded-xl p-6 border border-gray-200 hover:border-maroon transition-all duration-300 animate-slide-up">
                            <div class="flex flex-col md:flex-row md:items-center">
                                <div class="event-date bg-gradient-to-br from-maroon to-red-800 text-white mr-6 mb-4 md:mb-0">
                                    <div class="text-2xl font-bold">15</div>
                                    <div class="text-sm">JUNE</div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center mb-2">
                                        <span class="category-badge event-badge mr-3">Sports Event</span>
                                        <span class="text-gray-500 text-sm"><i class="far fa-clock mr-1"></i> 9:00 AM - 4:00 PM</span>
                                    </div>
                                    <h3 class="font-bold text-gray-900 text-lg mb-2">Annual Sports Day</h3>
                                    <p class="text-gray-600 text-sm mb-4">
                                        Inter-house sports competition featuring athletics, football, netball, and volleyball. All parents and guardians are invited to attend.
                                    </p>
                                    <div class="flex flex-wrap items-center justify-between">
                                        <div class="flex items-center text-gray-500 text-sm">
                                            <i class="fas fa-map-marker-alt mr-2"></i> School Sports Ground
                                        </div>
                                        <a href="#" class="text-maroon font-medium hover:text-red-800 text-sm">View Details →</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Event 2 -->
                        <div class="event-card bg-white rounded-xl p-6 border border-gray-200 hover:border-school-blue transition-all duration-300 animate-slide-up">
                            <div class="flex flex-col md:flex-row md:items-center">
                                <div class="event-date bg-gradient-to-br from-school-blue to-blue-800 text-white mr-6 mb-4 md:mb-0">
                                    <div class="text-2xl font-bold">10</div>
                                    <div class="text-sm">JUNE</div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center mb-2">
                                        <span class="category-badge news-badge mr-3">Academic Event</span>
                                        <span class="text-gray-500 text-sm"><i class="far fa-clock mr-1"></i> 10:00 AM - 2:00 PM</span>
                                    </div>
                                    <h3 class="font-bold text-gray-900 text-lg mb-2">Science Fair Exhibition</h3>
                                    <p class="text-gray-600 text-sm mb-4">
                                        Students showcase innovative science projects and experiments. Judges from Makerere University will evaluate projects.
                                    </p>
                                    <div class="flex flex-wrap items-center justify-between">
                                        <div class="flex items-center text-gray-500 text-sm">
                                            <i class="fas fa-map-marker-alt mr-2"></i> Science Laboratory Complex
                                        </div>
                                        <a href="#" class="text-maroon font-medium hover:text-red-800 text-sm">View Details →</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Event 3 -->
                        <div class="event-card bg-white rounded-xl p-6 border border-gray-200 hover:border-green-600 transition-all duration-300 animate-slide-up">
                            <div class="flex flex-col md:flex-row md:items-center">
                                <div class="event-date bg-gradient-to-br from-green-600 to-green-800 text-white mr-6 mb-4 md:mb-0">
                                    <div class="text-2xl font-bold">21</div>
                                    <div class="text-sm">JUNE</div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center mb-2">
                                        <span class="category-badge event-badge mr-3">Cultural Event</span>
                                        <span class="text-gray-500 text-sm"><i class="far fa-clock mr-1"></i> 8:00 AM - 5:00 PM</span>
                                    </div>
                                    <h3 class="font-bold text-gray-900 text-lg mb-2">Annual Cultural Day</h3>
                                    <p class="text-gray-600 text-sm mb-4">
                                        Celebration of Ugandan cultural diversity with traditional performances, food, music, and exhibitions. Open to the public.
                                    </p>
                                    <div class="flex flex-wrap items-center justify-between">
                                        <div class="flex items-center text-gray-500 text-sm">
                                            <i class="fas fa-map-marker-alt mr-2"></i> School Main Ground
                                        </div>
                                        <a href="#" class="text-maroon font-medium hover:text-red-800 text-sm">View Details →</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24">
                        <!-- Important Announcements -->
                        <div class="bg-gradient-to-br from-maroon to-red-800 text-white rounded-xl p-6 mb-8 animate-slide-up">
                            <h3 class="text-xl font-bold mb-6 flex items-center">
                                <i class="fas fa-bullhorn mr-3"></i> Important Announcements
                            </h3>
                            <div class="space-y-4">
                                <div class="bg-white/10 p-4 rounded-lg">
                                    <div class="text-sm font-medium mb-2">Term 2 Examinations</div>
                                    <p class="text-gray-200 text-xs">Scheduled for June 24-28, 2024. All students should prepare accordingly.</p>
                                </div>
                                <div class="bg-white/10 p-4 rounded-lg">
                                    <div class="text-sm font-medium mb-2">School Reopening Date</div>
                                    <p class="text-gray-200 text-xs">Second term begins on September 2, 2024 for all classes.</p>
                                </div>
                                <div class="bg-white/10 p-4 rounded-lg">
                                    <div class="text-sm font-medium mb-2">Library Extended Hours</div>
                                    <p class="text-gray-200 text-xs">Library will remain open until 7:00 PM during examination period.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Subscribe to Updates -->
                        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 mb-8 animate-slide-up">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Get Updates</h3>
                            <p class="text-gray-600 text-sm mb-6">Subscribe to receive news and event updates directly to your email.</p>
                            <form id="subscribe-form">
                                <div class="mb-4">
                                    <input type="email" placeholder="Your email address" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition-all">
                                </div>
                                <button type="submit" class="w-full bg-maroon text-white py-3 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300">
                                    <i class="far fa-envelope mr-2"></i> Subscribe Now
                                </button>
                            </form>
                            <div id="subscribe-success" class="hidden mt-4 p-3 bg-green-100 text-green-800 rounded-lg text-sm">
                                <i class="fas fa-check-circle mr-2"></i> Successfully subscribed to updates!
                            </div>
                        </div>

                        <!-- Event Categories -->
                        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 animate-slide-up">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Event Categories</h3>
                            <div class="space-y-3">
                                <a href="#" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-graduation-cap text-blue-600 text-sm"></i>
                                        </div>
                                        <span class="font-medium">Academic Events</span>
                                    </div>
                                    <span class="text-gray-500 text-sm">12</span>
                                </a>
                                <a href="#" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-futbol text-green-600 text-sm"></i>
                                        </div>
                                        <span class="font-medium">Sports Events</span>
                                    </div>
                                    <span class="text-gray-500 text-sm">8</span>
                                </a>
                                <a href="#" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-music text-purple-600 text-sm"></i>
                                        </div>
                                        <span class="font-medium">Cultural Events</span>
                                    </div>
                                    <span class="text-gray-500 text-sm">6</span>
                                </a>
                                <a href="#" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-users text-red-600 text-sm"></i>
                                        </div>
                                        <span class="font-medium">Parent Events</span>
                                    </div>
                                    <span class="text-gray-500 text-sm">5</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Past Events Link -->
            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center text-gray-700 hover:text-maroon transition-colors">
                    <i class="fas fa-history mr-2"></i> View Past Events Archive
                </a>
            </div>
        </div>
    </section>

    <!-- Photo Gallery of Recent Events -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Recent Event Photos</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Visual highlights from our recent school events and activities</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="h-40 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg overflow-hidden animate-slide-up">
                    <div class="h-full w-full flex items-center justify-center text-white">
                        <i class="fas fa-graduation-cap text-4xl"></i>
                    </div>
                </div>
                <div class="h-40 bg-gradient-to-br from-green-600 to-green-800 rounded-lg overflow-hidden animate-slide-up">
                    <div class="h-full w-full flex items-center justify-center text-white">
                        <i class="fas fa-futbol text-4xl"></i>
                    </div>
                </div>
                <div class="h-40 bg-gradient-to-br from-yellow-600 to-yellow-800 rounded-lg overflow-hidden animate-slide-up">
                    <div class="h-full w-full flex items-center justify-center text-white">
                        <i class="fas fa-music text-4xl"></i>
                    </div>
                </div>
                <div class="h-40 bg-gradient-to-br from-purple-600 to-purple-800 rounded-lg overflow-hidden animate-slide-up">
                    <div class="h-full w-full flex items-center justify-center text-white">
                        <i class="fas fa-flask text-4xl"></i>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="/gallery" class="inline-flex items-center bg-maroon text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300">
                    <i class="fas fa-photo-video mr-2"></i> View Full Event Gallery
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter Signup -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-maroon to-red-800 text-white rounded-2xl p-8 md:p-12 text-center animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Stay Connected</h2>
                <p class="text-xl text-gray-200 max-w-2xl mx-auto mb-8">
                    Never miss an important update. Subscribe to our newsletter and follow us on social media.
                </p>

                <div class="flex flex-col md:flex-row justify-center items-center gap-6">
                    <a href="#" class="inline-flex items-center bg-white text-maroon px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition-all duration-300">
                        <i class="fab fa-facebook-f mr-2"></i> Follow on Facebook
                    </a>
                    <a href="#" class="inline-flex items-center bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:text-maroon transition-all duration-300">
                        <i class="fab fa-twitter mr-2"></i> Follow on Twitter
                    </a>
                    <a href="#" class="inline-flex items-center bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:text-maroon transition-all duration-300">
                        <i class="fas fa-rss mr-2"></i> Subscribe to RSS
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- News Modal -->
    <div id="news-modal" class="news-modal">
        <div class="modal-content">
            <div class="p-8">
                <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl">
                    <i class="fas fa-times"></i>
                </button>

                <div id="modal-news-content">
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

        // News Ticker Animation
        const tickerContent = document.querySelector('.news-ticker-content');
        const tickerItems = tickerContent.querySelectorAll('span');

        // Duplicate content for seamless scrolling
        tickerItems.forEach(item => {
            const clone = item.cloneNode(true);
            tickerContent.appendChild(clone);
        });

        // Filter News by Category
        const filterButtons = document.querySelectorAll('.filter-btn[data-filter]');
        const newsCards = document.querySelectorAll('.news-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'bg-maroon', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-800');
                });

                // Add active class to clicked button
                this.classList.add('active', 'bg-maroon', 'text-white');
                this.classList.remove('bg-gray-200', 'text-gray-800');

                const filterValue = this.getAttribute('data-filter');

                // Show/hide news cards based on filter
                newsCards.forEach(card => {
                    if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
                        card.style.display = 'block';
                        card.style.animation = 'slideUp 0.5s ease';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Calendar Event Tooltips
        const eventDays = document.querySelectorAll('.calendar-day.event-day');
        eventDays.forEach(day => {
            day.addEventListener('mouseenter', function() {
                const eventType = this.getAttribute('data-event');
                let eventName = '';

                switch(eventType) {
                    case 'parent-teacher':
                        eventName = 'Parent-Teacher Meeting';
                        break;
                    case 'science-fair':
                        eventName = 'Science Fair Exhibition';
                        break;
                    case 'sports-day':
                        eventName = 'Annual Sports Day';
                        break;
                    case 'cultural-day':
                        eventName = 'Cultural Day Celebration';
                        break;
                }

                // Create tooltip
                const tooltip = document.createElement('div');
                tooltip.className = 'absolute bg-gray-900 text-white text-xs py-1 px-2 rounded -top-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap z-10 animate-slide-down';
                tooltip.textContent = eventName;
                this.appendChild(tooltip);
            });

            day.addEventListener('mouseleave', function() {
                const tooltip = this.querySelector('div');
                if (tooltip) {
                    tooltip.remove();
                }
            });
        });

        // Calendar Navigation
        const monthNavButtons = document.querySelectorAll('.month-nav');
        monthNavButtons.forEach(button => {
            button.addEventListener('click', function() {
                // In a real implementation, this would change the calendar month
                alert('In a complete implementation, this would navigate to the previous/next month.');
            });
        });

        // Subscribe Form
        const subscribeForm = document.getElementById('subscribe-form');
        const subscribeSuccess = document.getElementById('subscribe-success');

        subscribeForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Show success message
            subscribeSuccess.classList.remove('hidden');
            subscribeForm.reset();

            // Hide success message after 5 seconds
            setTimeout(() => {
                subscribeSuccess.classList.add('hidden');
            }, 5000);
        });

        // Load More News
        const loadMoreBtn = document.getElementById('load-more-news');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                // In a real implementation, this would load more news from a server
                // For demo purposes, we'll show a message
                this.innerHTML = '<i class="fas fa-check mr-2"></i> All News Loaded';
                this.disabled = true;
                this.classList.add('opacity-50', 'cursor-not-allowed');

                // Show success message
                const successMsg = document.createElement('div');
                successMsg.className = 'mt-4 p-4 bg-green-100 text-green-800 rounded-lg';
                successMsg.innerHTML = '<i class="fas fa-check-circle mr-2"></i> All news articles are now displayed.';
                this.parentElement.appendChild(successMsg);
            });
        }

        // News Modal
        const newsModal = document.getElementById('news-modal');
        const closeModalBtn = newsModal.querySelector('button');
        const modalContent = document.getElementById('modal-news-content');
        const readMoreLinks = document.querySelectorAll('a[href="#"]');

        // Close modal
        closeModalBtn.addEventListener('click', function() {
            newsModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });

        // Close modal when clicking outside
        newsModal.addEventListener('click', function(e) {
            if (e.target === newsModal) {
                newsModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        // Read More links (simulated)
        readMoreLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Get the news card
                const card = this.closest('.news-card') || this.closest('.event-card');
                if (card) {
                    const title = card.querySelector('h3').textContent;
                    const category = card.querySelector('.category-badge')?.textContent || 'General';
                    const date = card.querySelector('.fa-calendar-alt')?.parentElement?.textContent?.trim() || 'Recent';
                    const excerpt = card.querySelector('p')?.textContent || 'More details about this news/event.';

                    // Populate modal with news details
                    modalContent.innerHTML = `
                        <div class="mb-6">
                            <span class="category-badge ${category.includes('Announcement') ? 'announcement-badge' : category.includes('Academic') ? 'news-badge' : category.includes('Sports') ? 'achievement-badge' : 'event-badge'}">${category}</span>
                        </div>

                        <h2 class="text-3xl font-bold text-gray-900 mb-6">${title}</h2>

                        <div class="flex items-center text-gray-600 mb-8">
                            <i class="far fa-calendar-alt mr-2"></i> ${date} •
                            <i class="far fa-clock ml-4 mr-2"></i> 3 min read
                        </div>

                        <div class="prose max-w-none mb-8">
                            <p class="text-gray-600 mb-4">${excerpt}</p>
                            <p class="text-gray-600 mb-4">
                                This is a detailed expansion of the news article. In a complete implementation,
                                this would contain the full article content fetched from a database or CMS.
                            </p>
                            <p class="text-gray-600 mb-4">
                                Additional details, quotes from staff or students, and more comprehensive
                                information about the event or announcement would appear here.
                            </p>
                            <p class="text-gray-600">
                                The complete article would provide all necessary details for readers to
                                fully understand the news item and its implications for the school community.
                            </p>
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <h4 class="font-bold text-gray-900 mb-4">Share This Article</h4>
                            <div class="flex space-x-3">
                                <a href="#" class="h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-blue-100 hover:text-blue-600 transition-colors">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-blue-50 hover:text-blue-400 transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-red-100 hover:text-red-600 transition-colors">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <a href="#" class="h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-green-100 hover:text-green-600 transition-colors">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    `;

                    // Show modal
                    newsModal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                }
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

        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation delays to news cards for staggered effect
            const newsCards = document.querySelectorAll('.news-card, .event-card');
            newsCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>
