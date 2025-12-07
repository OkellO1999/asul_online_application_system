@extends('layouts.public')

@section('title', 'ASUL - Welcome to All Saints University Lango')
@section('content')

<!-- Hero Section -->
<section id="home" class="gradient-bg text-white">
    <div class="max-w-7xl mx-auto px-4 py-20 md:py-32">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-block px-4 py-2 bg-white/20 rounded-full mb-6">
                    <span class="text-sm">Since 2010</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                    Transform Your Future at <span class="text-yellow-300">ASUL</span>
                </h1>
                <p class="text-xl mb-8 text-gray-200">
                    All Saints University - Lango offers quality education grounded in Christian values.
                    Join our community of learners and leaders shaping Northern Uganda's future.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-primary font-bold rounded-lg hover:bg-gray-100 text-center transition">
                        Start Your Application <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    <a href="#programs" class="px-8 py-4 border-2 border-white text-white font-bold rounded-lg hover:bg-white/10 text-center transition">
                        Explore Programs
                    </a>
                </div>
                <div class="mt-12 grid grid-cols-3 gap-6">
                    <div>
                        <h3 class="text-3xl font-bold">2,500+</h3>
                        <p class="text-gray-300">Students</p>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold">50+</h3>
                        <p class="text-gray-300">Faculty Members</p>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold">15+</h3>
                        <p class="text-gray-300">Programs</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="relative z-10">
                    <img src="{{ asset('images/asul-hero.jpg') }}"
                         alt="ASUL Campus"
                         class="rounded-2xl shadow-2xl w-full object-cover">
                </div>
                <div class="absolute -bottom-6 -left-6 w-64 h-64 bg-yellow-400 rounded-full opacity-20 animate-float"></div>
                <div class="absolute -top-6 -right-6 w-48 h-48 bg-purple-400 rounded-full opacity-20 animate-float" style="animation-delay: 2s;"></div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">About ASUL</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Founded under the auspices of the Church of Uganda, ASUL is committed to providing holistic education
                that develops competent professionals with strong Christian values.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl card-shadow hover-grow">
                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-cross text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-primary mb-4">Christian Foundation</h3>
                <p class="text-gray-600">
                    Our education is rooted in Christian principles, fostering moral integrity and ethical leadership.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl card-shadow hover-grow">
                <div class="w-16 h-16 bg-secondary rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-graduation-cap text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-primary mb-4">Academic Excellence</h3>
                <p class="text-gray-600">
                    We maintain high academic standards with qualified faculty and modern learning facilities.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl card-shadow hover-grow">
                <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-hands-helping text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-primary mb-4">Community Impact</h3>
                <p class="text-gray-600">
                    We're committed to serving our community through outreach programs and development initiatives.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section id="programs" class="py-20">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Our Academic Programs</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Choose from our diverse range of undergraduate and postgraduate programs designed to meet market demands.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $programs = [
                    ['icon' => 'fa-user-md', 'title' => 'Medicine & Surgery', 'desc' => 'Bachelor of Medicine and Surgery (MBChB)'],
                    ['icon' => 'fa-chalkboard-teacher', 'title' => 'Education', 'desc' => 'Bachelor of Education (BEd)'],
                    ['icon' => 'fa-briefcase', 'title' => 'Business Administration', 'desc' => 'Bachelor of Business Administration (BBA)'],
                    ['icon' => 'fa-cogs', 'title' => 'Engineering', 'desc' => 'Bachelor of Science in Engineering'],
                    ['icon' => 'fa-balance-scale', 'title' => 'Law', 'desc' => 'Bachelor of Laws (LLB)'],
                    ['icon' => 'fa-laptop-code', 'title' => 'Computer Science', 'desc' => 'Bachelor of Computer Science'],
                ];
            @endphp

            @foreach($programs as $program)
            <div class="bg-white border border-gray-200 rounded-2xl p-8 hover-grow hover:shadow-xl transition">
                <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-6">
                    <i class="fas {{ $program['icon'] }} text-primary text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $program['title'] }}</h3>
                <p class="text-gray-600 mb-6">{{ $program['desc'] }}</p>
                <a href="{{ route('register') }}" class="text-primary font-semibold hover:text-green-700">
                    Apply Now <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="#admissions" class="px-8 py-3 bg-primary text-white rounded-lg hover:bg-green-700 font-semibold">
                View All Programs
            </a>
        </div>
    </div>
</section>

