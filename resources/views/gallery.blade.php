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

        /* Gallery Item Styles */
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .gallery-item img {
            transition: transform 0.5s ease;
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 20px;
            color: white;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        /* Lightbox Modal */
        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
        }

        .lightbox-content {
            max-width: 90%;
            max-height: 90%;
            position: relative;
        }

        .lightbox-image {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 8px;
        }

        .lightbox-caption {
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 1.1rem;
        }

        .lightbox-close, .lightbox-prev, .lightbox-next {
            position: absolute;
            color: white;
            background: rgba(0, 0, 0, 0.5);
            border: none;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 50%;
            font-size: 1.5rem;
            transition: background 0.3s ease;
        }

        .lightbox-close:hover, .lightbox-prev:hover, .lightbox-next:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        .lightbox-close {
            top: 20px;
            right: 20px;
        }

        .lightbox-prev {
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        .lightbox-next {
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Video Gallery */
        .video-thumbnail {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            cursor: pointer;
        }

        .video-thumbnail:hover .play-button {
            transform: scale(1.1);
        }

        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(128, 0, 0, 0.8);
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease;
        }

        .play-button i {
            color: white;
            font-size: 2rem;
            margin-left: 5px;
        }

        /* Filter Buttons */
        .filter-btn {
            transition: all 0.3s ease;
        }

        .filter-btn.active {
            background-color: #800000;
            color: white;
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 50px;
            height: 50px;
            border: 3px solid rgba(128, 0, 0, 0.3);
            border-radius: 50%;
            border-top-color: #800000;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .gallery-item img {
                height: 200px;
            }

            .lightbox-prev, .lightbox-next {
                padding: 8px 12px;
                font-size: 1.2rem;
            }
        }

        /* Masonry-like grid */
        .masonry-grid {
            column-count: 3;
            column-gap: 1rem;
        }

        .masonry-item {
            break-inside: avoid;
            margin-bottom: 1rem;
        }

        @media (max-width: 1024px) {
            .masonry-grid {
                column-count: 2;
            }
        }

        @media (max-width: 640px) {
            .masonry-grid {
                column-count: 1;
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
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">School Gallery</h1>
                <p class="text-xl max-w-3xl mx-auto text-gray-100">A visual journey through life at Okwang Secondary School</p>

                <!-- Breadcrumb -->
                <div class="flex justify-center items-center mt-8 space-x-2 text-sm">
                    <a href="/" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                    <span class="text-gray-300">/</span>
                    <span class="text-white font-medium">Gallery</span>
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

    <!-- Gallery Filters -->
    <section class="py-8 bg-white border-b border-gray-200 sticky top-20 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-3">
                <button class="filter-btn active px-5 py-2 rounded-full bg-maroon text-white font-medium" data-filter="all">
                    <i class="fas fa-th-large mr-2"></i> All
                </button>
                <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-800 font-medium hover:bg-gray-200" data-filter="campus">
                    <i class="fas fa-school mr-2"></i> Campus
                </button>
                <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-800 font-medium hover:bg-gray-200" data-filter="academic">
                    <i class="fas fa-graduation-cap mr-2"></i> Academics
                </button>
                <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-800 font-medium hover:bg-gray-200" data-filter="sports">
                    <i class="fas fa-futbol mr-2"></i> Sports
                </button>
                <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-800 font-medium hover:bg-gray-200" data-filter="events">
                    <i class="fas fa-calendar-alt mr-2"></i> Events
                </button>
                <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-800 font-medium hover:bg-gray-200" data-filter="facilities">
                    <i class="fas fa-flask mr-2"></i> Facilities
                </button>
                <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-800 font-medium hover:bg-gray-200" data-filter="students">
                    <i class="fas fa-users mr-2"></i> Student Life
                </button>
            </div>
        </div>
    </section>

    <!-- Photo Gallery -->
    <section id="photos" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Photo Gallery</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Explore our school through photographs capturing daily life, special events, and our beautiful campus</p>
            </div>

            <!-- Gallery Grid -->
            <div class="masonry-grid animate-fade-in">
                <!-- Campus Images -->
                <div class="masonry-item gallery-item" data-category="campus">
                    <img src="https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="School Main Building" class="w-full">
                    <div class="gallery-overlay">
                        <div class="text-sm bg-maroon inline-block px-3 py-1 rounded-full mb-2">Campus</div>
                        <h3 class="font-bold text-lg">Main Administration Building</h3>
                        <p class="text-gray-200 text-sm">The central hub of our school administration</p>
                    </div>
                </div>

                <!-- Academic Images -->
                <div class="masonry-item gallery-item" data-category="academic">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Classroom Learning" class="w-full">
                    <div class="gallery-overlay">
                        <div class="text-sm bg-school-blue inline-block px-3 py-1 rounded-full mb-2">Academics</div>
                        <h3 class="font-bold text-lg">Interactive Classroom Session</h3>
                        <p class="text-gray-200 text-sm">Students engaged in a lively discussion</p>
                    </div>
                </div>

                <!-- Sports Images -->
                <div class="masonry-item gallery-item" data-category="sports">
                    <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="School Sports" class="w-full">
                    <div class="gallery-overlay">
                        <div class="text-sm bg-green-600 inline-block px-3 py-1 rounded-full mb-2">Sports</div>
                        <h3 class="font-bold text-lg">Annual Sports Day</h3>
                        <p class="text-gray-200 text-sm">Students competing in track events</p>
                    </div>
                </div>

                <!-- Facilities Images -->
                <div class="masonry-item gallery-item" data-category="facilities">
                    <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w-800&q=80" alt="Science Laboratory" class="w-full">
                    <div class="gallery-overlay">
                        <div class="text-sm bg-purple-600 inline-block px-3 py-1 rounded-full mb-2">Facilities</div>
                        <h3 class="font-bold text-lg">Modern Science Laboratory</h3>
                        <p class="text-gray-200 text-sm">Fully equipped for practical experiments</p>
                    </div>
                </div>

                <!-- Events Images -->
                <div class="masonry-item gallery-item" data-category="events">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="School Event" class="w-full">
                    <div class="gallery-overlay">
                        <div class="text-sm bg-yellow-600 inline-block px-3 py-1 rounded-full mb-2">Events</div>
                        <h3 class="font-bold text-lg">Cultural Day Celebration</h3>
                        <p class="text-gray-200 text-sm">Traditional dance performance</p>
                    </div>
                </div>

                <!-- Student Life Images -->
                <div class="masonry-item gallery-item" data-category="students">
                    <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Student Discussion" class="w-full">
                    <div class="gallery-overlay">
                        <div class="text-sm bg-pink-600 inline-block px-3 py-1 rounded-full mb-2">Student Life</div>
                        <h3 class="font-bold text-lg">Group Study Session</h3>
                        <p class="text-gray-200 text-sm">Collaborative learning in the library</p>
                    </div>
                </div>

                <!-- Campus Images -->
                <div class="masonry-item gallery-item" data-category="campus">
                    <img src="https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="School Grounds" class="w-full">
                    <div class="gallery-overlay">
                        <div class="text-sm bg-maroon inline-block px-3 py-1 rounded-full mb-2">Campus</div>
                        <h3 class="font-bold text-lg">Beautiful School Grounds</h3>
                        <p class="text-gray-200 text-sm">Lush green environment for learning</p>
                    </div>
                </div>

                <!-- Academic Images -->
                <div class="masonry-item gallery-item" data-category="academic">
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Computer Lab" class="w-full">
                    <div class="gallery-overlay">
                        <div class="text-sm bg-school-blue inline-block px-3 py-1 rounded-full mb-2">Academics</div>
                        <h3 class="font-bold text-lg">Computer Laboratory</h3>
                        <p class="text-gray-200 text-sm">Digital skills training in progress</p>
                    </div>
                </div>

                <!-- Sports Images -->
                <div class="masonry-item gallery-item" data-category="sports">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Basketball Game" class="w-full">
                    <div class="gallery-overlay">
                        <div class="text-sm bg-green-600 inline-block px-3 py-1 rounded-full mb-2">Sports</div>
                        <h3 class="font-bold text-lg">Inter-house Basketball</h3>
                        <p class="text-gray-200 text-sm">Competitive basketball match</p>
                    </div>
                </div>

                <!-- Events Images -->
                <div class="masonry-item gallery-item" data-category="events">
                    <img src="https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Graduation Ceremony" class="w-full">
                    <div class="gallery-overlay">
                        <div class="text-sm bg-yellow-600 inline-block px-3 py-1 rounded-full mb-2">Events</div>
                        <h3 class="font-bold text-lg">Graduation Ceremony</h3>
                        <p class="text-gray-200 text-sm">Celebrating student achievements</p>
                    </div>
                </div>

                <!-- Facilities Images -->
                <div class="masonry-item gallery-item" data-category="facilities">
                    <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="School Library" class="w-full">
                    <div class="gallery-overlay">
                        <div class="text-sm bg-purple-600 inline-block px-3 py-1 rounded-full mb-2">Facilities</div>
                        <h3 class="font-bold text-lg">School Library</h3>
                        <p class="text-gray-200 text-sm">Quiet study space with extensive resources</p>
                    </div>
                </div>

                <!-- Student Life Images -->
                <div class="masonry-item gallery-item" data-category="students">
                    <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Art Class" class="w-full">
                    <div class="gallery-overlay">
                        <div class="text-sm bg-pink-600 inline-block px-3 py-1 rounded-full mb-2">Student Life</div>
                        <h3 class="font-bold text-lg">Art and Creativity Class</h3>
                        <p class="text-gray-200 text-sm">Students expressing creativity</p>
                    </div>
                </div>

                <!-- Campus Images -->
                <div class="masonry-item gallery-item" data-category="campus">
                    <img src="https://images.unsplash.com/photo-1591123120675-6f7f1aae0e5b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="School Dormitories" class="w-full">
                    <div class="gallery-overlay">
                        <div class="text-sm bg-maroon inline-block px-3 py-1 rounded-full mb-2">Campus</div>
                        <h3 class="font-bold text-lg">Student Dormitories</h3>
                        <p class="text-gray-200 text-sm">Comfortable boarding facilities</p>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12" id="load-more-container">
                <button id="load-more" class="bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 transition-all duration-300">
                    <i class="fas fa-plus-circle mr-2"></i> Load More Photos
                </button>
                <div id="loading-indicator" class="hidden mt-4">
                    <div class="loading mx-auto"></div>
                    <p class="text-gray-600 mt-2">Loading more images...</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Gallery -->
    <section id="videos" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Video Gallery</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Watch our school come to life through videos of events, activities, and campus life</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Video 1 -->
                <div class="animate-slide-up">
                    <div class="video-thumbnail bg-gray-800 rounded-xl overflow-hidden h-64">
                        <div class="h-full w-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center">
                            <div class="play-button">
                                <i class="fas fa-play"></i>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                <div class="text-sm bg-maroon inline-block px-3 py-1 rounded-full mb-2">Campus Tour</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="font-bold text-gray-900 text-lg mb-2">Virtual Campus Tour 2024</h3>
                        <p class="text-gray-600 text-sm">Take a guided tour of our beautiful campus and facilities</p>
                        <div class="flex items-center mt-3 text-gray-500 text-sm">
                            <i class="far fa-clock mr-2"></i> 8:45 min • <i class="far fa-eye ml-4 mr-2"></i> 1,245 views
                        </div>
                    </div>
                </div>

                <!-- Video 2 -->
                <div class="animate-slide-up">
                    <div class="video-thumbnail bg-gray-800 rounded-xl overflow-hidden h-64">
                        <div class="h-full w-full bg-gradient-to-br from-school-blue to-blue-900 flex items-center justify-center">
                            <div class="play-button">
                                <i class="fas fa-play"></i>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                <div class="text-sm bg-school-blue inline-block px-3 py-1 rounded-full mb-2">Academic</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="font-bold text-gray-900 text-lg mb-2">Science Fair Highlights 2024</h3>
                        <p class="text-gray-600 text-sm">Students showcase innovative science projects and experiments</p>
                        <div class="flex items-center mt-3 text-gray-500 text-sm">
                            <i class="far fa-clock mr-2"></i> 12:30 min • <i class="far fa-eye ml-4 mr-2"></i> 892 views
                        </div>
                    </div>
                </div>

                <!-- Video 3 -->
                <div class="animate-slide-up">
                    <div class="video-thumbnail bg-gray-800 rounded-xl overflow-hidden h-64">
                        <div class="h-full w-full bg-gradient-to-br from-green-700 to-green-900 flex items-center justify-center">
                            <div class="play-button">
                                <i class="fas fa-play"></i>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                <div class="text-sm bg-green-600 inline-block px-3 py-1 rounded-full mb-2">Sports</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="font-bold text-gray-900 text-lg mb-2">Annual Sports Day 2023</h3>
                        <p class="text-gray-600 text-sm">Highlights from our inter-house sports competition</p>
                        <div class="flex items-center mt-3 text-gray-500 text-sm">
                            <i class="far fa-clock mr-2"></i> 15:20 min • <i class="far fa-eye ml-4 mr-2"></i> 1,567 views
                        </div>
                    </div>
                </div>

                <!-- Video 4 -->
                <div class="animate-slide-up">
                    <div class="video-thumbnail bg-gray-800 rounded-xl overflow-hidden h-64">
                        <div class="h-full w-full bg-gradient-to-br from-yellow-700 to-yellow-900 flex items-center justify-center">
                            <div class="play-button">
                                <i class="fas fa-play"></i>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                <div class="text-sm bg-yellow-600 inline-block px-3 py-1 rounded-full mb-2">Events</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="font-bold text-gray-900 text-lg mb-2">Cultural Day Celebration</h3>
                        <p class="text-gray-600 text-sm">Traditional performances and cultural exhibitions</p>
                        <div class="flex items-center mt-3 text-gray-500 text-sm">
                            <i class="far fa-clock mr-2"></i> 18:10 min • <i class="far fa-eye ml-4 mr-2"></i> 2,134 views
                        </div>
                    </div>
                </div>

                <!-- Video 5 -->
                <div class="animate-slide-up">
                    <div class="video-thumbnail bg-gray-800 rounded-xl overflow-hidden h-64">
                        <div class="h-full w-full bg-gradient-to-br from-purple-700 to-purple-900 flex items-center justify-center">
                            <div class="play-button">
                                <i class="fas fa-play"></i>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                <div class="text-sm bg-purple-600 inline-block px-3 py-1 rounded-full mb-2">Graduation</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="font-bold text-gray-900 text-lg mb-2">Class of 2023 Graduation</h3>
                        <p class="text-gray-600 text-sm">Celebrating our graduating students' achievements</p>
                        <div class="flex items-center mt-3 text-gray-500 text-sm">
                            <i class="far fa-clock mr-2"></i> 22:45 min • <i class="far fa-eye ml-4 mr-2"></i> 3,421 views
                        </div>
                    </div>
                </div>

                <!-- Video 6 -->
                <div class="animate-slide-up">
                    <div class="video-thumbnail bg-gray-800 rounded-xl overflow-hidden h-64">
                        <div class="h-full w-full bg-gradient-to-br from-pink-700 to-pink-900 flex items-center justify-center">
                            <div class="play-button">
                                <i class="fas fa-play"></i>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                <div class="text-sm bg-pink-600 inline-block px-3 py-1 rounded-full mb-2">Student Life</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="font-bold text-gray-900 text-lg mb-2">A Day in the Life at Okwang</h3>
                        <p class="text-gray-600 text-sm">Follow students through their daily routines and activities</p>
                        <div class="flex items-center mt-3 text-gray-500 text-sm">
                            <i class="far fa-clock mr-2"></i> 10:15 min • <i class="far fa-eye ml-4 mr-2"></i> 1,876 views
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center bg-maroon text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300">
                    <i class="fab fa-youtube mr-2"></i> View More Videos on YouTube
                </a>
            </div>
        </div>
    </section>

    <!-- 360° Virtual Tour -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="animate-slide-in-left">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">360° Virtual Campus Tour</h2>
                    <div class="w-20 h-1 bg-maroon mb-8"></div>

                    <p class="text-gray-600 mb-6">
                        Experience our campus from anywhere in the world with our interactive 360° virtual tour. Explore classrooms, laboratories, sports facilities, and more as if you were here in person.
                    </p>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Interactive 360° views of all key facilities</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Information points with detailed descriptions</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Virtual reality compatible for immersive experience</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Available 24/7 from any device</span>
                        </li>
                    </ul>

                    <a href="#" class="inline-flex items-center bg-school-blue text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-all duration-300">
                        <i class="fas fa-vr-cardboard mr-2"></i> Start Virtual Tour
                    </a>
                </div>

                <!-- Right Content - Virtual Tour Preview -->
                <div class="animate-slide-in-right">
                    <div class="bg-gray-800 rounded-xl overflow-hidden h-96 relative">
                        <div class="h-full w-full bg-gradient-to-br from-gray-900 to-gray-800 flex items-center justify-center">
                            <div class="text-center text-white p-8">
                                <i class="fas fa-360-degrees text-6xl mb-6 text-gray-300"></i>
                                <h3 class="text-2xl font-bold mb-4">Interactive Virtual Tour</h3>
                                <p class="text-gray-300 mb-6">Click the button below to launch the tour</p>
                                <button class="bg-maroon text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-800 transition-all duration-300">
                                    <i class="fas fa-play mr-2"></i> Launch Tour
                                </button>
                            </div>
                        </div>
                        <div class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm">
                            <i class="fas fa-mobile-alt mr-2"></i> Compatible with VR Headsets
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Photo of the Month -->
    <section class="py-16 bg-gradient-to-r from-maroon to-red-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Photo of the Month</h2>
                <div class="w-24 h-1 bg-white mx-auto mb-6"></div>
                <p class="text-gray-200 max-w-2xl mx-auto">Each month we feature an exceptional photograph from our school community</p>
            </div>

            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20 max-w-4xl mx-auto animate-slide-up">
                <div class="grid md:grid-cols-3 gap-8 items-center">
                    <div class="md:col-span-2">
                        <div class="bg-gray-900 rounded-xl overflow-hidden h-80">
                            <div class="h-full w-full bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                                <div class="text-center p-6">
                                    <i class="fas fa-camera text-6xl mb-6 text-gray-300"></i>
                                    <h3 class="text-2xl font-bold">Science Lab Experiment</h3>
                                    <p class="text-gray-300 mt-2">May 2024 Winner</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="bg-yellow-500 text-gray-900 inline-block px-4 py-2 rounded-full text-sm font-bold mb-4">
                            <i class="fas fa-trophy mr-2"></i> WINNER
                        </div>
                        <h3 class="text-2xl font-bold mb-4">"Chemical Reaction"</h3>
                        <p class="text-gray-200 mb-6">
                            Captured by Sarah Adongo (S5 Science) during a chemistry practical lesson. The photo shows the vibrant colors of a chemical reaction experiment.
                        </p>

                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-user mr-3"></i>
                                <span>Photographer: Sarah Adongo</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-3"></i>
                                <span>Date: May 15, 2024</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-camera mr-3"></i>
                                <span>Category: Academic Life</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="#" class="inline-flex items-center bg-white text-maroon px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                                <i class="fas fa-vote-yea mr-2"></i> Vote for Next Month
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <p class="text-gray-200 mb-6">Submit your photos for a chance to be featured next month!</p>
                <a href="#" class="inline-flex items-center bg-white text-maroon px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-all duration-300">
                    <i class="fas fa-upload mr-2"></i> Submit Your Photo
                </a>
            </div>
        </div>
    </section>

    <!-- Gallery Highlights -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Gallery Highlights</h2>
                <div class="w-24 h-1 bg-maroon mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Special collections and featured albums from our archives</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Highlight 1 -->
                <div class="bg-white rounded-xl overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 animate-slide-up">
                    <div class="h-48 bg-gradient-to-br from-maroon to-red-800 relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <h3 class="font-bold text-lg">25th Anniversary</h3>
                            <p class="text-gray-200 text-sm">1995-2020 Celebration</p>
                        </div>
                        <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs">
                            45 Photos
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="far fa-images mr-2"></i> Album • <i class="far fa-calendar-alt ml-4 mr-2"></i> 2020
                        </div>
                    </div>
                </div>

                <!-- Highlight 2 -->
                <div class="bg-white rounded-xl overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 animate-slide-up">
                    <div class="h-48 bg-gradient-to-br from-school-blue to-blue-800 relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <h3 class="font-bold text-lg">Science Fair Winners</h3>
                            <p class="text-gray-200 text-sm">Regional Competition 2023</p>
                        </div>
                        <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs">
                            32 Photos
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="far fa-images mr-2"></i> Album • <i class="far fa-calendar-alt ml-4 mr-2"></i> 2023
                        </div>
                    </div>
                </div>

                <!-- Highlight 3 -->
                <div class="bg-white rounded-xl overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 animate-slide-up">
                    <div class="h-48 bg-gradient-to-br from-green-600 to-green-800 relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <h3 class="font-bold text-lg">Sports Champions</h3>
                            <p class="text-gray-200 text-sm">District Tournament 2024</p>
                        </div>
                        <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs">
                            28 Photos
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="far fa-images mr-2"></i> Album • <i class="far fa-calendar-alt ml-4 mr-2"></i> 2024
                        </div>
                    </div>
                </div>

                <!-- Highlight 4 -->
                <div class="bg-white rounded-xl overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 animate-slide-up">
                    <div class="h-48 bg-gradient-to-br from-purple-600 to-purple-800 relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <h3 class="font-bold text-lg">Graduation Memories</h3>
                            <p class="text-gray-200 text-sm">Class of 2023</p>
                        </div>
                        <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs">
                            67 Photos
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center text-gray-500 text-sm">
                            <i class="far fa-images mr-2"></i> Album • <i class="far fa-calendar-alt ml-4 mr-2"></i> 2023
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-900 transition-all duration-300">
                    <i class="fas fa-archive mr-2"></i> Browse All Albums
                </a>
            </div>
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="lightbox">
        <button class="lightbox-close">
            <i class="fas fa-times"></i>
        </button>
        <button class="lightbox-prev">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="lightbox-next">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="lightbox-content">
            <img id="lightbox-image" class="lightbox-image" src="" alt="">
            <div id="lightbox-caption" class="lightbox-caption"></div>
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

        // Filter Gallery Items
        const filterButtons = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-item');

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

                // Show/hide gallery items based on filter
                galleryItems.forEach(item => {
                    if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                        item.style.display = 'block';
                        // Add animation
                        item.style.animation = 'fadeIn 0.5s ease';
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Reinitialize masonry layout after filtering
                setTimeout(() => {
                    // This would normally trigger a masonry layout recalculation
                    // For simplicity, we're just showing/hiding items
                }, 100);
            });
        });

        // Lightbox functionality
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightbox-image');
        const lightboxCaption = document.getElementById('lightbox-caption');
        const lightboxClose = document.querySelector('.lightbox-close');
        const lightboxPrev = document.querySelector('.lightbox-prev');
        const lightboxNext = document.querySelector('.lightbox-next');

        // Store all gallery images for lightbox navigation
        const galleryImages = Array.from(document.querySelectorAll('.gallery-item img'));
        let currentImageIndex = 0;

        // Open lightbox when gallery image is clicked
        galleryItems.forEach((item, index) => {
            item.addEventListener('click', function() {
                const img = this.querySelector('img');
                const caption = this.querySelector('.gallery-overlay h3').textContent;
                const description = this.querySelector('.gallery-overlay p').textContent;

                currentImageIndex = index;
                lightboxImage.src = img.src;
                lightboxCaption.textContent = caption + ' - ' + description;

                lightbox.style.display = 'flex';
                lightbox.style.animation = 'fadeIn 0.3s ease';
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            });
        });

        // Close lightbox
        lightboxClose.addEventListener('click', function() {
            lightbox.style.display = 'none';
            document.body.style.overflow = 'auto';
        });

        // Close lightbox when clicking outside the image
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) {
                lightbox.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        // Navigate to previous image
        lightboxPrev.addEventListener('click', function(e) {
            e.stopPropagation();
            currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
            updateLightboxImage();
        });

        // Navigate to next image
        lightboxNext.addEventListener('click', function(e) {
            e.stopPropagation();
            currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
            updateLightboxImage();
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (lightbox.style.display === 'flex') {
                if (e.key === 'Escape') {
                    lightbox.style.display = 'none';
                    document.body.style.overflow = 'auto';
                } else if (e.key === 'ArrowLeft') {
                    currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
                    updateLightboxImage();
                } else if (e.key === 'ArrowRight') {
                    currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
                    updateLightboxImage();
                }
            }
        });

        function updateLightboxImage() {
            const img = galleryImages[currentImageIndex];
            const item = img.closest('.gallery-item');
            const caption = item.querySelector('.gallery-overlay h3').textContent;
            const description = item.querySelector('.gallery-overlay p').textContent;

            lightboxImage.style.animation = 'zoomIn 0.3s ease';
            setTimeout(() => {
                lightboxImage.src = img.src;
                lightboxCaption.textContent = caption + ' - ' + description;
            }, 150);
        }

        // Load more images functionality (simulated)
        const loadMoreButton = document.getElementById('load-more');
        const loadingIndicator = document.getElementById('loading-indicator');
        let loadedItems = 12; // Starting with 12 items shown

        loadMoreButton.addEventListener('click', function() {
            loadMoreButton.style.display = 'none';
            loadingIndicator.classList.remove('hidden');

            // Simulate loading delay
            setTimeout(() => {
                // In a real application, this would fetch more images from a server
                // For this demo, we'll just show a message
                loadingIndicator.classList.add('hidden');
                loadMoreButton.textContent = 'All Images Loaded';
                loadMoreButton.disabled = true;
                loadMoreButton.classList.add('opacity-50', 'cursor-not-allowed');

                // Show success message
                const successMsg = document.createElement('div');
                successMsg.className = 'mt-4 p-3 bg-green-100 text-green-800 rounded-lg';
                successMsg.innerHTML = '<i class="fas fa-check-circle mr-2"></i> All images have been loaded.';
                document.getElementById('load-more-container').appendChild(successMsg);
            }, 1500);
        });

        // Video play buttons
        const videoThumbnails = document.querySelectorAll('.video-thumbnail');
        videoThumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                // In a real implementation, this would open a modal with the video
                alert('In a complete implementation, this would open a video player with the selected video.');
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
    </script>
</body>
</html>
