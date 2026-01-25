@extends('layouts.web.app')
@section('content')
    <!-- Tailwind CSS CDN -->
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

        .history-timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 100%;
            background: linear-gradient(to bottom, #800000, #1e40af);
        }

        .timeline-item:nth-child(odd) {
            margin-right: 50%;
            padding-right: 40px;
        }

        .timeline-item:nth-child(even) {
            margin-left: 50%;
            padding-left: 40px;
        }

        .timeline-dot {
            position: absolute;
            top: 20px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #800000;
            border: 4px solid white;
            box-shadow: 0 0 0 4px #800000;
        }

        .timeline-item:nth-child(odd) .timeline-dot {
            right: -10px;
        }

        .timeline-item:nth-child(even) .timeline-dot {
            left: -10px;
        }

        .team-card:hover .team-img {
            transform: scale(1.05);
        }

        .stats-card {
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>
</head>
    <!-- Page Header -->
    <section class="gradient-bg text-white py-20 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-40 h-40 rounded-full border-4 border-white"></div>
            <div class="absolute bottom-10 right-10 w-60 h-60 rounded-full border-4 border-white"></div>
            <div class="absolute top-1/2 left-1/4 w-20 h-20 rounded-full border-4 border-white"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center animate-fade-in">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">About Okwang Secondary School</h1>
                <p class="text-xl max-w-3xl mx-auto text-gray-100">Established in 1995, we have been shaping future leaders through quality education in the heart of Otuke District</p>

                <!-- Breadcrumb -->
                <div class="flex justify-center items-center mt-8 space-x-2 text-sm">
                    <a href="/" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                    <span class="text-gray-300">/</span>
                    <span class="text-white font-medium">About Us</span>
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

    <!-- School Overview -->
    <section id="about" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center animate-fade-in">
                <!-- Left Content -->
                <div class="animate-slide-in-left">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Our Story: Excellence in Education Since 1995</h2>
                    <div class="w-20 h-1 bg-maroon mb-8"></div>

                    <p class="text-gray-600 mb-6">
                        Okwang Secondary School was founded in 1995 with a vision to provide quality secondary education to the children of Otuke District and surrounding areas. What began as a small community initiative has grown into one of Northern Uganda's most respected educational institutions.
                    </p>

                    <p class="text-gray-600 mb-6">
                        Located in the serene environment of Okwang Town Council, our school provides a conducive learning atmosphere that combines modern education with traditional values. Over the years, we have maintained a consistent record of academic excellence while nurturing students' moral and social development.
                    </p>

                    <p class="text-gray-600 mb-8">
                        Today, Okwang Secondary School stands as a beacon of hope and opportunity, having produced thousands of graduates who are making significant contributions to society as professionals, leaders, and responsible citizens.
                    </p>

                    <div class="flex space-x-4">
                        <a href="#history" class="bg-maroon text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300 shadow-md hover:shadow-lg">
                            <i class="fas fa-history mr-2"></i> Our History
                        </a>
                        <a href="/team" class="bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-900 transition-all duration-300">
                            <i class="fas fa-users mr-2"></i> Meet Our Team
                        </a>
                    </div>
                </div>

                <!-- Right Content - Stats -->
                <div class="grid grid-cols-2 gap-6 animate-slide-in-right">
                    <div class="stats-card bg-gradient-to-br from-maroon to-red-800 text-white p-8 rounded-xl text-center shadow-lg">
                        <div class="text-4xl font-bold mb-3">25+</div>
                        <div class="text-lg font-semibold">Years of Excellence</div>
                        <p class="text-gray-200 text-sm mt-2">Serving the community since 1995</p>
                    </div>

                    <div class="stats-card bg-gradient-to-br from-school-blue to-blue-800 text-white p-8 rounded-xl text-center shadow-lg">
                        <div class="text-4xl font-bold mb-3">98%</div>
                        <div class="text-lg font-semibold">University Acceptance</div>
                        <p class="text-gray-200 text-sm mt-2">Our graduates' success rate</p>
                    </div>

                    <div class="stats-card bg-gradient-to-br from-green-600 to-green-800 text-white p-8 rounded-xl text-center shadow-lg">
                        <div class="text-4xl font-bold mb-3">700+</div>
                        <div class="text-lg font-semibold">Students</div>
                        <p class="text-gray-200 text-sm mt-2">Current student population</p>
                    </div>

                    <div class="stats-card bg-gradient-to-br from-purple-600 to-purple-800 text-white p-8 rounded-xl text-center shadow-lg">
                        <div class="text-4xl font-bold mb-3">60+</div>
                        <div class="text-lg font-semibold">Qualified Staff</div>
                        <p class="text-gray-200 text-sm mt-2">Dedicated teachers & support staff</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Guiding Principles</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">These principles guide our daily operations and long-term strategic direction</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 animate-slide-up">
                <!-- Mission Card -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-200 hover:border-maroon transition-all duration-300">
                    <div class="flex items-center mb-6">
                        <div class="h-16 w-16 bg-maroon rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-bullseye text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Our Mission</h3>
                    </div>
                    <p class="text-gray-600 mb-6">
                        To provide holistic, quality education that empowers students with knowledge, skills, and values to become responsible citizens and future leaders who contribute positively to society.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Provide quality education accessible to all</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Nurture academic excellence and moral values</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Prepare students for higher education and careers</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Foster community development and service</span>
                        </li>
                    </ul>
                </div>

                <!-- Vision Card -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-200 hover:border-school-blue transition-all duration-300">
                    <div class="flex items-center mb-6">
                        <div class="h-16 w-16 bg-school-blue rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-eye text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Our Vision</h3>
                    </div>
                    <p class="text-gray-600 mb-6">
                        To be the leading center of academic excellence in Northern Uganda, recognized for producing well-rounded graduates who excel in higher education, careers, and community leadership.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-3"></i>
                            <span>Premier educational institution in Northern Uganda</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-3"></i>
                            <span>Center for innovation and research</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-3"></i>
                            <span>Model for holistic education</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-3"></i>
                            <span>Gateway to higher education opportunities</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Core Values -->
            <div class="mt-16 animate-fade-in">
                <h3 class="text-3xl font-bold text-gray-900 mb-8 text-center">Our Core Values</h3>
                <div class="grid md:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-xl text-center border border-gray-200 hover:shadow-lg transition-all duration-300">
                        <div class="h-16 w-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-balance-scale text-maroon text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-3">Integrity</h4>
                        <p class="text-gray-600 text-sm">We uphold honesty and moral uprightness in all our dealings</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl text-center border border-gray-200 hover:shadow-lg transition-all duration-300">
                        <div class="h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-star text-school-blue text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-3">Excellence</h4>
                        <p class="text-gray-600 text-sm">We strive for the highest standards in academics and character</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl text-center border border-gray-200 hover:shadow-lg transition-all duration-300">
                        <div class="h-16 w-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-handshake text-green-600 text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-3">Discipline</h4>
                        <p class="text-gray-600 text-sm">We foster self-control and responsible behavior in our students</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl text-center border border-gray-200 hover:shadow-lg transition-all duration-300">
                        <div class="h-16 w-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-hands-helping text-purple-600 text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-3">Community</h4>
                        <p class="text-gray-600 text-sm">We serve and contribute positively to our community</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- School History Timeline -->
    <section id="history" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Journey Through Time</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">A timeline of our growth and achievements since establishment</p>
            </div>

            <div class="relative history-timeline max-w-4xl mx-auto">
                <!-- Timeline Item 1 -->
                <div class="timeline-item relative mb-12 animate-slide-in-left">
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                        <div class="timeline-dot"></div>
                        <div class="flex items-center mb-4">
                            <div class="bg-maroon text-white px-4 py-1 rounded-full text-sm font-bold">1995</div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">School Foundation</h3>
                        <p class="text-gray-600">
                            Okwang Secondary School was established with just 2 classrooms and 47 students. The school was founded by community leaders to address the need for secondary education in Otuke District.
                        </p>
                    </div>
                </div>

                <!-- Timeline Item 2 -->
                <div class="timeline-item relative mb-12 animate-slide-in-right">
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                        <div class="timeline-dot"></div>
                        <div class="flex items-center mb-4">
                            <div class="bg-school-blue text-white px-4 py-1 rounded-full text-sm font-bold">2002</div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">First Science Laboratory</h3>
                        <p class="text-gray-600">
                            The school constructed its first science laboratory, enabling students to conduct practical experiments. This marked the beginning of our strong science program.
                        </p>
                    </div>
                </div>

                <!-- Timeline Item 3 -->
                <div class="timeline-item relative mb-12 animate-slide-in-left">
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                        <div class="timeline-dot"></div>
                        <div class="flex items-center mb-4">
                            <div class="bg-maroon text-white px-4 py-1 rounded-full text-sm font-bold">2008</div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Introduction of A-Level</h3>
                        <p class="text-gray-600">
                            We introduced Advanced Level (S5-S6) education, offering Science, Arts, and Business combinations. This expanded our educational offerings and attracted students from across Northern Uganda.
                        </p>
                    </div>
                </div>

                <!-- Timeline Item 4 -->
                <div class="timeline-item relative mb-12 animate-slide-in-right">
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                        <div class="timeline-dot"></div>
                        <div class="flex items-center mb-4">
                            <div class="bg-school-blue text-white px-4 py-1 rounded-full text-sm font-bold">2015</div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">20th Anniversary & Expansion</h3>
                        <p class="text-gray-600">
                            Celebrated 20 years of excellence with the opening of new dormitories, library, and computer laboratory. Student population grew to over 800 students.
                        </p>
                    </div>
                </div>

                <!-- Timeline Item 5 -->
                <div class="timeline-item relative mb-12 animate-slide-in-left">
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                        <div class="timeline-dot"></div>
                        <div class="flex items-center mb-4">
                            <div class="bg-maroon text-white px-4 py-1 rounded-full text-sm font-bold">2020</div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Digital Learning Initiative</h3>
                        <p class="text-gray-600">
                            Launched digital learning program with smart classrooms and expanded computer lab. This prepared students for the 21st-century digital world.
                        </p>
                    </div>
                </div>

                <!-- Timeline Item 6 -->
                <div class="timeline-item relative animate-slide-in-right">
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                        <div class="timeline-dot"></div>
                        <div class="flex items-center mb-4">
                            <div class="bg-school-blue text-white px-4 py-1 rounded-full text-sm font-bold">2025</div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Excellence & Innovation</h3>
                        <p class="text-gray-600">
                            Today, Okwang Secondary School serves over 900 students with modern facilities, qualified staff, and a proven track record of academic excellence. We continue to innovate and excel in education.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- School Leadership -->
    <section id="leadership" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Meet Our Leadership Team</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Dedicated professionals guiding our school towards excellence</p>
            </div>

            <!-- Principal's Message -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-16 animate-slide-up">
                <div class="md:flex">
                    <div class="md:w-1/3 relative overflow-hidden">
                        <div class="h-full bg-gradient-to-br from-maroon to-red-800 p-8 flex flex-col justify-center text-white">
                            <div class="text-center">
                                <div class="h-40 w-40 rounded-full border-4 border-white mx-auto mb-6 overflow-hidden">
                                    <div class="h-full w-full bg-gray-300 flex items-center justify-center">
                                        <i class="fas fa-user-tie text-6xl text-gray-500"></i>
                                    </div>
                                </div>
                                <h3 class="text-2xl font-bold">Mr. Engol Geoffrey</h3>
                                <p class="text-gray-200">Headteacher</p>
                                <div class="mt-6">
                                    <div class="text-sm text-gray-300">
                                        <i class="fas fa-graduation-cap mr-2"></i> M.Ed. Educational Management
                                    </div>
                                    <div class="text-sm text-gray-300 mt-2">
                                        <i class="fas fa-award mr-2"></i> 15+ Years Experience
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                Welcome to Okwang Secondary School! As the Headteacher, it gives me great pleasure to lead an institution that has consistently maintained high standards of academic excellence since its establishment in 1995.
                            </p>
                            <p class="mb-4">
                                Our mission is to provide holistic education that develops students academically, morally, and socially. We believe every child has unique talents and potential, and our role is to nurture these talents to help students achieve their dreams.
                            </p>
                            <p>
                                At Okwang Secondary School, we combine modern teaching methods with traditional values to prepare students for the challenges of the 21st century. Our dedicated staff work tirelessly to ensure each student receives the support they need to excel.
                            </p>
                        </div>

                        <div class="border-l-4 border-maroon pl-4 italic text-gray-700">
                            "Education is the most powerful weapon which you can use to change the world. At Okwang Secondary School, we are committed to providing that weapon to every student."
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

            <!-- Leadership Team -->
            <div class="animate-fade-in">
                <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Our Administrative Team</h3>
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Team Member 1 -->
                    <div class="team-card bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:border-maroon transition-all duration-300">
                        <div class="h-64 bg-gradient-to-r from-school-blue to-blue-700 relative overflow-hidden">
                            <div class="absolute inset-0 bg-black/20"></div>
                            <div class="team-img h-32 w-32 rounded-full border-4 border-white mx-auto mt-8 bg-gray-300 flex items-center justify-center transition-transform duration-300">
                                <i class="fas fa-user-tie text-5xl text-gray-500"></i>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h4 class="font-bold text-gray-900 text-lg mb-1">Mr. Oguma Charlse</h4>
                            <p class="text-maroon font-medium mb-3">Deputy Headteacher (Academics)</p>
                            <p class="text-gray-600 text-sm mb-4">Bachelors of Ed (Maths, Physics), 12+ years experience</p>
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

                    <!-- Team Member 2 -->
                    <div class="team-card bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:border-maroon transition-all duration-300">
                        <div class="h-64 bg-gradient-to-r from-green-600 to-green-800 relative overflow-hidden">
                            <div class="absolute inset-0 bg-black/20"></div>
                            <div class="team-img h-32 w-32 rounded-full border-4 border-white mx-auto mt-8 bg-gray-300 flex items-center justify-center transition-transform duration-300">
                                <i class="fas fa-user-tie text-5xl text-gray-500"></i>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h4 class="font-bold text-gray-900 text-lg mb-1">Mr. Edong Richard</h4>
                            <p class="text-maroon font-medium mb-3">Deputy Headteacher (Administration)</p>
                            <p class="text-gray-600 text-sm mb-4">M.A. Educational Administration, 10+ years experience</p>
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

                    <!-- Team Member 3 -->
                    <div class="team-card bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:border-maroon transition-all duration-300">
                        <div class="h-64 bg-gradient-to-r from-purple-600 to-purple-800 relative overflow-hidden">
                            <div class="absolute inset-0 bg-black/20"></div>
                            <div class="team-img h-32 w-32 rounded-full border-4 border-white mx-auto mt-8 bg-gray-300 flex items-center justify-center transition-transform duration-300">
                                <i class="fas fa-user-tie text-5xl text-gray-500"></i>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h4 class="font-bold text-gray-900 text-lg mb-1">Mr. Okello Erick</h4>
                            <p class="text-maroon font-medium mb-3">Director of Studies</p>
                            <p class="text-gray-600 text-sm mb-4">M.Sc. Business Studies, 8+ years experience</p>
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

                <div class="text-center mt-12">
                    <a href="/leadership" class="inline-flex items-center bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-900 transition-all duration-300">
                        <i class="fas fa-users mr-2"></i> View Full Leadership Team
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Academic Excellence -->
    <section id="achievements" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Academic Excellence & Achievements</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Celebrating our successes and milestones in education</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mb-12 animate-slide-up">
                <!-- Achievements -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Our Achievements</h3>
                    <div class="space-y-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 bg-maroon rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-trophy text-white text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Top Performance in UNEB Exams</h4>
                                <p class="text-gray-600 text-sm">Consistent good results in both UCE and UACE examinations for the past 5 years</p>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 bg-school-blue rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-medal text-white text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Regional Science Competition Champions</h4>
                                <p class="text-gray-600 text-sm">Won 3 gold medals at the Northern Region Science Competition 2023</p>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-award text-white text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Best School in Otuke District</h4>
                                <p class="text-gray-600 text-sm">Awarded by the Ministry of Education for overall performance 2022</p>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 bg-yellow-500 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-star text-white text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">University Scholarships</h4>
                                <p class="text-gray-600 text-sm">15 students received full university scholarships in 2023</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alumni Success -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Notable Alumni</h3>
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <div class="flex items-center mb-6">
                            <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center mr-4">
                                <i class="fas fa-user-graduate text-2xl text-gray-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Dr. Sarah Adong</h4>
                                <p class="text-gray-600 text-sm">Medical Doctor, Mulago Hospital</p>
                            </div>
                        </div>

                        <div class="flex items-center mb-6">
                            <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center mr-4">
                                <i class="fas fa-user-graduate text-2xl text-gray-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Engineer Peter Okello</h4>
                                <p class="text-gray-600 text-sm">Civil Engineer, UNRA</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center mr-4">
                                <i class="fas fa-user-graduate text-2xl text-gray-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Ms. Jane Acen</h4>
                                <p class="text-gray-600 text-sm">Software Developer, Andela Uganda</p>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <a href="/alumni" class="text-maroon font-medium hover:text-red-800 inline-flex items-center">
                                <i class="fas fa-graduation-cap mr-2"></i> View More Alumni Success Stories
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Partnership -->
            <div class="bg-gradient-to-r from-maroon to-red-800 text-white rounded-xl p-8 animate-fade-in">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold mb-4">Partnerships & Affiliations</h3>
                    <p class="text-gray-200 max-w-2xl mx-auto">We collaborate with various organizations to enhance our educational offerings</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="bg-white/10 p-6 rounded-lg text-center backdrop-blur-sm">
                        <i class="fas fa-university text-3xl mb-4"></i>
                        <div class="font-bold">Ministry of Education</div>
                    </div>

                    <div class="bg-white/10 p-6 rounded-lg text-center backdrop-blur-sm">
                        <i class="fas fa-handshake text-3xl mb-4"></i>
                        <div class="font-bold">UNEB</div>
                    </div>

                    <div class="bg-white/10 p-6 rounded-lg text-center backdrop-blur-sm">
                        <i class="fas fa-book-open text-3xl mb-4"></i>
                        <div class="font-bold">Makerere University</div>
                    </div>

                    <div class="bg-white/10 p-6 rounded-lg text-center backdrop-blur-sm">
                        <i class="fas fa-globe-africa text-3xl mb-4"></i>
                        <div class="font-bold">British Council</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Join Our Community of Excellence</h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-8">
                    Be part of an institution that has been transforming lives through education for over 25 years.
                </p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="/admissions" class="bg-white text-maroon px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-file-alt mr-2"></i> Apply Now
                    </a>
                    <a href="/contact" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:text-gray-900 transition-all duration-300">
                        <i class="fas fa-phone-alt mr-2"></i> Contact Us
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

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    document.getElementById('mobile-menu').classList.add('hidden');
                }
            });
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe all elements with animation classes
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