<!-- Admissions Process -->
<section id="admissions" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Admission Process</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Follow these simple steps to join the ASUL community
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="relative">
                    <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-white text-2xl font-bold">1</span>
                    </div>
                    <div class="absolute top-10 left-1/2 w-full h-1 bg-gray-300 hidden md:block"></div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Create Account</h3>
                <p class="text-gray-600">Register on our online portal</p>
            </div>

            <div class="text-center">
                <div class="relative">
                    <div class="w-20 h-20 bg-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-white text-2xl font-bold">2</span>
                    </div>
                    <div class="absolute top-10 left-1/2 w-full h-1 bg-gray-300 hidden md:block"></div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Fill Application</h3>
                <p class="text-gray-600">Complete the online application form</p>
            </div>

            <div class="text-center">
                <div class="relative">
                    <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-white text-2xl font-bold">3</span>
                    </div>
                    <div class="absolute top-10 left-1/2 w-full h-1 bg-gray-300 hidden md:block"></div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Upload Documents</h3>
                <p class="text-gray-600">Submit required academic documents</p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-white text-2xl font-bold">4</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Pay & Submit</h3>
                <p class="text-gray-600">Pay application fee and submit</p>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('register') }}" class="px-8 py-4 bg-primary text-white rounded-lg hover:bg-green-700 font-bold text-lg">
                Start Application Process
            </a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">What Our Students Say</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Hear from our students about their experience at ASUL
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-50 p-8 rounded-2xl">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center">
                        <span class="text-white font-bold">JO</span>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-gray-900">James Okello</h4>
                        <p class="text-gray-600 text-sm">Medicine, Year 3</p>
                    </div>
                </div>
                <p class="text-gray-700 italic">
                    "The practical training at ASUL has prepared me well for my medical career. The faculty are supportive and experienced."
                </p>
                <div class="flex text-yellow-400 mt-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>

            <div class="bg-gray-50 p-8 rounded-2xl">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-full bg-secondary flex items-center justify-center">
                        <span class="text-white font-bold">SA</span>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-gray-900">Sarah Amuge</h4>
                        <p class="text-gray-600 text-sm">Education, Year 2</p>
                    </div>
                </div>
                <p class="text-gray-700 italic">
                    "ASUL's Christian foundation has helped me grow both academically and spiritually. The community is like family."
                </p>
                <div class="flex text-yellow-400 mt-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="bg-gray-50 p-8 rounded-2xl">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center">
                        <span class="text-white font-bold">DA</span>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-gray-900">David Acaye</h4>
                        <p class="text-gray-600 text-sm">Business, Alumni</p>
                    </div>
                </div>
                <p class="text-gray-700 italic">
                    "The business program gave me practical skills I use every day in my job. The career support was exceptional."
                </p>
                <div class="flex text-yellow-400 mt-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="gradient-bg text-white py-20">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Transform Your Future?</h2>
        <p class="text-xl mb-10 text-gray-200">
            Join thousands of students who have chosen ASUL for quality education and personal growth.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-6">
            <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-primary font-bold rounded-lg hover:bg-gray-100 transition">
                Apply Now <i class="fas fa-paper-plane ml-2"></i>
            </a>
            <a href="{{ route('login') }}" class="px-8 py-4 border-2 border-white text-white font-bold rounded-lg hover:bg-white/10 transition">
                Portal Login
            </a>
        </div>
        <p class="mt-8 text-gray-300">
            Need help? Contact admissions: <span class="font-semibold">admissions@asul.ac.ug</span> or call <span class="font-semibold">+256 392 123 456</span>
        </p>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-primary mb-4">Contact Us</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Get in touch with us for more information about admissions and programs
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Info -->
            <div>
                <h3 class="text-2xl font-bold text-primary mb-8">Get in Touch</h3>

                <div class="space-y-8">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-white text-xl"></i>
                        </div>
                        <div class="ml-6">
                            <h4 class="text-lg font-bold text-gray-900">Our Location</h4>
                            <p class="text-gray-600 mt-1">Lira City, Northern Uganda<br>P.O. Box 456, Lira</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-secondary rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-white text-xl"></i>
                        </div>
                        <div class="ml-6">
                            <h4 class="text-lg font-bold text-gray-900">Phone Number</h4>
                            <p class="text-gray-600 mt-1">+256 392 123 456<br>+256 414 789 012</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-white text-xl"></i>
                        </div>
                        <div class="ml-6">
                            <h4 class="text-lg font-bold text-gray-900">Email Address</h4>
                            <p class="text-gray-600 mt-1">info@asul.ac.ug<br>admissions@asul.ac.ug</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-secondary rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                        <div class="ml-6">
                            <h4 class="text-lg font-bold text-gray-900">Office Hours</h4>
                            <p class="text-gray-600 mt-1">Monday - Friday: 8:00 AM - 5:00 PM<br>Saturday: 9:00 AM - 1:00 PM</p>
                        </div>
                    </div>
                </div>

                <div class="mt-12">
                    <h4 class="text-lg font-bold text-gray-900 mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-primary rounded-full flex items-center justify-center hover:bg-green-700">
                            <i class="fab fa-facebook-f text-white"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center hover:bg-purple-700">
                            <i class="fab fa-twitter text-white"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-primary rounded-full flex items-center justify-center hover:bg-green-700">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center hover:bg-purple-700">
                            <i class="fab fa-linkedin-in text-white"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-gray-50 p-8 rounded-2xl">
                <h3 class="text-2xl font-bold text-primary mb-6">Send Us a Message</h3>
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2">First Name</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Last Name</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-gray-700 mb-2">Email Address</label>
                        <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary">
                    </div>

                    <div class="mt-6">
                        <label class="block text-gray-700 mb-2">Subject</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary">
                            <option value="">Select Subject</option>
                            <option value="admissions">Admissions Inquiry</option>
                            <option value="programs">Program Information</option>
                            <option value="fees">Fees and Payments</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mt-6">
                        <label class="block text-gray-700 mb-2">Message</label>
                        <textarea rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary"></textarea>
                    </div>

                    <button type="submit" class="mt-8 w-full bg-primary text-white py-4 rounded-lg font-bold hover:bg-green-700 transition">
                        Send Message <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
