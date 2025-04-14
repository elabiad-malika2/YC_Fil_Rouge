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

        /* Image upload preview */
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
                        <!-- User dropdown menu would go here -->
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
                    <button id="create-course-btn" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium flex items-center">
                        <i class="ri-add-line mr-2"></i> Créer un nouveau cours
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
                        <div class="flex items-center p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                            <img src="https://bilis.com/wp-content/uploads/2020/04/elearning.jpg" alt="Course" class="w-16 h-16 object-cover rounded mr-4">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-800">Modern JavaScript from Scratch</h3>
                                <div class="flex items-center mt-1">
                                    <span class="text-sm text-gray-500 mr-4">42 heures • 28 leçons</span>
                                    <div class="flex items-center">
                                        <i class="ri-user-line text-gray-400 mr-1"></i>
                                        <span class="text-sm text-gray-500">246 étudiants</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4">
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                    Publié
                                </span>
                            </div>
                        </div>
                        
                        <!-- Course 2 -->
                        <div class="flex items-center p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                            <img src="https://bilis.com/wp-content/uploads/2020/04/elearning.jpg" alt="Course" class="w-16 h-16 object-cover rounded mr-4">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-800">React - The Complete Guide 2025</h3>
                                <div class="flex items-center mt-1">
                                    <span class="text-sm text-gray-500 mr-4">48 heures • 32 leçons</span>
                                    <div class="flex items-center">
                                        <i class="ri-user-line text-gray-400 mr-1"></i>
                                        <span class="text-sm text-gray-500">184 étudiants</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4">
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                    Publié
                                </span>
                            </div>
                        </div>
                        
                        <!-- Course 3 -->
                        <div class="flex items-center p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                            <img src="https://bilis.com/wp-content/uploads/2020/04/elearning.jpg" alt="Course" class="w-16 h-16 object-cover rounded mr-4">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-800">Node.js API Development Masterclass</h3>
                                <div class="flex items-center mt-1">
                                    <span class="text-sm text-gray-500 mr-4">36 heures • 24 leçons</span>
                                    <div class="flex items-center">
                                        <i class="ri-user-line text-gray-400 mr-1"></i>
                                        <span class="text-sm text-gray-500">0 étudiants</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4">
                                <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                    Brouillon
                                </span>
                            </div>
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

    <!-- Create Course Modal -->
    <div id="create-course-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full">
                <div class="flex justify-between items-center p-6 border-b">
                    <h2 class="text-xl font-bold text-gray-800">Créer un nouveau cours</h2>
                    <button id="close-modal" class="text-gray-500 hover:text-gray-700">
                        <i class="ri-close-line text-2xl"></i>
                    </button>
                </div>
                
                <div class="p-6">
                    <form id="create-course-form">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-1">
                                <label for="course-title" class="block text-sm font-medium text-gray-700 mb-2">Titre du cours*</label>
                                <input type="text" id="course-title" name="course-title" placeholder="Ex: Modern JavaScript from Scratch" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                            
                            <div class="md:col-span-1">
                                <label for="course-category" class="block text-sm font-medium text-gray-700 mb-2">Catégorie*</label>
                                <select id="course-category" name="course-category" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <option value="">Sélectionner une catégorie</option>
                                    <option value="development">Développement</option>
                                    <option value="business">Business</option>
                                    <option value="design">Design</option>
                                    <option value="marketing">Marketing</option>
                                    <option value="music">Musique</option>
                                    <option value="photography">Photographie</option>
                                </select>
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="course-description" class="block text-sm font-medium text-gray-700 mb-2">Description*</label>
                                <textarea id="course-description" name="course-description" rows="4" placeholder="Donnez une description concise de votre cours..." class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                            </div>
                            
                            <div class="md:col-span-1">
                                <label for="course-price" class="block text-sm font-medium text-gray-700 mb-2">Prix ($)*</label>
                                <input type="number" id="course-price" name="course-price" placeholder="Ex: 89.99" min="0" step="0.01" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                            
                            <div class="md:col-span-1">
                                <label for="course-level" class="block text-sm font-medium text-gray-700 mb-2">Niveau</label>
                                <select id="course-level" name="course-level" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <option value="beginner">Débutant</option>
                                    <option value="intermediate">Intermédiaire</option>
                                    <option value="advanced">Avancé</option>
                                    <option value="all-levels">Tous niveaux</option>
                                </select>
                            </div>
                            
                            <div class="md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Image du cours*</label>
                                <div class="image-preview mb-2">
                                    <div class="text-center">
                                        <i class="ri-image-add-line text-4xl text-gray-400"></i>
                                        <p class="text-sm text-gray-500 mt-2">Cliquez pour ajouter une image</p>
                                    </div>
                                </div>
                                <input type="file" id="course-image" name="course-image" accept="image/*" class="hidden">
                                <button type="button" id="upload-image-btn" class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium flex items-center justify-center">
                                    <i class="ri-upload-cloud-line mr-2"></i> Importer une image
                                </button>
                            </div>
                            
                            <div class="md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Durée estimée</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <input type="number" id="course-hours" name="course-hours" placeholder="Heures" min="0" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <input type="number" id="course-lessons" name="course-lessons" placeholder="Leçons" min="0" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">À propos de ce cours</label>
                                <div class="border border-gray-300 rounded-lg p-4">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Ce que les étudiants apprendront</label>
                                        <div class="space-y-2">
                                            <div class="flex items-center">
                                                <input type="text" placeholder="Ex: Créer des applications web avec JavaScript moderne" class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                                <button type="button" class="ml-2 p-2 text-gray-500 hover:text-gray-700">
                                                    <i class="ri-add-line"></i>
                                                </button>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="text" placeholder="Ajouter un autre objectif d'apprentissage" class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                                <button type="button" class="ml-2 p-2 text-gray-500 hover:text-gray-700">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Prérequis</label>
                                        <div class="space-y-2">
                                            <div class="flex items-center">
                                                <input type="text" placeholder="Ex: Connaissances de base en HTML et CSS" class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                                <button type="button" class="ml-2 p-2 text-gray-500 hover:text-gray-700">
                                                    <i class="ri-add-line"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Contenu du cours</h3>
                            
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4">
                                <div class="flex justify-between items-center">
                                    <h4 class="font-medium text-gray-800">Section 1: Introduction</h4>
                                    <div class="flex items-center">
                                        <button type="button" class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="ri-edit-line"></i>
                                        </button>
                                        <button type="button" class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="mt-3 space-y-2">
                                    <div class="flex items-center py-2 px-3 bg-white rounded border border-gray-200">
                                        <i class="ri-play-circle-line text-indigo-600 mr-2"></i>
                                        <span class="flex-1 text-sm">1. Bienvenue au cours</span>
                                        <span class="text-xs text-gray-500">2:15</span>
                                    </div>
                                    <div class="flex items-center py-2 px-3 bg-white rounded border border-gray-200">
                                        <i class="ri-play-circle-line text-indigo-600 mr-2"></i>
                                        <span class="flex-1 text-sm">2. Configuration de l'environnement</span>
                                        <span class="text-xs text-gray-500">10:30</span>
                                    </div>
                                </div>
                                
                                <button type="button" class="mt-3 text-sm text-indigo-600 font-medium hover:text-indigo-800 flex items-center">
                                    <i class="ri-add-line mr-1"></i> Ajouter une leçon
                                </button>
                            </div>
                            
                            <button type="button" class="text-indigo-600 font-medium hover:text-indigo-800 flex items-center">
                                <i class="ri-add-line mr-1"></i> Ajouter une section
                            </button>
                        </div>
                        
                        <div class="mt-8 border-t border-gray-200 pt-6 flex justify-between">
                            <div>
                                <button type="button" class="px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                                    Enregistrer comme brouillon
                                </button>
                            </div>
                            <div class="flex space-x-4">
                                <button type="button" id="preview-btn" class="px-6 py-3 bg-white border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50 transition-colors font-medium">
                                    Aperçu
                                </button>
                                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                                    Publier le cours
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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
                    &copy; 2025 E-Learning Platform. Tous droits réservés.
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
        
        // Course creation modal
        const createCourseBtn = document.getElementById('create-course-btn');
        const closeModalBtn = document.getElementById('close-modal');
        const createCourseModal = document.getElementById('create-course-modal');
        
        if (createCourseBtn && closeModalBtn && createCourseModal) {
            createCourseBtn.addEventListener('click', () => {
                createCourseModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
            });
            
            closeModalBtn.addEventListener('click', () => {
                createCourseModal.classList.add('hidden');
                document.body.style.overflow = ''; // Re-enable scrolling
            });
            
            // Close modal when clicking outside
            createCourseModal.addEventListener('click', (e) => {
                if (e.target === createCourseModal) {
                    createCourseModal.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
        }
        
        // Image upload preview
        const uploadImageBtn = document.getElementById('upload-image-btn');
        const courseImageInput = document.getElementById('course-image');
        const imagePreview = document.querySelector('.image-preview');
        
        if (uploadImageBtn && courseImageInput && imagePreview) {
            uploadImageBtn.addEventListener('click', () => {
                courseImageInput.click();
            });
            
            courseImageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        imagePreview.innerHTML = `<img src="${e.target.result}" alt="Course Preview">`;
                    }
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
        
        // Animated counters
        const counters = document.querySelectorAll('.counter');
        const counterBoxes = document.querySelectorAll('.counter-box');
        
        // Simple intersection observer to trigger counter animation when visible
        const observerOptions = {
            threshold: 0.1
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    
                    // Start counters within this container
                    const counters = entry.target.querySelectorAll('.counter');
                    counters.forEach(counter => {
                        const target = parseInt(counter.getAttribute('data-target'));
                        const duration = 2000; // milliseconds
                        const increment = target / (duration / 16); // 60fps
                        
                        let currentCount = 0;
                        
                        const updateCount = () => {
                            currentCount += increment;
                            
                            if (currentCount < target) {
                                counter.innerText = Math.floor(currentCount);
                                requestAnimationFrame(updateCount);
                            } else {
                                counter.innerText = target;
                            }
                        };
                        
                        updateCount();
                    });
                    
                    // Unobserve after animation
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        counterBoxes.forEach(box => {
            observer.observe(box);
        });
    </script>
</body>
</html>