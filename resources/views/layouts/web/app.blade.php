<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Okwang Secondary School - Otuke District</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'maroon': '#800000',
                        'school-blue': '#1e40af',
                        'school-gray': '#6b7280',
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 1s ease-in-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'slide-in-left': 'slideInLeft 0.5s ease-out',
                        'slide-in-right': 'slideInRight 0.5s ease-out',
                        'bounce-slow': 'bounce 2s infinite',
                        'pulse-slow': 'pulse 3s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        slideInLeft: {
                            '0%': { transform: 'translateX(-20px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        slideInRight: {
                            '0%': { transform: 'translateX(20px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                    }
                }
            }
        }
    </script>
    <style>
                /* Custom Styles */
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom Animations */
        .animate-marquee {
            animation: marquee 20s linear infinite;
        }

        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        .news-card {
            transition: all 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        /* Custom Gradient */
        .gradient-bg {
            background: linear-gradient(135deg, #800000 0%, #a00000 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #800000 0%, #1e40af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body class="font-inter bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50 animate-fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex items-center space-x-3">
                        <div class="h-12 w-12 bg-maroon rounded-full flex items-center justify-center animate-pulse-slow">
                            <img src="{{asset('images/logo.png')}}" alt="OKSS" srcset="" class="w-12 h-12 rounded-full">
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">Okwang Secondary School</h1>
                            <p class="text-sm text-school-gray">Otuke District, Okwang Town Council</p>
                        </div>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-maroon font-semibold hover:text-red-700 transition-colors">Home</a>
                    <a href="/about" class="text-gray-700 hover:text-maroon transition-colors">About Us</a>
                    <a href="/news" class="text-gray-700 hover:text-maroon transition-colors">News</a>
                    <a href="/academics" class="text-gray-700 hover:text-maroon transition-colors">Academics</a>
                    <a href="/career" class="text-gray-700 hover:text-maroon transition-colors">Careers</a>
                    <a href="/admissions" class="text-gray-700 hover:text-maroon transition-colors">Admissions</a>
                    <a href="/gallery" class="text-gray-700 hover:text-maroon transition-colors">Gallery</a>
                    <a href="/applicant/apply" class="bg-maroon text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300 shadow-md hover:shadow-lg">Apply Now</a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="menu-btn" class="text-gray-700">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden bg-white py-4 border-t animate-slide-up">
                <div class="flex flex-col space-y-4">
                    <a href="/" class="text-maroon font-semibold hover:text-red-700 transition-colors">Home</a>
                    <a href="/about" class="text-gray-700 hover:text-maroon transition-colors">About Us</a>
                    <a href="/news" class="text-gray-700 hover:text-maroon transition-colors">News</a>
                    <a href="/academics" class="text-gray-700 hover:text-maroon transition-colors">Academics</a>
                    <a href="/career" class="text-gray-700 hover:text-maroon transition-colors">Careers</a>
                    <a href="/admissions" class="text-gray-700 hover:text-maroon transition-colors">Admissions</a>
                    <a href="/gallery" class="text-gray-700 hover:text-maroon transition-colors">Gallery</a>
                    <a href="/applicant/apply" class="bg-maroon text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300 shadow-md hover:shadow-lg">Apply Now</a>

                </div>
            </div>
        </div>
    </nav>
    {{-- main content --}}
    @yield('content')

        <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-12 pb-8 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- School Info -->
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="h-12 w-12 bg-maroon rounded-full flex items-center justify-center animate-bounce-slow">
                            <img src="{{asset('images/logo.png')}}" alt="OKSS" srcset="" class="w-12 h-12 rounded-full">
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Okwang Secondary School</h3>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm mb-6">
                        Providing quality education in Otuke District since 1995. We are committed to academic excellence and holistic development of our students.
                    </p>
                    <div class="flex items-center">
                        <div class="h-10 w-10 bg-maroon rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-map-pin"></i>
                        </div>
                        <span class="text-gray-300 text-sm">Okwang Town Council, Otuke District</span>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold text-lg mb-6 text-maroon">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="/" class="text-gray-400 hover:text-white transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Home</a></li>
                        <li><a href="/about" class="text-gray-400 hover:text-white transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> About Us</a></li>
                        <li><a href="/team" class="text-gray-400 hover:text-white transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Our Team</a></li>
                        <li><a href="/careers" class="text-gray-400 hover:text-white transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Careers</a></li>
                        <li><a href="/admissions" class="text-gray-400 hover:text-white transition-colors"><i class="fas fa-chevron-right text-xs mr-2"></i> Admissions</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="font-bold text-lg mb-6 text-school-blue">Contact Info</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-gray-400 mt-1 mr-3"></i>
                            <span class="text-gray-400 text-sm">Okwang Town Council, Otuke District, Northern Region, Uganda</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt text-gray-400 mr-3"></i>
                            <span class="text-gray-400 text-sm">+256 772 123 456</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-gray-400 mr-3"></i>
                            <span class="text-gray-400 text-sm">careers@okwangsecondary.ac.ug</span>
                        </li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h4 class="font-bold text-lg mb-6 text-maroon">Connect With Us</h4>
                    <div class="flex space-x-4 mb-6">
                        <a href="#" class="h-10 w-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-maroon transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="h-10 w-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-school-blue transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="h-10 w-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="h-10 w-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>

                    <p class="text-gray-400 text-sm">Subscribe to job alerts</p>
                    <form class="mt-3">
                        <div class="flex">
                            <input type="email" placeholder="Your email" class="flex-grow px-4 py-2 text-gray-900 rounded-l-lg focus:outline-none text-sm">
                            <button type="submit" class="bg-maroon px-4 py-2 rounded-r-lg hover:bg-red-800 transition-colors">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>© 1995-2024 Okwang Secondary School. All rights reserved. | Okwang Town Council, Otuke District, Northern Region, Uganda</p>
                <p class="mt-2">P.O. Box 123, Okwang | Tel: +256 772 123 456 | Email: careers@okwangsecondary.ac.ug</p>
                <p class="mt-2">Equal Opportunity Employer: We are committed to creating a diverse environment and are proud to be an equal opportunity employer.</p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Mobile menu toggle
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
