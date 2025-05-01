<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - E-Learning</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon.svg">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        
        .form-gradient {
            background: linear-gradient(135deg, #f3f4f6 0%, #ffffff 100%);
        }

        .modal-gradient {
            background: linear-gradient(135deg, #ffffff 0%, #f3f4f6 100%);
        }
    </style>
    @yield('styles')
</head>
<body class="bg-gradient-to-br from-indigo-50 to-purple-100">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl z-50">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-between p-5 border-b bg-gradient-to-r from-indigo-600 to-purple-600">
                <div class="flex items-center space-x-2">
                    <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-lg font-bold text-white">E-Learning</span>
                </div>
            </div>
            <nav class="flex-1 px-5 py-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center py-3 px-4 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600 bg-indigo-50 font-medium' : '' }}">
                    <i class="ri-dashboard-line mr-3"></i> Tableau de bord
                </a>
                <a href="{{ route('admin.courses.index') }}" class="flex items-center py-3 px-4 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors {{ request()->routeIs('admin.courses.index') || request()->routeIs('admin.courses.show') ? 'text-indigo-600 bg-indigo-50 font-medium' : '' }}">
                    <i class="ri-book-open-line mr-3"></i> Cours
                </a>
                <a href="{{ route('admin.categories_tags.index') }}" class="flex items-center py-3 px-4 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors {{ request()->routeIs('admin.categories_tags.index') ? 'text-indigo-600 bg-indigo-50 font-medium' : '' }}">
                    <i class="ri-price-tag-3-line mr-3"></i> Catégories & Tags
                </a>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center py-3 px-4 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors {{ request()->routeIs('admin.users') ? 'text-indigo-600 bg-indigo-50 font-medium' : '' }}">
                    <i class="ri-user-line mr-3"></i> Utilisateurs
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-40">
            <div class="container mx-auto px-6">
                <div class="flex items-center justify-end py-4">
                    <div class="flex items-center space-x-6">
                        <div class="relative">
                            <button class="flex items-center space-x-2 focus:outline-none">
                                <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="User" class="w-9 h-9 rounded-full border-2 border-indigo-200">
                                <span class="text-sm font-medium text-gray-700">Admin</span>
                            </button>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="flex items-center space-x-2 text-red-600 hover:text-red-800">
                                <i class="ri-logout-box-line"></i>
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        @yield('content')

        <!-- Footer -->
        <footer class="bg-white shadow-sm mt-8">
            <div class="container mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <p class="text-sm text-gray-600">© {{ date('Y') }} E-Learning. Tous droits réservés.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-indigo-600">Conditions d'utilisation</a>
                        <a href="#" class="text-gray-600 hover:text-indigo-600">Politique de confidentialité</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @if(session('success'))
    <div class="fixed bottom-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="fixed bottom-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    @yield('scripts')
</body>
</html>