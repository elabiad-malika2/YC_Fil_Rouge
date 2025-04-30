<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Platform - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.svg') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .course-card {
            transition: transform 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-8px);
        }

        .category-card {
            transition: all 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .teacher-photo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Top Info Bar -->
    <div class="hidden md:block w-full gradient-bg text-white">
        <div class="container mx-auto px-6 py-2">
            <div class="flex justify-between items-center text-sm">
                <div class="flex items-center space-x-6">
                    <span class="flex items-center">
                        <i class="ri-phone-line mr-2"></i> +212 772508881
                    </span>
                    <span class="flex items-center">
                        <i class="ri-mail-line mr-2"></i> contact@e-learning.com
                    </span>
                </div>
                <span class="flex items-center">
                    <i class="ri-map-pin-line mr-2"></i> Massira N641 Safi, Morocco
                </span>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between py-4">
                <a href="{{ route('courses.show') }}" class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-xl font-bold text-gray-800">E-Learning</span>
                </a>

                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('courses.show') }}" class="text-indigo-600 hover:text-indigo-800 transition-colors font-medium">Home</a>
                    <a href="{{ route('courses.show') }}" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Courses</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Pricing</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Features</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Blog</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Help Center</a>
                </nav>

                <div class="flex items-center space-x-4">
                    @if (Auth::check())
                    <div class="relative">
                        <button class="flex items-center space-x-2 focus:outline-none">
                            <img src="{{ Auth::user()->photo ? Storage::url(Auth::user()->photo) : 'https://cdn-icons-png.flaticon.com/512/219/219969.png' }}" alt="User" class="w-9 h-9 rounded-full border-2 border-indigo-200">
                            <span class="hidden md:block text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                        </button>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Déconnexion</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="hidden md:block px-5 py-2 text-gray-700 hover:text-indigo-600 transition-colors font-medium">Connexion</a>
                    <a href="{{ route('register.form') }}" class="hidden md:block px-5 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors font-medium">Inscription</a>
                    @endif
                    <button id="mobile-menu-btn" class="p-2 rounded-full text-gray-500 hover:bg-gray-100 md:hidden">
                        <i class="ri-menu-line text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="sidebar-menu" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden transition-opacity">
            <div class="fixed top-0 right-0 w-72 bg-white h-full shadow-xl transform transition-transform duration-300">
                <div class="flex justify-between items-center p-5 border-b">
                    <div class="flex items-center space-x-2">
                        <svg class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                            <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-lg font-bold text-gray-800">E-Learning</span>
                    </div>
                    <button id="close-sidebar" class="text-gray-500 hover:text-gray-700">
                        <i class="ri-close-line text-2xl"></i>
                    </button>
                </div>
                <nav class="flex flex-col px-5 py-6">
                    <a href="{{ route('courses.show') }}" class="py-3 px-4 rounded-lg text-indigo-600 bg-indigo-50 font-medium">Home</a>
                    <a href="{{ route('courses.show') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Courses</a>
                    <a href="#" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Pricing</a>
                    <a href="#" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Features</a>
                    <a href="#" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Blog</a>
                    <a href="#" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Help Center</a>

                    <div class="mt-6 space-y-4 px-4">
                        <a href="{{ route('login') }}" class="block w-full py-3 text-center bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition-colors">Connexion</a>
                        <a href="{{ route('register.form') }}" class="block w-full py-3 text-center bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">Inscription</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gray-50">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-full h-64 bg-gradient-to-t from-indigo-50 to-transparent"></div>

        <div class="container mx-auto px-6 py-12 md:py-20 lg:py-24">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="w-full md:w-1/2 z-10">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-800 mb-6">
                        Learn Without <span class="text-indigo-600">Limits</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8">
                        Unlock your potential with our expert-led courses. Anytime, anywhere learning for everyone.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <a href="{{ route('courses.show') }}" class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium text-center">
                            Explore Courses
                        </a>
                        <a href="{{ route('register.form') }}" class="px-8 py-3 bg-white text-indigo-600 border border-indigo-200 rounded-lg hover:bg-indigo-50 transition-colors font-medium text-center">
                            Join for Free
                        </a>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-2">
                            <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="User" class="w-9 h-9 rounded-full border-2 border-white">
                            <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="User" class="w-9 h-9 rounded-full border-2 border-white">
                            <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="User" class="w-9 h-9 rounded-full border-2 border-white">
                            <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="User" class="w-9 h-9 rounded-full border-2 border-white">
                        </div>
                        <div class="text-sm text-gray-600">
                            <span class="font-semibold text-indigo-600">25,000+</span> students already learning
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 z-10">
                    <div class="relative">
                        <div class="absolute -top-5 -right-5 w-32 h-32 bg-indigo-100 rounded-full"></div>
                        <div class="absolute -bottom-5 -left-5 w-24 h-24 bg-purple-100 rounded-full"></div>
                        <div class="glass-card p-4 rounded-2xl shadow-xl">
                            <img src="https://media.istockphoto.com/id/1059510610/fr/vectoriel/r%C3%A9seau-internet-communication-e-learning-it-comme-la-base-de-connaissances.jpg?s=612x612&w=0&k=20&c=ekWQ--S1W9xWxgqH-oH0LKFDuvcz5is-AyxgjIAqmzg=" alt="Learning Platform" class="w-full h-auto rounded-lg">
                            <div class="absolute bottom-6 left-10 right-10 bg-white p-4 rounded-lg shadow-lg">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="font-bold text-gray-800">Web Development</h3>
                                        <p class="text-sm text-gray-500">Master modern web development</p>
                                    </div>
                                    <div class="bg-indigo-100 p-2 rounded-full">
                                        <i class="ri-play-circle-line text-2xl text-indigo-600"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Nos Catégories</h2>
                <p class="text-gray-600">Choisissez votre domaine d'apprentissage</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 max-w-6xl mx-auto">
                @foreach($categories as $category)
                <a href="{{ route('courses.show') }}?category={{ $category->id }}" 
                   class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-indigo-50 transition-colors duration-200">
                    <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center mb-3">
                        <i class="ri-book-line text-xl text-indigo-600"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700 text-center">{{ $category->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Courses -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Popular Courses</h2>
                    <p class="text-lg text-gray-600">
                        Expand your skills with our most in-demand courses
                    </p>
                </div>
                <div class="mt-6 md:mt-0 flex items-center space-x-4">
                    <div class="relative w-full max-w-md">
                        <input type="text" id="search" placeholder="Rechercher par titre ou enseignant..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <i class="ri-search-line absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <a href="{{ route('courses.show') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                        Browse All Courses
                    </a>
                </div>
            </div>

            <div id="courses-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Les cours seront insérés ici par JavaScript -->
            </div>

            <!-- Pagination -->
            <div id="pagination" class="flex justify-center space-x-2 mt-10">
                <!-- Les boutons de pagination seront insérés ici par JavaScript -->
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50 relative overflow-hidden">
        <div class="absolute top-1/3 -right-24 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
        <div class="absolute bottom-1/3 -left-24 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>

        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Why Choose Our Platform</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    We provide a comprehensive learning experience designed to help you achieve your goals
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="feature-card p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="bg-indigo-100 w-14 h-14 rounded-full flex items-center justify-center mb-6">
                        <i class="ri-device-line text-2xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Learn Anywhere</h3>
                    <p class="text-gray-600">
                        Access our platform from any device with our responsive design and dedicated mobile app
                    </p>
                </div>

                <div class="feature-card p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="bg-blue-100 w-14 h-14 rounded-full flex items-center justify-center mb-6">
                        <i class="ri-user-voice-line text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Expert Instructors</h3>
                    <p class="text-gray-600">
                        Learn from industry professionals with real-world experience and proven teaching methods
                    </p>
                </div>

                <div class="feature-card p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="bg-green-100 w-14 h-14 rounded-full flex items-center justify-center mb-6">
                        <i class="ri-group-line text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Community Support</h3>
                    <p class="text-gray-600">
                        Join our active community of learners to share insights, ask questions, and grow together
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                            <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-xl font-bold text-gray-800">E-Learning</span>
                    </div>
                    <p class="text-gray-600 mb-4">Transform your life through education with our online learning platform.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-indigo-600">
                            <i class="ri-facebook-fill text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600">
                            <i class="ri-twitter-fill text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600">
                            <i class="ri-instagram-fill text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600">
                            <i class="ri-linkedin-fill text-xl"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('courses.show') }}" class="text-gray-600 hover:text-indigo-600">Home</a></li>
                        <li><a href="{{ route('courses.show') }}" class="text-gray-600 hover:text-indigo-600">Courses</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Pricing</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Features</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Blog</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Help Center</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">FAQs</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Contact Us</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Terms of Service</a></li>
                    </ul>
                </div>                
            </div>

            <div class="border-t border-gray-200 mt-10 pt-6">
                <p class="text-center text-gray-600 text-sm">
                    © 2025 E-Learning Platform. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const coursesContainer = document.getElementById('courses-container');
            const paginationContainer = document.getElementById('pagination');
            const searchInput = document.getElementById('search');
            let currentPage = 1;
            let searchQuery = '';

            // Fonction pour récupérer les cours
            async function fetchCourses(page = 1, search = '') {
                const url = new URL('{{ route('api.courses.show') }}');
                url.searchParams.append('page', page);
                if (search) {
                    url.searchParams.append('search', search);
                }

                try {
                    coursesContainer.innerHTML = '<div class="col-span-full text-center"><i class="ri-loader-4-line text-2xl text-indigo-600 animate-spin"></i></div>';
                    const response = await fetch(url);
                    const data = await response.json();

                    // Afficher les cours
                    displayCourses(data.courses);

                    // Afficher la pagination
                    displayPagination(data.pagination);
                } catch (error) {
                    console.error('Erreur lors de la récupération des cours:', error);
                    coursesContainer.innerHTML = '<p class="text-red-600 col-span-full text-center">Erreur lors du chargement des cours.</p>';
                }
            }

            // Afficher les cours dans le DOM
            function displayCourses(courses) {
                coursesContainer.innerHTML = '';
                if (courses.length === 0) {
                    coursesContainer.innerHTML = '<p class="text-gray-500 col-span-full text-center">Aucun cours trouvé.</p>';
                    return;
                }
                console.log('qqqqqqq', courses);

                courses.forEach(course => {
                    const courseCard = document.createElement('div');
                    courseCard.className = 'course-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100';
                    courseCard.innerHTML = `
                    <div class="relative">
                        <img src="${course.image_url}" alt="${course.title}" class="w-full h-56 object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="bg-indigo-600 text-white text-xs font-medium px-3 py-1 rounded-full">Popular</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">${course.category.name}</span>
                            <div class="flex items-center">
                                <i class="ri-star-fill text-yellow-400"></i>
                                <span class="text-sm font-medium text-gray-800 ml-1">4.8</span>
                                <span class="text-sm text-gray-500 ml-1">(${course.id}k)</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">${course.title}</h3>
                        <p class="text-gray-600 mb-4">${course.description.substring(0, 100)}${course.description.length > 100 ? '...' : ''}</p>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <div class="flex items-center mr-4">
                                <i class="ri-time-line mr-2"></i>
                                <span>${course.chapters.reduce((total, chapter) => total + chapter.lessons.length, 0)} hours</span>
                            </div>
                            <div class="flex items-center">
                                <i class="ri-file-list-3-line mr-2"></i>
                                <span>${course.chapters.length} lessons</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center">
                                <img src="${course.teacher_photo}" alt="${course.teacher_name}" class="teacher-photo mr-2">
                                <span class="text-sm font-medium text-gray-700">${course.teacher_name}</span>
                            </div>
                            <span class="text-xl font-bold text-gray-800">€${course.price}</span>
                        </div>
                        <div class="mt-4 space-y-2">
                            ${@json(Auth::check() && Auth::user()->role->name === 'etudiant') ? `
                                <a href="/courses/${course.id}" class="block w-full px-6 py-2 bg-indigo-600 text-white rounded-lg text-center hover:bg-indigo-700 transition-colors font-medium">Voir les détails</a>
                                ${course.is_favorited ? `
                                    <form action="/courses/${course.id}/favorite" method="POST" class="favorite-form">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="w-full px-6 py-2 bg-red-50 text-red-600 rounded-lg text-center hover:bg-red-100 transition-colors font-medium flex items-center justify-center">
                                            <i class="ri-heart-fill mr-2"></i>
                                            Retirer des favoris
                                        </button>
                                    </form>
                                ` : `
                                    <form action="/courses/${course.id}/favorite" method="POST" class="favorite-form">
                                        @csrf
                                        <button type="submit" class="w-full px-6 py-2 bg-gray-50 text-gray-600 rounded-lg text-center hover:bg-gray-100 transition-colors font-medium flex items-center justify-center">
                                            <i class="ri-heart-line mr-2"></i>
                                            Ajouter aux favoris
                                        </button>
                                    </form>
                                `}
                            ` : `<p class="text-sm text-gray-500 text-center">Connectez-vous en tant qu'étudiant pour voir les détails.</p>`}
                        </div>
                    </div>
                `;
                    coursesContainer.appendChild(courseCard);
                });
            }

            // Afficher la pagination dans le DOM
            function displayPagination(pagination) {
                paginationContainer.innerHTML = '';

                // Bouton "Précédent"
                const prevButton = document.createElement('button');
                prevButton.className = `px-4 py-2 rounded-lg ${pagination.current_page === 1 ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'bg-indigo-100 text-indigo-600 hover:bg-indigo-200'}`;
                prevButton.innerHTML = '<i class="ri-arrow-left-line"></i>';
                prevButton.disabled = pagination.current_page === 1;
                prevButton.addEventListener('click', () => {
                    if (pagination.current_page > 1) {
                        currentPage = pagination.current_page - 1;
                        fetchCourses(currentPage, searchQuery);
                    }
                });
                paginationContainer.appendChild(prevButton);

                // Boutons de page
                for (let i = 1; i <= pagination.last_page; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.className = `px-4 py-2 rounded-lg ${i === pagination.current_page ? 'bg-indigo-600 text-white' : 'bg-indigo-100 text-indigo-600 hover:bg-indigo-200'}`;
                    pageButton.textContent = i;
                    pageButton.addEventListener('click', () => {
                        currentPage = i;
                        fetchCourses(currentPage, searchQuery);
                    });
                    paginationContainer.appendChild(pageButton);
                }

                // Bouton "Suivant"
                const nextButton = document.createElement('button');
                nextButton.className = `px-4 py-2 rounded-lg ${pagination.current_page === pagination.last_page ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'bg-indigo-100 text-indigo-600 hover:bg-indigo-200'}`;
                nextButton.innerHTML = '<i class="ri-arrow-right-line"></i>';
                nextButton.disabled = pagination.current_page === pagination.last_page;
                nextButton.addEventListener('click', () => {
                    if (pagination.current_page < pagination.last_page) {
                        currentPage = pagination.current_page + 1;
                        fetchCourses(currentPage, searchQuery);
                    }
                });
                paginationContainer.appendChild(nextButton);
            }

            // Événement de recherche avec debounce
            let timeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    searchQuery = this.value.trim();
                    currentPage = 1;
                    fetchCourses(currentPage, searchQuery);
                }, 300);
            });

            // Gestion du menu mobile
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const sidebarMenu = document.getElementById('sidebar-menu');
            const closeSidebarBtn = document.getElementById('close-sidebar');

            mobileMenuBtn.addEventListener('click', () => {
                sidebarMenu.classList.remove('hidden');
                sidebarMenu.querySelector('.fixed').classList.remove('translate-x-full');
            });

            closeSidebarBtn.addEventListener('click', () => {
                sidebarMenu.querySelector('.fixed').classList.add('translate-x-full');
                setTimeout(() => {
                    sidebarMenu.classList.add('hidden');
                }, 300);
            });

            // Charger les cours initiaux
            fetchCourses(currentPage, searchQuery);
        });

        // Gestion des favoris
        document.addEventListener('submit', function(e) {
            if (e.target.classList.contains('favorite-form')) {
                e.preventDefault();

                const form = e.target;
                const button = form.querySelector('button');
                const originalText = button.innerHTML;
                button.disabled = true;
                button.innerHTML = '<i class="ri-loader-4-line animate-spin mr-2"></i>Chargement...';

                // Récupérer le token CSRF
                const csrfToken = form.querySelector('input[name="_token"]').value;

                // Déterminer si c'est une action d'ajout ou de suppression
                const isRemoving = form.querySelector('input[name="_method"]') !== null;

                // Préparer les données de la requête
                const formData = new FormData();
                formData.append('_token', csrfToken);
                if (isRemoving) {
                    formData.append('_method', 'DELETE');
                }

                // Envoyer la requête
                fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erreur réseau');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Recharger la page pour refléter les changements
                            window.location.reload();
                        } else {
                            throw new Error(data.message || 'Une erreur est survenue');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        button.disabled = false;
                        button.innerHTML = originalText;
                        alert('Une erreur est survenue lors de l\'action sur les favoris');
                    });
            }
        });
    </script>
</body>

</html>