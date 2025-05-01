<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Learning Platform')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.svg') }}">
    @if (Auth::check() && Auth::user()->role->name !== 'etudiant')
        <script>
            window.location.href = "{{ Auth::user()->role->name === 'admin' ? route('admin.dashboard') : route('enseignant.dashboard') }}";
        </script>
    @endif
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
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .teacher-photo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-gray-50">
    <!-- Top Info Bar -->
    <div class="hidden md:block w-full gradient-bg text-white">
        <div class="container mx-auto px-6 py-2">
            <div class="flex justify-between items-center text-sm">
                <div class="flex items-center space-x-6">
                    <span class="flex items-center">
                        <i class="ri-phone-line mr-2"></i> +212 234-234-234
                    </span>
                    <span class="flex items-center">
                        <i class="ri-mail-line mr-2"></i> contact@e-learning.com
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between py-4">
                <a href="/" class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-xl font-bold text-gray-800">E-Learning</span>
                </a>
                <nav class="hidden md:flex items-center space-x-8">
                    @if (Auth::check() && Auth::user()->role->name === 'etudiant')
                        <a href="/" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Accueil</a>
                        <a href="/etudiant/favorites" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Mes Favoris</a>
                        <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Résultats</a>
                    @endif
                </nav>
                <div class="flex items-center space-x-4">
                    @if (Auth::check())
                        <div class="flex items-center space-x-2">
                            <img src="{{ Auth::user()->photo ? Storage::url(Auth::user()->photo) : 'https://cdn-icons-png.flaticon.com/512/219/219969.png' }}" alt="User" class="w-9 h-9 rounded-full border-2 border-indigo-200">
                            <span class="hidden md:block text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hidden md:block px-5 py-2 text-gray-700 hover:text-indigo-600 transition-colors font-medium">Connexion</a>
                        <a href="{{ route('register') }}" class="hidden md:block px-5 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors font-medium">Inscription</a>
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
                    @if (Auth::check() && Auth::user()->role->name === 'etudiant')
                        <a href="/" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Accueil</a>
                        <a href="/etudiant/favorites" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Mes Favoris</a>
                        <a href="#" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Résultats</a>
                    @else
                        <a href="{{ route('login') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Connexion</a>
                        <a href="{{ route('register') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Inscription</a>
                    @endif
                    @if (!Auth::check())
                        <div class="mt-6 space-y-4 px-4">
                            <a href="{{ route('login') }}" class="block w-full py-3 text-center bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition-colors">Connexion</a>
                            <a href="{{ route('register') }}" class="block w-full py-3 text-center bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">Inscription</a>
                        </div>
                    @endif
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-8">
            <!-- Main Footer Content -->
            <div class="flex flex-col space-y-8 md:flex-row md:space-y-0 md:justify-between md:items-start">
                <!-- Logo, Description, and Social Links -->
                <div class="flex flex-col items-center md:items-start text-center md:text-left">
                    <a href="/" class="flex items-center space-x-2 mb-4">
                        <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                            <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-xl font-bold text-gray-800">E-Learning</span>
                    </a>
                    <p class="text-gray-600 mb-4 max-w-xs">Transform your life through education with our online learning platform.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors" aria-label="Facebook">
                            <i class="ri-facebook-fill text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors" aria-label="Twitter">
                            <i class="ri-twitter-fill text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors" aria-label="Instagram">
                            <i class="ri-instagram-fill text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors" aria-label="LinkedIn">
                            <i class="ri-linkedin-fill text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="flex flex-col space-y-3">
                    @if (Auth::check() && Auth::user()->role->name === 'etudiant')
                        <a href="/" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Accueil</a>
                        <a href="/etudiant/favorites" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Mes Favoris</a>
                        <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Résultats</a>
                    @endif
                </nav>

                <!-- Contact Info -->
                <div class="flex flex-col items-center md:items-end text-sm text-gray-600">
                    <span class="flex items-center mb-2">
                        <i class="ri-phone-line mr-2"></i> +212 234-234-234
                    </span>
                    <span class="flex items-center">
                        <i class="ri-mail-line mr-2"></i> contact@e-learning.com
                    </span>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-200 mt-8 pt-4">
                <p class="text-center text-gray-600 text-sm">
                    © 2025 E-Learning Platform. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', () => {
            document.getElementById('sidebar-menu').classList.toggle('hidden');
        });
        document.getElementById('close-sidebar').addEventListener('click', () => {
            document.getElementById('sidebar-menu').classList.add('hidden');
        });
    </script>
    @yield('scripts')
</body>
</html>
