<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'OKSS - Okwang Secondary School')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-green: #800000;
            --secondary-purple: #0f0f44;
            --light-green: #e8f5e9;
            --light-purple: #f3e5f5;
        }
        .bg-primary { background-color: var(--primary-green); }
        .text-primary { color: var(--primary-green); }
        .border-primary { border-color: var(--primary-green); }
        .bg-secondary { background-color: var(--secondary-purple); }
        .text-secondary { color: var(--secondary-purple); }
        .gradient-bg { background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-purple) 100%); }
        .hover-grow { transition: transform 0.3s ease; }
        .hover-grow:hover { transform: translateY(-5px); }
        .stat-card { background: linear-gradient(135deg, rgba(30, 107, 82, 0.1) 0%, rgba(75, 40, 109, 0.1) 100%); }
        .card-shadow { box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="font-sans">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center">
                        <img src="{{asset('images/logo.png')}}" alt="ASUL" srcset="">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-primary">Okwang Secondary School</h1>
                        <p class="text-sm text-gray-600">- Otuke, Northern Uganda</p>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-primary font-medium">Home</a>
                    <a href="#about" class="text-gray-700 hover:text-primary font-medium">About</a>
                    <a href="#programs" class="text-gray-700 hover:text-primary font-medium">Programs</a>
                    <a href="#admissions" class="text-gray-700 hover:text-primary font-medium">Admissions</a>
                    <a href="#contact" class="text-gray-700 hover:text-primary font-medium">Contact</a>
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-primary border border-primary rounded-lg hover:bg-green-700 hover:text-white transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-green-700 transition">
                            Apply Now
                        </a>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden pb-4">
                <div class="flex flex-col space-y-4">
                    <a href="#home" class="text-gray-700 hover:text-primary">Home</a>
                    <a href="#about" class="text-gray-700 hover:text-primary">About</a>
                    <a href="#programs" class="text-gray-700 hover:text-primary">Programs</a>
                    <a href="#admissions" class="text-gray-700 hover:text-primary">Admissions</a>
                    <a href="#contact" class="text-gray-700 hover:text-primary">Contact</a>
                    <div class="flex flex-col space-y-2 pt-4 border-t">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-center text-primary border border-primary rounded-lg">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-center bg-primary text-white rounded-lg">
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- University Info -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
                            <span class="text-white font-bold">OKSS</span>
                        </div>
                        <div>
                            <h3 class="font-bold">Okwang Secondary School</h3>
                            <p class="text-sm text-gray-400">Otuke, Northern Uganda</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Okwang Secondary School is a premier institution of higher learning committed to academic excellence and Christian values.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-primary">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#programs" class="text-gray-400 hover:text-white">Academic Programs</a></li>
                        <li><a href="#admissions" class="text-gray-400 hover:text-white">Admissions</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-primary">Contact Info</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                            <span class="text-gray-400">Lira, Northern Uganda</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-phone text-primary"></i>
                            <span class="text-gray-400">+256 392 123 456</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-primary"></i>
                            <span class="text-gray-400">info@okss.ac.ug</span>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-primary">Stay Updated</h4>
                    <p class="text-gray-400 text-sm mb-4">Subscribe to our newsletter for updates on admissions and events.</p>
                    <div class="flex">
                        <input type="email" placeholder="Your email" class="px-4 py-2 rounded-l-lg w-full text-gray-900">
                        <button class="px-4 py-2 bg-primary rounded-r-lg hover:bg-green-700">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} Okwang Secondary School. All rights reserved.</p>
                <p class="mt-2">Educate For a purpose</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
