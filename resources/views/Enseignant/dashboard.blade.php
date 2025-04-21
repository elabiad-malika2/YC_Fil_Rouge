<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord enseignant - E-Learning</title>
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

        .counter-box {
            visibility: hidden;
        }

        .counter-box.visible {
            visibility: visible;
        }

        .dashboard-stat-card {
            transition: all 0.3s ease;
        }

        .dashboard-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .image-preview {
            width: 100%;
            height: 200px;
            border: 2px dashed #e2e8f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 100%;
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
                <a href="./index.php" class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-xl font-bold text-gray-800">E-Learning</span>
                </a>
                
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="./dashboard.php" class="text-indigo-600 hover:text-indigo-800 transition-colors font-medium">Tableau de bord</a>
                    <a href="./courses.php" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Mes cours</a>
                    <a href="./students.php" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Étudiants</a>
                    <a href="./messages.php" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Messages</a>
                    <a href="./settings.php" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Paramètres</a>
                </nav>
                
                <div class="flex items-center space-x-4">
                    <div class="relative hidden md:block">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="ri-search-line text-gray-400"></i>
                        </span>
                        <input type="text" placeholder="Rechercher..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm">
                    </div>
                    
                    <div class="relative">
                        <button class="p-2 rounded-full text-gray-500 hover:bg-gray-100 relative">
                            <i class="ri-notification-3-line text-xl"></i>
                            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                        </button>
                    </div>
                    
                    <div class="relative">
                        <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                            <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="User" class="w-9 h-9 rounded-full border-2 border-indigo-200">
                            <span class="hidden md:block text-sm font-medium text-gray-700">
                                John Doe
                                <i class="ri-arrow-down-s-line text-gray-400"></i>
                            </span>
                        </button>
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
                <nav class="flex flex-col px-5 py-6">
                    <a href="./dashboard.php" class="py-3 px-4 rounded-lg text-indigo-600 bg-indigo-50 font-medium">Tableau de bord</a>
                    <a href="./courses.php" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Mes cours</a>
                    <a href="./students.php" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Étudiants</a>
                    <a href="./messages.php" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Messages</a>
                    <a href="./settings.php" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Paramètres</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-3 border-b">
        <div class="container mx-auto px-6">
            <div class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="./index.php" class="hover:text-indigo-600">Accueil</a>
                <i class="ri-arrow-right-s-line"></i>
                <span class="text-gray-800 font-medium">Tableau de bord enseignant</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <!-- Welcome Banner -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Bonjour, John Doe 👋</h1>
                    <p class="text-gray-600">Bienvenue sur votre tableau de bord enseignant. Créez et gérez vos cours en toute simplicité.</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <button id="create-course-btn" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1 flex items-center space-x-2">
                        <i class="ri-add-line text-lg"></i>
                        <span class="font-medium">Créer un nouveau cours</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="dashboard-stat-card bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                        <i class="ri-book-open-line text-2xl text-indigo-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Cours actifs</p>
                        <h3 class="text-2xl font-bold text-gray-800">12</h3>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-green-600 text-sm font-medium flex items-center">
                        <i class="ri-arrow-up-line mr-1"></i> 
                        8% depuis le mois dernier
                    </span>
                </div>
            </div>

            <div class="dashboard-stat-card bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                        <i class="ri-user-line text-2xl text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Étudiants inscrits</p>
                        <h3 class="text-2xl font-bold text-gray-800">1,254</h3>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-green-600 text-sm font-medium flex items-center">
                        <i class="ri-arrow-up-line mr-1"></i> 
                        12% depuis le mois dernier
                    </span>
                </div>
            </div>

            <div class="dashboard-stat-card bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mr-4">
                        <i class="ri-coin-line text-2xl text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Revenus</p>
                        <h3 class="text-2xl font-bold text-gray-800">$8,450</h3>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-green-600 text-sm font-medium flex items-center">
                        <i class="ri-arrow-up-line mr-1"></i> 
                        5% depuis le mois dernier
                    </span>
                </div>
            </div>

            <div class="dashboard-stat-card bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center mr-4">
                        <i class="ri-star-line text-2xl text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Note moyenne</p>
                        <h3 class="text-2xl font-bold text-gray-800">4.8/5</h3>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-green-600 text-sm font-medium flex items-center">
                        <i class="ri-arrow-up-line mr-1"></i> 
                        2% depuis le mois dernier
                    </span>
                </div>
            </div>
        </div>

        <!-- Recent Courses and Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Courses -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Vos cours récents</h2>
                        <a href="./courses.php" class="text-indigo-600 text-sm font-medium hover:text-indigo-800 transition-colors">
                            Voir tous les cours
                        </a>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Course 1 -->
                        <div class="space-y-4">
                            @forelse ($courses as $course)
                                <div class="flex items-center p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                                    <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-16 h-16 object-cover rounded mr-4">
                                    <div class="flex-1">
                                        <h3 class="font-medium text-gray-800">{{ $course->title }}</h3>
                                        <div class="flex items-center mt-1">
                                            <span class="text-sm text-gray-500 mr-4">
                                                {{ $course->chapitres_count }} chapitre{{ $course->chapitres_count > 1 ? 's' : '' }} • {{ $course->lessons_count }} leçon{{ $course->lessons_count > 1 ? 's' : '' }}
                                            </span>
                                            <div class="flex items-center">
                                                <i class="ri-user-line text-gray-400 mr-1"></i>
                                                <span class="text-sm text-gray-500">0 étudiants</span> <!-- À remplacer par le vrai nombre d'étudiants si disponible -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                            {{$course->level}}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-gray-500 py-4">
                                    Aucun cours récent trouvé.
                                </div>
                            @endforelse
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <!-- Recent Activity -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Activité récente</h2>
                        <a href="#" class="text-indigo-600 text-sm font-medium hover:text-indigo-800 transition-colors">
                            Voir tout
                        </a>
                    </div>
                    
                    <div class="space-y-6">
                        <!-- Activity 1 -->
                        <div class="flex">
                            <div class="mr-4 relative">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="ri-message-3-line text-blue-600"></i>
                                </div>
                                <div class="absolute top-10 bottom-0 left-1/2 w-0.5 -ml-px bg-gray-200"></div>
                            </div>
                            <div>
                                <p class="text-gray-800">
                                    <span class="font-medium">Emma Smith</span> a posé une question dans <a href="#" class="text-indigo-600 hover:underline">Modern JavaScript</a>
                                </p>
                                <span class="text-sm text-gray-500">Il y a 35 minutes</span>
                            </div>
                        </div>
                        
                        <!-- Activity 2 -->
                        <div class="flex">
                            <div class="mr-4 relative">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="ri-user-add-line text-green-600"></i>
                                </div>
                                <div class="absolute top-10 bottom-0 left-1/2 w-0.5 -ml-px bg-gray-200"></div>
                            </div>
                            <div>
                                <p class="text-gray-800">
                                    <span class="font-medium">5 nouveaux étudiants</span> se sont inscrits à <a href="#" class="text-indigo-600 hover:underline">React - The Complete Guide</a>
                                </p>
                                <span class="text-sm text-gray-500">Il y a 2 heures</span>
                            </div>
                        </div>
                        
                        <!-- Activity 3 -->
                        <div class="flex">
                            <div class="mr-4 relative">
                                <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                    <i class="ri-star-line text-yellow-600"></i>
                                </div>
                                <div class="absolute top-10 bottom-0 left-1/2 w-0.5 -ml-px bg-gray-200"></div>
                            </div>
                            <div>
                                <p class="text-gray-800">
                                    <span class="font-medium">3 nouvelles évaluations</span> sur <a href="#" class="text-indigo-600 hover:underline">Modern JavaScript</a>
                                </p>
                                <span class="text-sm text-gray-500">Hier</span>
                            </div>
                        </div>
                        
                        <!-- Activity 4 -->
                        <div class="flex">
                            <div class="mr-4">
                                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                                    <i class="ri-coin-line text-red-600"></i>
                                </div>
                            </div>
                            <div>
                                <p class="text-gray-800">
                                    <span class="font-medium">Paiement reçu</span> de $285.50 pour les cours de ce mois
                                </p>
                                <span class="text-sm text-gray-500">Hier</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Formulaire d'ajout de cours - Version dynamique -->
    <div id="create-course-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden overflow-y-auto">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-4xl relative">
                <form method="POST" action="/enseignant/courses" enctype="multipart/form-data" class="p-6">
                    @csrf
                    
                    <!-- En-tête du formulaire -->
                    <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-800">Créer un nouveau cours</h2>
                        <button type="button" id="close-modal-btn" class="text-gray-500 hover:text-gray-700 transition-colors">
                            <i class="ri-close-line text-2xl"></i>
                        </button>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <strong>Oups ! Il y a des erreurs :</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <!-- Informations du cours -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Informations générales</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Titre -->
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre du cours <span class="text-red-600">*</span></label>
                                <input type="text" id="title" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors" placeholder="Entrez un titre accrocheur" required>
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-600">*</span></label>
                                <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors" placeholder="Décrivez votre cours en détail" required></textarea>
                            </div>

                            <!-- Image -->
                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image du cours <span class="text-red-600">*</span></label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-500 transition-colors">
                                    <div class="space-y-1 text-center">
                                        <i class="ri-image-add-line text-3xl text-gray-400"></i>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                                <span>Télécharger une image</span>
                                                <input id="image" name="image" type="file" class="sr-only" accept="image/*" required>
                                            </label>
                                            <p class="pl-1">ou glisser-déposer</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF jusqu'à 10MB</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Catégorie -->
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Catégorie <span class="text-red-600">*</span></label>
                                <select id="category_id" name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors" required>
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Prix -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Prix (en €) <span class="text-red-600">*</span></label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">€</span>
                                    <input type="number" id="price" name="price" min="0" step="0.01" class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors" placeholder="19.99" required>
                                </div>
                            </div>

                            <!-- Niveau -->
                            <div>
                                <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Niveau <span class="text-red-600">*</span></label>
                                <select id="level" name="level" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors" required>
                                    <option value="">Sélectionnez un niveau</option>
                                    <option value="debutant">Débutant</option>
                                    <option value="intermediaire">Intermédiaire</option>
                                    <option value="avance">Avancé</option>
                                    <option value="expert">Expert</option>

                                </select>
                                
                            </div>

                            <!-- Tags -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Tags</label>
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                                    @foreach($tags as $tag)
                                        <label class="relative flex items-center p-3 rounded-lg border border-gray-200 hover:border-indigo-500 transition-colors cursor-pointer">
                                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                            <span class="ml-3 text-sm font-medium" style="color: {{ $tag->color }};">
                                                {{ $tag->name }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chapitres et leçons -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Chapitres et leçons</h3>
                        <div id="chapters-container" class="space-y-6">
                            <!-- Les chapitres seront ajoutés dynamiquement ici -->
                        </div>
                        <button type="button" id="add-chapter-btn" class="mt-4 px-4 py-2 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 transition-colors flex items-center space-x-2">
                            <i class="ri-add-line"></i>
                            <span>Ajouter un chapitre</span>
                        </button>
                    </div>
                    
                    <!-- Boutons de contrôle -->
                    <div class="flex justify-end space-x-3 border-t border-gray-200 pt-6">
                        <button type="button" id="cancel-create-course" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                            Annuler
                        </button>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                            <i class="ri-save-line mr-1"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-100 py-8 mt-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                            <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-xl font-bold text-gray-800">E-Learning</span>
                    </div>
                    <p class="text-gray-600 mb-4">Espace enseignant dédié pour créer et gérer vos cours en ligne facilement.</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="./dashboard.php" class="text-gray-600 hover:text-indigo-600">Tableau de bord</a></li>
                        <li><a href="./courses.php" class="text-gray-600 hover:text-indigo-600">Mes cours</a></li>
                        <li><a href="./students.php" class="text-gray-600 hover:text-indigo-600">Étudiants</a></li>
                        <li><a href="./earnings.php" class="text-gray-600 hover:text-indigo-600">Revenus</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="./help.php" class="text-gray-600 hover:text-indigo-600">Centre d'aide</a></li>
                        <li><a href="./contact.php" class="text-gray-600 hover:text-indigo-600">Contactez-nous</a></li>
                        <li><a href="./community.php" class="text-gray-600 hover:text-indigo-600">Communauté</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-200 mt-8 pt-6">
                <p class="text-center text-gray-600 text-sm">
                    © 2025 E-Learning Platform. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for interactions -->
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const closeSidebarBtn = document.getElementById('close-sidebar');
        const sidebarMenu = document.getElementById('sidebar-menu');
        
        if (mobileMenuBtn && closeSidebarBtn && sidebarMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                sidebarMenu.classList.remove('hidden');
            });
            
            closeSidebarBtn.addEventListener('click', () => {
                sidebarMenu.classList.add('hidden');
            });
        }

        // Tags selection enhancement
        document.addEventListener('DOMContentLoaded', function() {
            const tagsSelect = document.getElementById('tags');
            if (tagsSelect) {
                // Add custom styling for selected options
                tagsSelect.addEventListener('change', function() {
                    Array.from(this.options).forEach(option => {
                        if (option.selected) {
                            option.classList.add('bg-indigo-100');
                        } else {
                            option.classList.remove('bg-indigo-100');
                        }
                    });
                });
            }
        });

        // Modal and dynamic form handling
        document.addEventListener('DOMContentLoaded', function() {
            const createCourseBtn = document.getElementById('create-course-btn');
            const createCourseModal = document.getElementById('create-course-modal');
            const closeModalBtn = document.getElementById('close-modal-btn');
            const cancelCreateCourseBtn = document.getElementById('cancel-create-course');
            const chaptersContainer = document.getElementById('chapters-container');
            const addChapterBtn = document.getElementById('add-chapter-btn');
            let chapterCount = 0;

            // Afficher le formulaire
            createCourseBtn.addEventListener('click', function() {
                createCourseModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                // Ajouter un chapitre initial si aucun n'existe
                if (chapterCount === 0) {
                    addChapter();
                }
            });

            // Masquer le formulaire
            function hideModal() {
                createCourseModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            closeModalBtn.addEventListener('click', hideModal);
            cancelCreateCourseBtn.addEventListener('click', hideModal);

            // Ajouter un nouveau chapitre
            function addChapter() {
                const chapterIndex = chapterCount++;
                const chapterDiv = document.createElement('div');
                chapterDiv.className = 'bg-gray-50 rounded-lg border border-gray-200 p-4 mb-6';
                chapterDiv.innerHTML = `
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="font-medium text-gray-800">Chapitre ${chapterIndex + 1}</h4>
                        <button type="button" class="remove-chapter-btn text-red-500 hover:text-red-700">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Titre du chapitre <span class="text-red-600">*</span></label>
                        <input type="text" name="chapitres[${chapterIndex}][title]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Ex: Introduction à JavaScript" required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description du chapitre</label>
                        <textarea name="chapitres[${chapterIndex}][description]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" rows="2" placeholder="Brève description de ce chapitre"></textarea>
                    </div>
                    <div class="pl-4 border-l-2 border-indigo-100 mt-4">
                        <h5 class="font-medium text-gray-700 mb-2">Leçons</h5>
                        <div class="lessons-container space-y-2"></div>
                        <button type="button" class="add-lesson-btn mt-2 px-3 py-1 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 transition-colors text-sm flex items-center">
                            <i class="ri-add-line mr-1"></i> Ajouter une leçon
                        </button>
                    </div>
                `;
                chaptersContainer.appendChild(chapterDiv);

                // Ajouter une leçon initiale
                const lessonsContainer = chapterDiv.querySelector('.lessons-container');
                addLesson(lessonsContainer, chapterIndex, 0);

                // Gestionnaire pour ajouter une leçon
                const addLessonBtn = chapterDiv.querySelector('.add-lesson-btn');
                let lessonCount = 1;
                addLessonBtn.addEventListener('click', () => {
                    addLesson(lessonsContainer, chapterIndex, lessonCount++);
                });

                // Gestionnaire pour supprimer un chapitre
                const removeChapterBtn = chapterDiv.querySelector('.remove-chapter-btn');
                removeChapterBtn.addEventListener('click', () => {
                    if (chapterCount > 1) {
                        chapterDiv.remove();
                        chapterCount--;
                        updateChapterTitles();
                    }
                });
            }

            // Ajouter une nouvelle leçon
            function addLesson(container, chapterIndex, lessonIndex) {
                const lessonDiv = document.createElement('div');
                lessonDiv.className = 'bg-white rounded border border-gray-200 p-3 relative';
                lessonDiv.innerHTML = `
                    <h6 class="font-medium text-sm text-gray-700 mb-2">Leçon ${lessonIndex + 1}</h6>
                    <button type="button" class="remove-lesson-btn absolute top-3 right-3 text-red-500 hover:text-red-700">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                    <div class="mb-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Titre de la leçon <span class="text-red-600">*</span></label>
                        <input type="text" name="chapitres[${chapterIndex}][lessons][${lessonIndex}][title]" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" placeholder="Ex: Variables et types de données" required>
                    </div>
                    <div class="mb-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Type de contenu</label>
                        <select name="chapitres[${chapterIndex}][lessons][${lessonIndex}][type]" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" onchange="toggleContentType(this, ${chapterIndex}, ${lessonIndex})" required>
                            <option value="">Sélectionner le type</option>
                            <option value="text" selected>Texte</option>
                            <option value="video">Vidéo</option>
                        </select>
                    </div>
                    <div class="mb-2 content-type-text">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Contenu texte <span class="text-red-600">*</span></label>
                        <textarea name="chapitres[${chapterIndex}][lessons][${lessonIndex}][text_content]" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" rows="3" placeholder="Contenu détaillé de la leçon"></textarea>
                    </div>
                    <div class="mb-2 content-type-video hidden">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Vidéo <span class="text-red-600">*</span></label>
                        <input type="file" name="chapitres[${chapterIndex}][lessons][${lessonIndex}][video]" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" accept="video/*">
                    </div>
                    <div class="flex items-center text-xs text-gray-500">
                        <label class="flex items-center">
                            <input type="checkbox" name="chapitres[${chapterIndex}][lessons][${lessonIndex}][is_free]" class="mr-1 rounded text-indigo-600">
                            Leçon gratuite (prévisualisation)
                        </label>
                    </div>
                `;
                container.appendChild(lessonDiv);

                // Gestionnaire pour supprimer une leçon
                const removeLessonBtn = lessonDiv.querySelector('.remove-lesson-btn');
                removeLessonBtn.addEventListener('click', () => {
                    if (container.children.length > 1) {
                        lessonDiv.remove();
                        updateLessonTitles(container);
                    }
                });
            }

            // Mettre à jour les titres des chapitres
            function updateChapterTitles() {
                const chapters = chaptersContainer.querySelectorAll('.bg-gray-50');
                chapters.forEach((chapter, index) => {
                    const title = chapter.querySelector('h4');
                    title.textContent = `Chapitre ${index + 1}`;
                });
            }

            // Mettre à jour les titres des leçons
            function updateLessonTitles(container) {
                const lessons = container.querySelectorAll('.bg-white');
                lessons.forEach((lesson, index) => {
                    const title = lesson.querySelector('h6');
                    title.textContent = `Leçon ${index + 1}`;
                });
            }

            // Gestionnaire pour ajouter un chapitre
            addChapterBtn.addEventListener('click', addChapter);
        });

        function toggleContentType(select, chapterIndex, lessonIndex) {
            const lessonDiv = select.closest('.bg-white');
            const textContent = lessonDiv.querySelector('.content-type-text');
            const videoContent = lessonDiv.querySelector('.content-type-video');
            
            if (select.value === 'text') {
                textContent.classList.remove('hidden');
                videoContent.classList.add('hidden');
                textContent.querySelector('textarea').required = true;
                videoContent.querySelector('input[type="file"]').required = false;
            } else {
                textContent.classList.add('hidden');
                videoContent.classList.remove('hidden');
                textContent.querySelector('textarea').required = false;
                videoContent.querySelector('input[type="file"]').required = true;
            }
        }
    </script>
</body>
</html>