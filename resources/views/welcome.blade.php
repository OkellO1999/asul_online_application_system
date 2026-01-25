@extends('layouts.web.app')

@section('title', 'OKSS - Welcome to Okwang Secondary School')

@section('content')

    <!-- Announcement Bar -->
    <div class="bg-gray-600 text-white py-2">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-center">
                <span class="font-bold mr-3"><i class="fas fa-bullhorn mr-2"></i>NEWS:</span>
                <div class="overflow-hidden">
                    <div class="animate-marquee whitespace-nowrap">
                        <span class="mx-8">🎓 2026 Admissions Now Open! Apply Online Today</span>
                        <span class="mx-8">🏆 Our Students Win Regional Science Competition</span>
                        <span class="mx-8">📅 Parent-Teacher Conference: June 15th, 2026</span>
                        <span class="mx-8">🎨 Annual Cultural Day: July 20th, 2026</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section with Animated News/Events -->
    <section id="home" class="gradient-bg text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="animate-slide-in-left">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        Shaping Future Leaders Through <span class="text-yellow-300">Quality Education</span>
                    </h1>
                    <p class="text-xl mb-8 text-gray-100">
                        Located in the heart of Otuke District, Okwang Secondary School provides holistic education combining academic excellence with moral values since 1995.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#admissions" class="bg-white text-maroon px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <i class="fas fa-file-alt mr-2"></i> Apply Now
                        </a>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-3 gap-6 mt-12">
                        <div class="text-center">
                            <div class="text-3xl font-bold mb-2">98%</div>
                            <div class="text-sm">University Acceptance</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold mb-2">25+</div>
                            <div class="text-sm">Years Experience</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold mb-2">1500+</div>
                            <div class="text-sm">Students</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Animated News/Events -->
                <div class="animate-slide-in-right">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20 shadow-2xl">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold"><i class="fas fa-calendar-alt mr-3"></i> Latest News & Events</h2>
                            <div class="bg-white/20 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-bell mr-1"></i> Updates
                            </div>
                        </div>

                        <!-- News/Events Carousel -->
                        <div id="news-carousel" class="space-y-6">
                            <!-- News Item 1 -->
                            <div class="news-card bg-white/10 p-5 rounded-lg border border-white/20 hover:border-white/40 transition-all duration-300 cursor-pointer">
                                <div class="flex items-start">
                                    <div class="bg-maroon p-3 rounded-lg mr-4">
                                        <i class="fas fa-graduation-cap text-2xl"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center mb-2">
                                            <span class="bg-red-800 text-white text-xs px-2 py-1 rounded mr-3">NEW</span>
                                            <span class="text-gray-300 text-sm"><i class="far fa-clock mr-1"></i> May 15, 2026</span>
                                        </div>
                                        <h3 class="font-bold text-lg mb-2">2026 Admissions Now Open</h3>
                                        <p class="text-gray-200 text-sm">Applications for S1, S5 and other classes are now being accepted for the 2026 academic year.</p>
                                        <a href="#" class="text-yellow-300 text-sm font-medium mt-2 inline-block hover:underline">Read More →</a>
                                    </div>
                                </div>
                            </div>

                            <!-- News Item 2 -->
                            <div class="news-card bg-white/10 p-5 rounded-lg border border-white/20 hover:border-white/40 transition-all duration-300 cursor-pointer">
                                <div class="flex items-start">
                                    <div class="bg-school-blue p-3 rounded-lg mr-4">
                                        <i class="fas fa-trophy text-2xl"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center mb-2">
                                            <span class="bg-blue-800 text-white text-xs px-2 py-1 rounded mr-3">AWARD</span>
                                            <span class="text-gray-300 text-sm"><i class="far fa-clock mr-1"></i> May 10, 2026</span>
                                        </div>
                                        <h3 class="font-bold text-lg mb-2">Regional Science Competition Winners</h3>
                                        <p class="text-gray-200 text-sm">Our students won 3 gold medals at the Northern Region Science Competition held in Lira.</p>
                                        <a href="#" class="text-yellow-300 text-sm font-medium mt-2 inline-block hover:underline">Read More →</a>
                                    </div>
                                </div>
                            </div>

                            <!-- News Item 3 -->
                            <div class="news-card bg-white/10 p-5 rounded-lg border border-white/20 hover:border-white/40 transition-all duration-300 cursor-pointer">
                                <div class="flex items-start">
                                    <div class="bg-green-700 p-3 rounded-lg mr-4">
                                        <i class="fas fa-calendar-day text-2xl"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center mb-2">
                                            <span class="bg-green-800 text-white text-xs px-2 py-1 rounded mr-3">EVENT</span>
                                            <span class="text-gray-300 text-sm"><i class="far fa-clock mr-1"></i> June 15, 2026</span>
                                        </div>
                                        <h3 class="font-bold text-lg mb-2">Parent-Teacher Conference</h3>
                                        <p class="text-gray-200 text-sm">Annual parent-teacher conference to discuss student progress and school development.</p>
                                        <a href="#" class="text-yellow-300 text-sm font-medium mt-2 inline-block hover:underline">Read More →</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Carousel Controls -->
                        <div class="flex justify-center mt-6 space-x-4">
                            <button class="news-prev bg-white/20 hover:bg-white/30 p-2 rounded-full transition-colors">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                                <div class="w-2 h-2 bg-white/50 rounded-full"></div>
                                <div class="w-2 h-2 bg-white/50 rounded-full"></div>
                            </div>
                            <button class="news-next bg-white/20 hover:bg-white/30 p-2 rounded-full transition-colors">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>

                        <!-- View All Link -->
                        <div class="text-center mt-6 pt-6 border-t border-white/20">
                            <a href="#news" class="text-white hover:text-yellow-300 font-medium">
                                <i class="far fa-newspaper mr-2"></i> View All News & Events
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Animated Wave Background -->
        <div class="relative h-20 overflow-hidden">
            <div class="absolute bottom-0 w-full">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="fill-current text-white">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
                </svg>
            </div>
        </div>
    </section>

    <!-- News & Events Section -->
    <section id="news" class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Latest News & Events</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Stay updated with the latest happenings at Okwang Secondary School</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- News Card 1 -->
                <div class="news-card bg-gray-50 rounded-xl overflow-hidden border border-gray-200 hover:border-maroon transition-all duration-300">
                    <div class="h-48 bg-gradient-to-r from-maroon to-red-700 relative overflow-hidden">
                        <div class="absolute top-4 left-4 bg-white text-maroon px-3 py-1 rounded-full text-sm font-bold">
                            <i class="fas fa-calendar-alt mr-1"></i> June 20, 2026
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                            <span class="bg-yellow-500 text-black text-xs px-2 py-1 rounded">UPCOMING EVENT</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Annual Sports Day</h3>
                        <p class="text-gray-600 mb-4">Join us for our annual inter-house sports competition featuring athletics, football, netball and more.</p>
                        <a href="#" class="text-maroon font-medium hover:text-red-800 inline-flex items-center">
                            Read More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- News Card 2 -->
                <div class="news-card bg-gray-50 rounded-xl overflow-hidden border border-gray-200 hover:border-maroon transition-all duration-300">
                    <div class="h-48 bg-gradient-to-r from-school-blue to-blue-700 relative overflow-hidden">
                        <div class="absolute top-4 left-4 bg-white text-school-blue px-3 py-1 rounded-full text-sm font-bold">
                            <i class="fas fa-calendar-alt mr-1"></i> May 5, 2026
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                            <span class="bg-green-500 text-white text-xs px-2 py-1 rounded">ACHIEVEMENT</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">New Science Laboratory Opening</h3>
                        <p class="text-gray-600 mb-4">Our new state-of-the-art science laboratory is now open, equipped with modern equipment for better learning.</p>
                        <a href="#" class="text-maroon font-medium hover:text-red-800 inline-flex items-center">
                            Read More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- News Card 3 -->
                <div class="news-card bg-gray-50 rounded-xl overflow-hidden border border-gray-200 hover:border-maroon transition-all duration-300">
                    <div class="h-48 bg-gradient-to-r from-purple-700 to-purple-900 relative overflow-hidden">
                        <div class="absolute top-4 left-4 bg-white text-purple-700 px-3 py-1 rounded-full text-sm font-bold">
                            <i class="fas fa-calendar-alt mr-1"></i> April 28, 2026
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">IMPORTANT</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Term 1 Examination Results</h3>
                        <p class="text-gray-600 mb-4">Term 1 examination results are now available. Students achieved excellent results with 85% scoring Division I & II.</p>
                        <a href="#" class="text-maroon font-medium hover:text-red-800 inline-flex items-center">
                            Read More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center bg-maroon text-white px-8 py-3 rounded-lg font-bold hover:bg-red-800 transition-all duration-300 shadow-md hover:shadow-lg">
                    <i class="far fa-newspaper mr-3"></i> View All News & Events
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">About Okwang Secondary School</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Excellence in Education Since 1995</h3>
                    <p class="text-gray-600 mb-6">
                        Okwang Secondary School, located in Okwang Town Council, Otuke District, has been a pillar of academic excellence in Northern Uganda for over 25 years. We are committed to providing holistic education that nurtures both academic prowess and moral values.
                    </p>
                    <p class="text-gray-600 mb-8">
                        Our mission is to empower students with knowledge, skills, and values to become responsible citizens and future leaders who contribute positively to society.
                    </p>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex items-center">
                            <div class="bg-maroon p-3 rounded-lg mr-4">
                                <i class="fas fa-award text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Academic Excellence</h4>
                                <p class="text-gray-600 text-sm">Consistent top performance in national exams</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="bg-school-blue p-3 rounded-lg mr-4">
                                <i class="fas fa-users text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Qualified Staff</h4>
                                <p class="text-gray-600 text-sm">Experienced and dedicated teaching staff</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="bg-green-600 p-3 rounded-lg mr-4">
                                <i class="fas fa-heart text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Holistic Development</h4>
                                <p class="text-gray-600 text-sm">Focus on academic, sports, and moral growth</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="bg-yellow-500 p-3 rounded-lg mr-4">
                                <i class="fas fa-shield-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Safe Environment</h4>
                                <p class="text-gray-600 text-sm">Secure and conducive learning environment</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="bg-white rounded-xl shadow-xl p-8 border border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Our Core Values</h3>

                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 bg-red-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-balance-scale text-maroon text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-bold text-gray-900">Integrity</h4>
                                    <p class="text-gray-600">We uphold honesty and moral uprightness in all our dealings.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-star text-school-blue text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-bold text-gray-900">Excellence</h4>
                                    <p class="text-gray-600">We strive for the highest standards in academics and character.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-handshake text-green-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-bold text-gray-900">Discipline</h4>
                                    <p class="text-gray-600">We foster self-control and responsible behavior in our students.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 bg-purple-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-hands-helping text-purple-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-bold text-gray-900">Community</h4>
                                    <p class="text-gray-600">We serve and contribute positively to our community.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative Element -->
                    <div class="absolute -bottom-4 -right-4 h-24 w-24 bg-maroon rounded-full opacity-20"></div>
                    <div class="absolute -top-4 -left-4 h-16 w-16 bg-school-blue rounded-full opacity-20"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Admissions Section -->
    <section id="admissions" class="gradient-bg text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Admissions Open for 2026 Academic Year</h2>
                <p class="text-xl max-w-2xl mx-auto text-gray-100">Join our community of learners. Applications for S1, S5 and other classes are now being accepted.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto mb-12">
                <!-- Step 1 -->
                <div class="bg-white/10 p-8 rounded-xl backdrop-blur-sm border border-white/20 text-center transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="h-16 w-16 bg-white text-maroon rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                        1
                    </div>
                    <h3 class="text-xl font-bold mb-4">Submit Application</h3>
                    <p class="text-gray-200">Complete the online or paper application form with required documents</p>
                    <div class="mt-6">
                        <span class="bg-white/20 px-4 py-2 rounded-lg text-sm">Deadline: June 30, 2026</span>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="bg-white/10 p-8 rounded-xl backdrop-blur-sm border border-white/20 text-center transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="h-16 w-16 bg-white text-maroon rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                        2
                    </div>
                    <h3 class="text-xl font-bold mb-4">Entrance Examination</h3>
                    <p class="text-gray-200">Take our entrance assessment at the school premises on scheduled dates</p>
                    <div class="mt-6">
                        <span class="bg-white/20 px-4 py-2 rounded-lg text-sm">Date: July 15, 2026</span>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="bg-white/10 p-8 rounded-xl backdrop-blur-sm border border-white/20 text-center transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="h-16 w-16 bg-white text-maroon rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6">
                        3
                    </div>
                    <h3 class="text-xl font-bold mb-4">Interview & Admission</h3>
                    <p class="text-gray-200">Final interview and issuance of admission letters to successful candidates</p>
                    <div class="mt-6">
                        <span class="bg-white/20 px-4 py-2 rounded-lg text-sm">Starts: August 1, 2026</span>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="#" class="inline-flex items-center bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:text-maroon transition-all duration-300">
                    <i class="fas fa-laptop mr-3"></i> Apply Online
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Contact Us</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Get in touch with us for inquiries, admissions, or partnerships</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Contact Information -->
                <div>
                    <div class="bg-gray-50 rounded-xl p-8 border border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-900 mb-8">Get in Touch</h3>

                        <div class="space-y-8">
                            <!-- Address -->
                            <div class="flex items-start">
                                <div class="h-12 w-12 bg-maroon rounded-full flex items-center justify-center mr-6 flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg mb-2">Address</h4>
                                    <p class="text-gray-600">Okwang Town Council, Otuke District<br>Northern Region, Uganda</p>
                                    <p class="text-gray-500 text-sm mt-2"><i class="fas fa-clock mr-1"></i> Office Hours: Mon-Fri 8:00 AM - 5:00 PM</p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-start">
                                <div class="h-12 w-12 bg-school-blue rounded-full flex items-center justify-center mr-6 flex-shrink-0">
                                    <i class="fas fa-phone-alt text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg mb-2">Phone</h4>
                                    <p class="text-gray-600">+256 772 123 456 (Administration)<br>+256 752 987 654 (Admissions Office)</p>
                                    <p class="text-gray-500 text-sm mt-2"><i class="fas fa-fax mr-1"></i> Fax: +256 414 123 456</p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start">
                                <div class="h-12 w-12 bg-green-600 rounded-full flex items-center justify-center mr-6 flex-shrink-0">
                                    <i class="fas fa-envelope text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg mb-2">Email</h4>
                                    <p class="text-gray-600">info@okwangsecondary.ac.ug<br>admissions@okwangsecondary.ac.ug</p>
                                    <p class="text-gray-500 text-sm mt-2"><i class="fas fa-globe mr-1"></i> Website: www.okwangsecondary.ac.ug</p>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="mt-10 pt-8 border-t border-gray-200">
                            <h4 class="font-bold text-gray-900 mb-4">Follow Us</h4>
                            <div class="flex space-x-4">
                                <a href="#" class="h-12 w-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-maroon transition-colors">
                                    <i class="fab fa-facebook-f text-white"></i>
                                </a>
                                <a href="#" class="h-12 w-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-school-blue transition-colors">
                                    <i class="fab fa-twitter text-white"></i>
                                </a>
                                <a href="#" class="h-12 w-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition-colors">
                                    <i class="fab fa-instagram text-white"></i>
                                </a>
                                <a href="#" class="h-12 w-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                                    <i class="fab fa-whatsapp text-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div>
                    <div class="bg-gray-50 rounded-xl p-8 border border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-900 mb-8">Send Us a Message</h3>
                        <form id="contact-form">
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-gray-700 mb-2" for="name">Full Name *</label>
                                    <input type="text" id="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition-all" placeholder="Enter your full name">
                                </div>

                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-gray-700 mb-2" for="email">Email Address *</label>
                                        <input type="email" id="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition-all" placeholder="Enter your email">
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 mb-2" for="phone">Phone Number</label>
                                        <input type="tel" id="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition-all" placeholder="Enter your phone number">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2" for="subject">Subject *</label>
                                    <select id="subject" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition-all">
                                        <option value="">Select a subject</option>
                                        <option value="admission">Admission Inquiry</option>
                                        <option value="academic">Academic Information</option>
                                        <option value="partnership">Partnership Opportunities</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2" for="message">Message *</label>
                                    <textarea id="message" rows="5" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition-all" placeholder="Enter your message"></textarea>
                                </div>

                                <button type="submit" class="w-full bg-maroon text-white px-6 py-4 rounded-lg font-bold hover:bg-red-800 transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center">
                                    <i class="fas fa-paper-plane mr-3"></i> Send Message
                                </button>
                            </div>
                        </form>

                        <div id="form-success" class="hidden mt-6 p-4 bg-green-100 text-green-800 rounded-lg">
                            <i class="fas fa-check-circle mr-2"></i> Thank you! Your message has been sent successfully.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
