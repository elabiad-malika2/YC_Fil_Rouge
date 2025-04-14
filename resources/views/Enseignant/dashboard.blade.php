<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 bg-indigo-600">
                    <span class="text-white text-xl font-bold">E-Learning</span>
                </div>

                <!-- Profile Section -->
                <div class="p-4 border-b">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            @if(auth()->user()->image)
                                <img src="{{ asset('storage/' . auth()->user()->image) }}" 
                                     alt="Profile" 
                                     class="w-12 h-12 rounded-full object-cover">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center">
                                    <i class="ri-user-line text-2xl text-gray-600"></i>
                                </div>
                            @endif
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ auth()->user()->name }}</h3>
                            <p class="text-sm text-gray-500">Enseignant</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 p-4">
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600">
                                <i class="ri-dashboard-line"></i>
                                <span>Tableau de bord</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600">
                                <i class="ri-book-line"></i>
                                <span>Mes cours</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600">
                                <i class="ri-calendar-line"></i>
                                <span>Calendrier</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600">
                                <i class="ri-message-3-line"></i>
                                <span>Messages</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ml-64">
            <!-- Header -->
            <header class="bg-white shadow">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-2xl font-semibold text-gray-800">Tableau de bord</h1>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 text-gray-600 hover:text-indigo-600">
                            <i class="ri-notification-3-line text-xl"></i>
                        </button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center space-x-2 text-gray-600 hover:text-indigo-600">
                                <i class="ri-logout-box-line"></i>
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="p-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="flex items-center space-x-6">
                        <div class="relative">
                            @if(auth()->user()->image)
                                <img src="{{ asset('storage/' . auth()->user()->image) }}" 
                                     alt="Profile" 
                                     class="w-32 h-32 rounded-full object-cover">
                            @else
                                <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center">
                                    <i class="ri-user-line text-5xl text-gray-600"></i>
                                </div>
                            @endif
                            <span class="absolute bottom-2 right-2 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></span>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-gray-800">{{ auth()->user()->name }}</h2>
                            <p class="text-gray-600 mb-2">{{ auth()->user()->email }}</p>
                            <p class="text-gray-600">Enseignant</p>
                        </div>
                        <div>
                            <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                Modifier le profil
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Cours créés</p>
                                <h3 class="text-2xl font-bold text-gray-800">12</h3>
                            </div>
                            <div class="p-3 bg-indigo-100 rounded-full">
                                <i class="ri-book-line text-2xl text-indigo-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Étudiants</p>
                                <h3 class="text-2xl font-bold text-gray-800">156</h3>
                            </div>
                            <div class="p-3 bg-green-100 rounded-full">
                                <i class="ri-user-line text-2xl text-green-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Messages</p>
                                <h3 class="text-2xl font-bold text-gray-800">24</h3>
                            </div>
                            <div class="p-3 bg-yellow-100 rounded-full">
                                <i class="ri-message-3-line text-2xl text-yellow-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Activité récente</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-indigo-100 rounded-full">
                                <i class="ri-book-line text-indigo-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800">Nouveau cours créé : "Introduction à Laravel"</p>
                                <p class="text-sm text-gray-500">Il y a 2 heures</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-green-100 rounded-full">
                                <i class="ri-user-line text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800">5 nouveaux étudiants inscrits</p>
                                <p class="text-sm text-gray-500">Il y a 5 heures</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-yellow-100 rounded-full">
                                <i class="ri-message-3-line text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-800">Nouveau message de John Doe</p>
                                <p class="text-sm text-gray-500">Il y a 1 jour</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html> 