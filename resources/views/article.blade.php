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

        /* Article Content Styling */
        .article-content {
            font-family: 'Merriweather', serif;
            line-height: 1.8;
            color: #374151;
        }

        .article-content h2 {
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            color: #111827;
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-size: 1.75rem;
        }

        .article-content h3 {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            color: #1f2937;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            font-size: 1.5rem;
        }

        .article-content p {
            margin-bottom: 1.5rem;
            font-size: 1.125rem;
        }

        .article-content blockquote {
            border-left: 4px solid #800000;
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: #4b5563;
            font-size: 1.25rem;
        }

        .article-content ul, .article-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .article-content li {
            margin-bottom: 0.5rem;
        }

        .article-content img {
            border-radius: 12px;
            margin: 2rem 0;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Table of Contents */
        .toc {
            background-color: #f9fafb;
            border-left: 4px solid #800000;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .toc ul {
            list-style-type: none;
            padding-left: 0;
        }

        .toc li {
            margin-bottom: 0.75rem;
        }

        .toc a {
            color: #4b5563;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .toc a:hover {
            color: #800000;
        }

        /* Reading Progress Bar */
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: #e5e7eb;
            z-index: 1000;
        }

        .reading-progress-bar {
            height: 100%;
            background-color: #800000;
            width: 0%;
            transition: width 0.3s ease;
        }

        /* Social Share Buttons */
        .share-btn {
            transition: all 0.3s ease;
        }

        .share-btn:hover {
            transform: translateY(-3px);
        }

        /* Author Card */
        .author-card {
            border-left: 4px solid #800000;
        }

        /* Related Article Card */
        .related-article {
            transition: all 0.3s ease;
        }

        .related-article:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Article Image Modal */
        .image-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 1100;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
        }

        .image-modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 8px;
        }

        .image-modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            color: white;
            background: rgba(0, 0, 0, 0.5);
            border: none;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 50%;
            font-size: 1.5rem;
            transition: background 0.3s ease;
        }

        .image-modal-close:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        /* Print Styles */
        @media print {
            .no-print {
                display: none !important;
            }

            .article-content {
                font-size: 12pt;
                line-height: 1.6;
            }

            .article-content img {
                max-width: 100%;
                height: auto;
            }
        }
    </style>
