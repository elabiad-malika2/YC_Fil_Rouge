<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Learning Platform')</title>
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
        
        .lesson-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .lesson-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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
                <a href="{{ route('index') }}" class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-xl font-bold text-gray-800">E-Learning</span>
                </a>
                
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('student.dashboard') }}" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium {{ request()->routeIs('student.dashboard') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : '' }}">Tableau de bord</a>
                    <a href="{{ route('student.courses') }}" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium {{ request()->routeIs('student.courses*') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : '' }}">Mes cours</a>
                    <a href="{{ route('student.calendar') }}" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium {{ request()->routeIs('student.calendar') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : '' }}">Calendrier</a>
                    <a href="{{ route('student.assignments') }}" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium {{ request()->routeIs('student.assignments') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : '' }}">Devoirs</a>
                    <a href="{{ route('student.forum') }}" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium {{ request()->routeIs('student.forum') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : '' }}">Forum</a>
                </nav>
                
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="p-2 rounded-full text-gray-500 hover:bg-gray-100">
                            <i class="ri-notification-3-line text-xl"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                    </div>
                    
                    <div class="relative group">
                        <button class="flex items-center space-x-2">
                            <img src="{{ asset('assets/images/avatar.jpg') }}" alt="User" class="w-8 h-8 rounded-full object-cover border-2 border-indigo-100">
                            <span class="text-gray-700 font-medium hidden md:block">{{ auth()->user()->name ?? 'Ahmed Alami' }}</span>
                            <i class="ri-arrow-down-s-line text-gray-500 hidden md:block"></i>
                        </button>
                        
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 invisible group-hover:visible transition-all opacity-0 group-hover:opacity-100 z-50">
                            <div class="p-3 border-b border-gray-100">
                                <p class="text-sm text-gray-500">Connecté en tant que</p>
                                <p class="font-medium text-gray-800">{{ auth()->user()->name ?? 'Ahmed Alami' }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('student.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mon profil</a>
                                <a href="{{ route('student.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Paramètres</a>
                                <a href="{{ route('help') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Aide</a>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Déconnexion
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    
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
                <div class="px-5 py-4 border-b">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('assets/images/avatar.jpg') }}" alt="User" class="w-10 h-10 rounded-full object-cover border-2 border-indigo-100">
                        <div>
                            <p class="font-medium text-gray-800">{{ auth()->user()->name ?? 'Ahmed Alami' }}</p>
                            <p class="text-sm text-gray-500">Étudiant</p>
                        </div>
                    </div>
                </div>
                <nav class="flex flex-col px-5 py-6">
                    <a href="{{ route('student.dashboard') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors {{ request()->routeIs('student.dashboard') ? 'text-indigo-600 bg-indigo-50 font-medium' : '' }}">Tableau de bord</a>
                    <a href="{{ route('student.courses') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors {{ request()->routeIs('student.courses*') ? 'text-indigo-600 bg-indigo-50 font-medium' : '' }}">Mes cours</a>
                    <a href="{{ route('student.calendar') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors {{ request()->routeIs('student.calendar') ? 'text-indigo-600 bg-indigo-50 font-medium' : '' }}">Calendrier</a>
                    <a href="{{ route('student.assignments') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors {{ request()->routeIs('student.assignments') ? 'text-indigo-600 bg-indigo-50 font-medium' : '' }}">Devoirs</a>
                    <a href="{{ route('student.forum') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors {{ request()->routeIs('student.forum') ? 'text-indigo-600 bg-indigo-50 font-medium' : '' }}">Forum</a>
                    
                    <div class="border-t border-gray-200 my-4"></div>
                    
                    <a href="{{ route('student.profile') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Mon profil</a>
                    <a href="{{ route('student.settings') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Paramètres</a>
                    <a href="{{ route('help') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Aide</a>
                    <a href="{{ route('logout') }}" class="mt-4 py-3 px-4 rounded-lg text-red-600 hover:bg-red-50 transition-colors"
                       onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();">
                        Déconnexion
                    </a>
                    <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-10">
        <div class="container mx-auto px-6">
            @yield('content')
        </div>
    </main>

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
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('index') }}" class="text-gray-600 hover:text-indigo-600">Accueil</a></li>
                        <li><a href="{{ route('student.courses') }}" class="text-gray-600 hover:text-indigo-600">Mes cours</a></li>
                        <li><a href="{{ route('student.calendar') }}" class="text-gray-600 hover:text-indigo-600">Calendrier</a></li>
                        <li><a href="{{ route('student.forum') }}" class="text-gray-600 hover:text-indigo-600">Forum</a></li>
                        <li><a href="{{ route('student.profile') }}" class="text-gray-600 hover:text-indigo-600">Mon profil</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('help') }}" class="text-gray-600 hover:text-indigo-600">Centre d'aide</a></li>
                        <li><a href="{{ route('faq') }}" class="text-gray-600 hover:text-indigo-600">FAQ</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-600 hover:text-indigo-600">Contactez-nous</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-gray-600 hover:text-indigo-600">Politique de confidentialité</a></li>
                        <li><a href="{{ route('terms') }}" class="text-gray-600 hover:text-indigo-600">Conditions d'utilisation</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">S'abonner</h3>
                    <p class="text-gray-600 mb-4">Abonnez-vous à notre newsletter pour recevoir les dernières mises à jour.</p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col space-y-3">
                        @csrf
                        <input type="email" name="email" placeholder="Votre email" required
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            S'abonner
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-200 mt-10 pt-6">
                <p class="text-center text-gray-600 text-sm">
                    &copy; {{ date('Y') }} E-Learning Platform. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>
    
    <script>
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const closeSidebarBtn = document.getElementById('close-sidebar');
        const sidebarMenu = document.getElementById('sidebar-menu');
        
        if (mobileMenuBtn && closeSidebarBtn && sidebarMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                sidebarMenu.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
            
            closeSidebarBtn.addEventListener('click', () => {
                sidebarMenu.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });
        }
    </script>
    
</body>
</html>