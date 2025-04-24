<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours Favoris - E-Learning</title>
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

        .course-image {
            transition: transform 0.3s ease;
        }

        .course-image:hover {
            transform: scale(1.03);
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
                    <a href="{{ route('courses.show') }}" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Accueil</a>
                    <a href="{{ route('courses.show') }}" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Cours</a>
                    <a href="{{ route('favorites.index') }}" class="text-indigo-600 font-medium">Mes Favoris</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Tarifs</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Fonctionnalités</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Blog</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Centre d'aide</a>
                </nav>
                <div class="flex items-center space-x-4">
                    @if (Auth::check())
                        <div class="flex items-center space-x-2">
                            <img src="{{ Auth::user()->image ? Storage::url(Auth::user()->image) : 'https://cdn-icons-png.flaticon.com/512/219/219969.png' }}" alt="User" class="w-9 h-9 rounded-full border-2 border-indigo-200">
                            <span class="hidden md:block text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
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
                    <a href="{{ route('courses.show') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Accueil</a>
                    <a href="{{ route('courses.show') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Cours</a>
                    <a href="{{ route('favorites.index') }}" class="py-3 px-4 rounded-lg bg-indigo-50 text-indigo-600 font-medium">Mes Favoris</a>
                    <a href="#" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Tarifs</a>
                    <a href="#" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Fonctionnalités</a>
                    <a href="#" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Blog</a>
                    <a href="#" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Centre d'aide</a>
                    <div class="mt-6 space-y-4 px-4">
                        <a href="{{ route('login') }}" class="block w-full py-3 text-center bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition-colors">Connexion</a>
                        <a href="{{ route('register.form') }}" class="block w-full py-3 text-center bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">Inscription</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Page Title -->
    <section class="py-12 gradient-bg text-white">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-bold mb-2">Mes Cours Favoris</h1>
            <div class="flex items-center text-sm">
                <a href="{{ route('courses.show') }}" class="hover:underline">Accueil</a>
                <span class="mx-2">/</span>
                <a href="{{ route('courses.show') }}" class="hover:underline">Cours</a>
                <span class="mx-2">/</span>
                <span>Mes Favoris</span>
            </div>
        </div>
    </section>

    <!-- Favorites Section -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('info'))
                <div class="bg-blue-100 text-blue-800 p-4 rounded-lg mb-6">
                    {{ session('info') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if($favoriteCourses->isEmpty())
                <div class="glass-card p-8 text-center">
                    <i class="ri-heart-line text-5xl text-gray-400 mb-4"></i>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Vous n'avez pas encore de cours favoris</h2>
                    <p class="text-gray-600 mb-6">Explorez nos cours et ajoutez vos préférés à cette liste pour y accéder facilement.</p>
                    <a href="{{ route('courses.show') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        Découvrir les cours
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($favoriteCourses as $course)
                        <div class="glass-card overflow-hidden">
                            <div class="relative">
                                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-48 object-cover course-image">
                                <div class="absolute top-4 right-4">
                                    <form action="{{ route('favorites.destroy', $course->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-white p-2 rounded-full shadow-md hover:bg-red-50 transition-colors">
                                            <i class="ri-heart-fill text-red-500 text-xl"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-2">
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs font-medium rounded-full">
                                        {{ $course->category->name }}
                                    </span>
                                    <span class="ml-2 text-sm text-gray-500">
                                        {{ $course->chapters->sum(function ($chapter) { return $chapter->lessons->count(); }) }} leçons
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $course->title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $course->description }}</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img src="{{ $course->user->image ? Storage::url($course->user->image) : 'https://cdn-icons-png.flaticon.com/512/219/219969.png' }}" alt="{{ $course->user->name }}" class="w-8 h-8 rounded-full mr-2">
                                        <span class="text-sm text-gray-700">{{ $course->user->name }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-indigo-600 font-bold">€{{ number_format($course->price, 2) }}</span>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <a href="{{ route('courses.details', $course->id) }}" class="block w-full py-3 bg-indigo-600 text-white rounded-lg text-center hover:bg-indigo-700 transition-colors">
                                        Voir le cours
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                            <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-xl font-bold text-gray-800">E-Learning</span>
                    </div>
                    <p class="text-gray-600 mb-4">Transformez votre vie grâce à l'éducation avec notre plateforme d'apprentissage en ligne.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-indigo-600"><i class="ri-facebook-fill text-xl"></i></a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600"><i class="ri-twitter-fill text-xl"></i></a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600"><i class="ri-instagram-fill text-xl"></i></a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600"><i class="ri-linkedin-fill text-xl"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('courses.show') }}" class="text-gray-600 hover:text-indigo-600">Accueil</a></li>
                        <li><a href="{{ route('courses.show') }}" class="text-gray-600 hover:text-indigo-600">Cours</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Tarifs</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Fonctionnalités</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Centre d'aide</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">FAQ</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Contactez-nous</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Politique de confidentialité</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Conditions d'utilisation</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Abonnez-vous</h3>
                    <p class="text-gray-600 mb-4">Abonnez-vous à notre newsletter pour recevoir les dernières mises à jour.</p>
                    <form action="#" method="POST" class="flex flex-col space-y-3">
                        <input type="email" name="email" placeholder="Votre email" required class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">S'abonner</button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-200 mt-10 pt-6">
                <p class="text-center text-gray-600 text-sm">© 2025 Plateforme E-Learning. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile menu toggle -->
    <script>
    document.getElementById('mobile-menu-btn').addEventListener('click', () => {
        document.getElementById('sidebar-menu').classList.toggle('hidden');
    });

    document.getElementById('close-sidebar').addEventListener('click', () => {
        document.getElementById('sidebar-menu').classList.add('hidden');
    });
    </script>
</body>
</html> 