</head>

    <!-- Article Header -->
    <header class="gradient-bg text-white py-12 relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb -->
            <div class="mb-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2 text-sm">
                        <li>
                            <a href="/" class="text-gray-300 hover:text-white transition-colors">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <span class="text-gray-300 mx-2">/</span>
                        </li>
                        <li>
                            <a href="/news" class="text-gray-300 hover:text-white transition-colors">News & Events</a>
                        </li>
                        <li>
                            <span class="text-gray-300 mx-2">/</span>
                        </li>
                        <li>
                            <span class="text-white font-medium">Article</span>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Article Category & Date -->
            <div class="flex flex-wrap items-center gap-4 mb-6">
                <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-bold">
                    <i class="fas fa-trophy mr-2"></i> ACHIEVEMENT
                </span>
                <span class="bg-white/10 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm">
                    <i class="far fa-calendar-alt mr-2"></i> May 15, 2024
                </span>
                <span class="bg-white/10 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm">
                    <i class="far fa-clock mr-2"></i> 5 min read
                </span>
            </div>

            <!-- Article Title -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                Okwang Students Win 3 Gold Medals at Northern Region Science Competition 2024
            </h1>

            <!-- Article Excerpt -->
            <p class="text-xl text-gray-100 mb-8 max-w-3xl">
                Our talented science students showcase innovation and excellence at the annual regional competition, bringing honor to Otuke District.
            </p>

            <!-- Author & Social -->
            <div class="flex flex-wrap items-center justify-between gap-4 pt-6 border-t border-white/20">
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-full bg-gray-300 flex items-center justify-center mr-4">
                        <i class="fas fa-user text-gray-600 text-xl"></i>
                    </div>
                    <div>
                        <div class="font-bold">By John Opio</div>
                        <div class="text-gray-300 text-sm">School Correspondent</div>
                    </div>
                </div>

                <!-- Social Share -->
                <div class="flex items-center space-x-4">
                    <span class="text-gray-300 text-sm hidden md:block">Share this article:</span>
                    <div class="flex space-x-3">
                        <a href="#" class="share-btn h-10 w-10 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="share-btn h-10 w-10 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="share-btn h-10 w-10 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="#" class="share-btn h-10 w-10 bg-white/10 rounded-full flex items-center justify-center text-white hover:bg-white/20">
                            <i class="fas fa-link"></i>
                        </a>
                    </div>
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
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Article Content (2/3 width) -->
            <article class="lg:col-span-2">
                <!-- Featured Image -->
                <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
                    <div class="h-96 bg-gradient-to-br from-blue-800 to-blue-900 relative">
                        <div class="absolute inset-0 bg-black/30"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white p-8">
                                <i class="fas fa-flask text-6xl mb-6 text-white/80"></i>
                                <h2 class="text-3xl font-bold">Northern Region Science Competition 2024</h2>
                                <p class="text-xl mt-4 text-white/90">Okwang Secondary School team with their gold medals</p>
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/70 to-transparent">
                            <div class="text-white text-sm">
                                <i class="fas fa-camera mr-2"></i> Photo: School Media Team
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table of Contents (for longer articles) -->
                <div class="toc mb-8 animate-slide-up">
                    <h3 class="font-bold text-gray-900 text-lg mb-4 flex items-center">
                        <i class="fas fa-list-ul mr-3 text-maroon"></i> Table of Contents
                    </h3>
                    <ul>
                        <li><a href="#competition-overview">• Competition Overview & Participants</a></li>
                        <li><a href="#winning-projects">• Winning Projects & Innovations</a></li>
                        <li><a href="#student-interviews">• Student Interviews & Experiences</a></li>
                        <li><a href="#teacher-perspective">• Teacher & Principal Perspective</a></li>
                        <li><a href="#future-implications">• Future Implications & Next Steps</a></li>
                    </ul>
                </div>

                <!-- Article Content -->
                <div class="article-content bg-white rounded-xl shadow-lg p-6 md:p-8 animate-fade-in">
                    <!-- Introduction -->
                    <p class="lead text-xl font-semibold text-gray-900 mb-8">
                        In a remarkable display of scientific prowess, students from Okwang Secondary School secured three gold medals at the prestigious Northern Region Science Competition held in Lira City from May 10-12, 2024. This outstanding achievement marks the school's best performance in the competition's history.
                    </p>

                    <h2 id="competition-overview">Competition Overview & Participants</h2>

                    <p>
                        The Northern Region Science Competition, now in its 15th year, brought together over 200 students from 45 secondary schools across Northern Uganda. The competition aims to promote scientific innovation, critical thinking, and practical application of STEM (Science, Technology, Engineering, and Mathematics) knowledge among secondary school students.
                    </p>

                    <p>
                        Okwang Secondary School fielded a team of eight students across three categories: Physics & Engineering, Chemistry & Materials Science, and Biology & Environmental Science. The team was accompanied by two science teachers, Mr. David Opio (Physics) and Mrs. Jane Akello (Chemistry), who served as mentors and guides throughout the competition.
                    </p>

                    <div class="my-8 p-6 bg-blue-50 border-l-4 border-school-blue rounded-r-lg">
                        <h3 class="font-bold text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-info-circle mr-3 text-school-blue"></i> Quick Facts
                        </h3>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span><strong>Competition:</strong> 15th Northern Region Science Competition</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span><strong>Location:</strong> Lira City, Uganda</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span><strong>Duration:</strong> May 10-12, 2024 (3 days)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span><strong>Participants:</strong> 200+ students from 45 schools</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                <span><strong>Okwang Team:</strong> 8 students, 2 teacher mentors</span>
                            </li>
                        </ul>
                    </div>

                    <h2 id="winning-projects">Winning Projects & Innovations</h2>

                    <p>
                        The gold medals were awarded for three innovative projects that impressed the panel of judges comprising university professors, industry experts, and Ministry of Education officials.
                    </p>

                    <h3>1. Solar-Powered Water Purification System</h3>

                    <p>
                        Sarah Adongo (S5 Science) and Peter Okello (S5 Science) developed a low-cost, solar-powered water purification system specifically designed for rural communities without access to electricity. Their system uses locally available materials and solar energy to purify contaminated water, making it safe for drinking.
                    </p>

                    <blockquote>
                        "We wanted to address the water crisis affecting many villages in our district. Our system can purify 20 liters of water in just 2 hours using only solar energy," explained Sarah during her project presentation.
                    </blockquote>

                    <h3>2. Biodegradable Plastic from Cassava Starch</h3>

                    <p>
                        Grace Auma (S6 Biology) created an environmentally friendly alternative to conventional plastic using cassava starch. Her biodegradable plastic decomposes within 3 months, compared to hundreds of years for traditional plastics. The project earned praise for its environmental impact and practicality.
                    </p>

                    <h3>3. Mobile App for Agricultural Pest Detection</h3>

                    <p>
                        Joseph Odong (S6 Computer) and Alice Adong (S6 Biology) developed a mobile application that uses artificial intelligence to identify crop diseases and pests from photos taken by farmers. The app provides instant diagnosis and suggests organic treatment options, helping farmers reduce crop losses.
                    </p>

                    <!-- Image Gallery -->
                    <div class="my-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="rounded-xl overflow-hidden cursor-pointer article-image">
                            <div class="h-64 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                                <div class="text-center text-white p-6">
                                    <i class="fas fa-water text-5xl mb-4 text-gray-300"></i>
                                    <p class="font-bold">Water Purification System</p>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-xl overflow-hidden cursor-pointer article-image">
                            <div class="h-64 bg-gradient-to-br from-green-800 to-green-900 flex items-center justify-center">
                                <div class="text-center text-white p-6">
                                    <i class="fas fa-leaf text-5xl mb-4 text-gray-300"></i>
                                    <p class="font-bold">Biodegradable Plastic</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2 id="student-interviews">Student Interviews & Experiences</h2>

                    <p>
                        We spoke with the winning students about their experiences, challenges, and future aspirations.
                    </p>

                    <div class="my-8 p-6 bg-gray-50 rounded-xl border border-gray-200">
                        <div class="flex items-start mb-6">
                            <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center mr-4">
                                <i class="fas fa-user-graduate text-2xl text-gray-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Sarah Adongo, Gold Medalist</h4>
                                <p class="text-gray-600 text-sm mb-3">S5 Science Student</p>
                                <p class="text-gray-700">
                                    "The competition was challenging but incredibly rewarding. We spent three months preparing our project, conducting experiments after school hours. Winning the gold medal validates all the hard work and shows that students from rural schools can compete at the highest level."
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center mr-4">
                                <i class="fas fa-user-graduate text-2xl text-gray-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Joseph Odong, Gold Medalist</h4>
                                <p class="text-gray-600 text-sm mb-3">S6 Computer Student</p>
                                <p class="text-gray-700">
                                    "Developing the AI-powered app was a steep learning curve. We had to learn new programming languages and machine learning concepts. But our computer teacher, Ms. Alice Adong, provided excellent guidance. This experience has inspired me to pursue computer science at university."
                                </p>
                            </div>
                        </div>
                    </div>

                    <h2 id="teacher-perspective">Teacher & Principal Perspective</h2>

                    <p>
                        The science teachers and school principal expressed immense pride in the students' achievements and highlighted the school's commitment to STEM education.
                    </p>

                    <div class="my-8 p-6 bg-gradient-to-r from-maroon/5 to-red-800/5 rounded-xl border border-maroon/20">
                        <div class="flex items-start">
                            <div class="h-12 w-12 bg-maroon rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Mr. David Opio, Physics Teacher & Team Mentor</h4>
                                <p class="text-gray-700">
                                    "These students exemplify what can be achieved with dedication and proper guidance. We've invested in upgrading our science laboratories and providing extra tutoring for interested students. The results speak for themselves. This victory is not just for Okwang Secondary School but for the entire Otuke District."
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="my-8 p-6 bg-gradient-to-r from-school-blue/5 to-blue-800/5 rounded-xl border border-school-blue/20">
                        <div class="flex items-start">
                            <div class="h-12 w-12 bg-school-blue rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-user-tie text-white text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Mr. John Okello, School Principal</h4>
                                <p class="text-gray-700">
                                    "This achievement is a testament to our school's focus on holistic education and academic excellence. We believe in nurturing not just academic knowledge but also innovation and practical problem-solving skills. The success at the regional competition motivates us to continue investing in science education and facilities."
                                </p>
                            </div>
                        </div>
                    </div>

                    <h2 id="future-implications">Future Implications & Next Steps</h2>

                    <p>
                        The victory at the Northern Region Science Competition has several implications for Okwang Secondary School and its students:
                    </p>

                    <ul>
                        <li><strong>National Competition Qualification:</strong> The gold medalists have qualified to represent the Northern Region at the National Science Competition in Kampala in August 2024.</li>
                        <li><strong>University Scholarships:</strong> Several universities have expressed interest in offering scholarships to the winning students.</li>
                        <li><strong>School Recognition:</strong> The achievement has raised the school's profile and may attract more resources and partnerships.</li>
                        <li><strong>Inspiration for Younger Students:</strong> The success story has inspired junior students to take greater interest in science subjects.</li>
                    </ul>

                    <p>
                        The school administration has announced plans to establish a Science and Innovation Club to nurture more talented students and prepare them for future competitions. Additionally, there are discussions about partnering with local universities for mentorship programs and equipment sharing.
                    </p>

                    <div class="my-8 p-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200">
                        <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-graduation-cap mr-3 text-green-600"></i> What's Next for the Winners?
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-green-500 mt-1 mr-3"></i>
                                <span>Prepare for National Science Competition in Kampala (August 2024)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-green-500 mt-1 mr-3"></i>
                                <span>Refine projects based on judges' feedback</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-green-500 mt-1 mr-3"></i>
                                <span>Explore patent opportunities for innovations</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-green-500 mt-1 mr-3"></i>
                                <span>Mentor junior students in the new Science Club</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Conclusion -->
                    <div class="my-8 p-6 bg-gradient-to-r from-maroon to-red-800 text-white rounded-xl">
                        <h3 class="font-bold text-xl mb-4 flex items-center">
                            <i class="fas fa-trophy mr-3"></i> Conclusion
                        </h3>
                        <p>
                            The remarkable achievement of Okwang Secondary School students at the Northern Region Science Competition 2024 demonstrates the potential that exists in rural schools when given proper resources, guidance, and opportunities. Their innovative projects addressing real-world problems show that these students are not just learning science but applying it to create positive change in their communities.
                        </p>
                        <p class="mt-4">
                            As the winners prepare for the national competition, the entire school community stands behind them, proud of their accomplishments and excited for their future contributions to science and society.
                        </p>
                    </div>

                    <!-- Article Footer -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center space-x-4">
                                <span class="text-gray-600">
                                    <i class="far fa-eye mr-2"></i> 1,245 views
                                </span>
                                <span class="text-gray-600">
                                    <i class="far fa-comment mr-2"></i> 23 comments
                                </span>
                            </div>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2">
                                <a href="#" class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm hover:bg-gray-200 transition-colors">
                                    #ScienceCompetition
                                </a>
                                <a href="#" class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm hover:bg-gray-200 transition-colors">
                                    #StudentAchievement
                                </a>
                                <a href="#" class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm hover:bg-gray-200 transition-colors">
                                    #STEMEducation
                                </a>
                                <a href="#" class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm hover:bg-gray-200 transition-colors">
                                    #OkwangSuccess
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Author Bio -->
                <div class="mt-8 bg-white rounded-xl shadow-lg p-6 author-card animate-slide-up">
                    <div class="flex items-start">
                        <div class="h-20 w-20 rounded-full bg-gray-300 flex items-center justify-center mr-6">
                            <i class="fas fa-user text-3xl text-gray-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg mb-2">About the Author</h3>
                            <p class="text-gray-700 mb-4">
                                <strong>John Opio</strong> is the School Correspondent for Okwang Secondary School. With over 5 years of experience in educational journalism, he covers school events, achievements, and student stories. John is passionate about highlighting the successes of rural schools and their contributions to Ugandan education.
                            </p>
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-600 hover:text-maroon">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="text-gray-600 hover:text-maroon">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="text-gray-600 hover:text-maroon">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="mt-8 bg-white rounded-xl shadow-lg p-6 animate-slide-up">
                    <h3 class="font-bold text-gray-900 text-xl mb-6 flex items-center">
                        <i class="fas fa-comments mr-3 text-maroon"></i> Comments (23)
                    </h3>

                    <!-- Comment Form -->
                    <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                        <h4 class="font-bold text-gray-900 mb-4">Leave a Comment</h4>
                        <form>
                            <div class="space-y-4">
                                <div>
                                    <textarea rows="4" placeholder="Share your thoughts..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent"></textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" placeholder="Your Name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                                    <input type="email" placeholder="Your Email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
                                </div>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="notify" class="mr-2">
                                        <label for="notify" class="text-gray-600 text-sm">Notify me of new comments</label>
                                    </div>
                                    <button type="submit" class="bg-maroon text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300">
                                        Post Comment
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Comments List -->
                    <div class="space-y-6">
                        <!-- Comment 1 -->
                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex items-start mb-4">
                                <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center mr-4">
                                    <i class="fas fa-user text-gray-600"></i>
                                </div>
                                <div>
                                    <h5 class="font-bold text-gray-900">Dr. Sarah Adong</h5>
                                    <div class="flex items-center text-gray-500 text-sm">
                                        <span>May 16, 2024</span>
                                        <span class="mx-2">•</span>
                                        <span>Alumni (Class of 2005)</span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-700">
                                As an alumna and medical doctor, I'm incredibly proud of these students! Their innovations show that Okwang continues to produce problem-solvers. The water purification project could truly transform rural healthcare. Well done!
                            </p>
                            <div class="mt-4 flex items-center space-x-4">
                                <button class="text-gray-500 hover:text-maroon text-sm">
                                    <i class="fas fa-reply mr-1"></i> Reply
                                </button>
                                <button class="text-gray-500 hover:text-maroon text-sm">
                                    <i class="far fa-thumbs-up mr-1"></i> 12
                                </button>
                            </div>
                        </div>

                        <!-- Comment 2 -->
                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex items-start mb-4">
                                <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center mr-4">
                                    <i class="fas fa-user text-gray-600"></i>
                                </div>
                                <div>
                                    <h5 class="font-bold text-gray-900">Parent of S3 Student</h5>
                                    <div class="flex items-center text-gray-500 text-sm">
                                        <span>May 15, 2024</span>
                                        <span class="mx-2">•</span>
                                        <span>Parent</span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-700">
                                This is wonderful news! My daughter is in S3 and has been inspired by this achievement to join the science club. Thank you to the teachers for their dedication. Congratulations to all the winners!
                            </p>
                            <div class="mt-4 flex items-center space-x-4">
                                <button class="text-gray-500 hover:text-maroon text-sm">
                                    <i class="fas fa-reply mr-1"></i> Reply
                                </button>
                                <button class="text-gray-500 hover:text-maroon text-sm">
                                    <i class="far fa-thumbs-up mr-1"></i> 8
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- View More Comments -->
                    <div class="text-center mt-6">
                        <button class="text-maroon font-medium hover:text-red-800">
                            <i class="fas fa-chevron-down mr-2"></i> View More Comments
                        </button>
                    </div>
                </div>
            </article>

            <!-- Sidebar (1/3 width) -->
            <aside class="lg:col-span-1">
                <!-- Article Tools -->
                <div class="sticky top-24 space-y-6">
                    <!-- Print & Save -->
                    <div class="bg-white rounded-xl shadow-lg p-6 animate-slide-up">
                        <h3 class="font-bold text-gray-900 text-lg mb-4 flex items-center">
                            <i class="fas fa-tools mr-3 text-maroon"></i> Article Tools
                        </h3>
                        <div class="space-y-3">
                            <button id="print-article" class="w-full flex items-center justify-center bg-gray-100 text-gray-800 px-4 py-3 rounded-lg hover:bg-gray-200 transition-colors">
                                <i class="fas fa-print mr-3"></i> Print Article
                            </button>
                            <button id="save-article" class="w-full flex items-center justify-center bg-gray-100 text-gray-800 px-4 py-3 rounded-lg hover:bg-gray-200 transition-colors">
                                <i class="far fa-bookmark mr-3"></i> Save for Later
                            </button>
                            <button id="text-size" class="w-full flex items-center justify-center bg-gray-100 text-gray-800 px-4 py-3 rounded-lg hover:bg-gray-200 transition-colors">
                                <i class="fas fa-text-height mr-3"></i> Adjust Text Size
                            </button>
                        </div>
                    </div>

                    <!-- Related Articles -->
                    <div class="bg-white rounded-xl shadow-lg p-6 animate-slide-up">
                        <h3 class="font-bold text-gray-900 text-lg mb-6 flex items-center">
                            <i class="fas fa-newspaper mr-3 text-school-blue"></i> Related Articles
                        </h3>
                        <div class="space-y-6">
                            <!-- Related Article 1 -->
                            <a href="#" class="related-article block">
                                <div class="flex items-start">
                                    <div class="h-20 w-20 rounded-lg bg-gradient-to-br from-green-600 to-green-800 flex-shrink-0 mr-4 flex items-center justify-center">
                                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-sm mb-1">Class of 2023 Graduation Ceremony</h4>
                                        <p class="text-gray-600 text-xs mb-2">Celebrating 98% university acceptance rate</p>
                                        <div class="text-gray-500 text-xs">
                                            <i class="far fa-calendar-alt mr-1"></i> April 28, 2024
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <!-- Related Article 2 -->
                            <a href="#" class="related-article block">
                                <div class="flex items-start">
                                    <div class="h-20 w-20 rounded-lg bg-gradient-to-br from-purple-600 to-purple-800 flex-shrink-0 mr-4 flex items-center justify-center">
                                        <i class="fas fa-laptop-code text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-sm mb-1">New Computer Lab Opening</h4>
                                        <p class="text-gray-600 text-xs mb-2">State-of-the-art ICT facilities launched</p>
                                        <div class="text-gray-500 text-xs">
                                            <i class="far fa-calendar-alt mr-1"></i> May 5, 2024
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <!-- Related Article 3 -->
                            <a href="#" class="related-article block">
                                <div class="flex items-start">
                                    <div class="h-20 w-20 rounded-lg bg-gradient-to-br from-yellow-600 to-yellow-800 flex-shrink-0 mr-4 flex items-center justify-center">
                                        <i class="fas fa-futbol text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-sm mb-1">Sports Day Champions</h4>
                                        <p class="text-gray-600 text-xs mb-2">Red House wins inter-house competition</p>
                                        <div class="text-gray-500 text-xs">
                                            <i class="far fa-calendar-alt mr-1"></i> May 8, 2024
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="bg-gradient-to-r from-maroon to-red-800 text-white rounded-xl shadow-lg p-6 animate-slide-up">
                        <h3 class="font-bold text-xl mb-4">Stay Updated</h3>
                        <p class="text-gray-200 mb-6">
                            Subscribe to our newsletter to get the latest news and updates from Okwang Secondary School.
                        </p>
                        <form>
                            <div class="space-y-4">
                                <input type="email" placeholder="Your email address" class="w-full px-4 py-3 rounded-lg text-gray-900 focus:outline-none">
                                <button type="submit" class="w-full bg-white text-maroon px-6 py-3 rounded-lg font-bold hover:bg-gray-100 transition-all duration-300">
                                    Subscribe Now
                                </button>
                            </div>
                        </form>
                        <p class="text-gray-200 text-xs mt-4">
                            We respect your privacy. Unsubscribe at any time.
                        </p>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="bg-white rounded-xl shadow-lg p-6 animate-slide-up">
                        <h3 class="font-bold text-gray-900 text-lg mb-6 flex items-center">
                            <i class="far fa-calendar-alt mr-3 text-green-600"></i> Upcoming Events
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="bg-maroon text-white px-3 py-1 rounded text-center mr-4 flex-shrink-0">
                                    <div class="text-sm font-bold">JUN</div>
                                    <div class="text-lg font-bold">15</div>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm mb-1">Parent-Teacher Conference</h4>
                                    <p class="text-gray-600 text-xs">Discuss student progress and school development</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="bg-school-blue text-white px-3 py-1 rounded text-center mr-4 flex-shrink-0">
                                    <div class="text-sm font-bold">JUL</div>
                                    <div class="text-lg font-bold">20</div>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm mb-1">Annual Cultural Day</h4>
                                    <p class="text-gray-600 text-xs">Traditional performances and exhibitions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </main>

    <!-- Image Modal -->
    <div id="image-modal" class="image-modal no-print">
        <button class="image-modal-close">
            <i class="fas fa-times"></i>
        </button>
        <img id="modal-image" src="" alt="">
    </div>

@endsection
    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        document.getElementById('menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Reading Progress Bar
        function updateReadingProgress() {
            const article = document.querySelector('article');
            const articleContent = document.querySelector('.article-content');
            const progressBar = document.getElementById('reading-progress-bar');

            if (!article || !progressBar) return;

            const articleTop = article.offsetTop;
            const articleHeight = articleContent.offsetHeight;
            const windowHeight = window.innerHeight;
            const scrollTop = window.scrollY;

            if (scrollTop >= articleTop) {
                const progress = ((scrollTop - articleTop) / articleHeight) * 100;
                progressBar.style.width = Math.min(progress, 100) + '%';
            } else {
                progressBar.style.width = '0%';
            }
        }

        window.addEventListener('scroll', updateReadingProgress);
        window.addEventListener('resize', updateReadingProgress);

        // Initialize progress bar
        updateReadingProgress();

        // Table of Contents Smooth Scrolling
        document.querySelectorAll('.toc a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Article Tools
        document.getElementById('print-article').addEventListener('click', function() {
            window.print();
        });

        document.getElementById('save-article').addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-check mr-3"></i> Article Saved';
            this.disabled = true;
            this.classList.add('bg-green-100', 'text-green-800');

            // Show notification
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg animate-slide-up z-50';
            notification.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Article saved to your reading list';
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        });

        let fontSize = 1;
        document.getElementById('text-size').addEventListener('click', function() {
            const articleContent = document.querySelector('.article-content');
            fontSize += 0.1;

            if (fontSize > 1.5) {
                fontSize = 1;
            }

            articleContent.style.fontSize = `${fontSize}rem`;

            // Update button text
            const sizes = ['Small', 'Medium', 'Large'];
            const sizeIndex = fontSize === 1 ? 0 : fontSize === 1.2 ? 1 : 2;
            this.innerHTML = `<i class="fas fa-text-height mr-3"></i> Text Size: ${sizes[sizeIndex]}`;
        });

        // Image Modal
        const imageModal = document.getElementById('image-modal');
        const modalImage = document.getElementById('modal-image');
        const modalClose = document.querySelector('.image-modal-close');
        const articleImages = document.querySelectorAll('.article-image');

        articleImages.forEach(image => {
            image.addEventListener('click', function() {
                // In a real implementation, this would show the actual image
                // For demo, we'll show a placeholder
                modalImage.src = 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                modalImage.alt = 'Science competition project';
                imageModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });
        });

        modalClose.addEventListener('click', function() {
            imageModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });

        imageModal.addEventListener('click', function(e) {
            if (e.target === imageModal) {
                imageModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        // Social Share Buttons
        document.querySelectorAll('.share-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const platform = this.querySelector('i').className;
                let url = window.location.href;
                let text = document.title;

                if (platform.includes('facebook')) {
                    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, '_blank');
                } else if (platform.includes('twitter')) {
                    window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`, '_blank');
                } else if (platform.includes('whatsapp')) {
                    window.open(`https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`, '_blank');
                } else if (platform.includes('link')) {
                    // Copy to clipboard
                    navigator.clipboard.writeText(url).then(() => {
                        const originalHTML = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-check"></i>';

                        setTimeout(() => {
                            this.innerHTML = originalHTML;
                        }, 2000);
                    });
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

        // Newsletter Signup
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const emailInput = this.querySelector('input[type="email"]');

                if (emailInput && emailInput.value) {
                    // In a real implementation, this would submit to a server
                    emailInput.value = '';

                    // Show success message
                    const successMsg = document.createElement('div');
                    successMsg.className = 'mt-4 p-3 bg-green-100 text-green-800 rounded-lg';
                    successMsg.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Thank you for subscribing!';
                    this.appendChild(successMsg);

                    setTimeout(() => {
                        successMsg.remove();
                    }, 5000);
                }
            });
        });

        // Initialize animations on scroll
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
