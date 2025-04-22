<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditer le cours - E-Learning</title>
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
        
        .chapter-card, .lesson-card {
            transition: all 0.3s ease;
        }
        
        .chapter-card:hover, .lesson-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
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
                    <a href="./dashboard.php" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Tableau de bord</a>
                    <a href="./courses.php" class="text-indigo-600 hover:text-indigo-800 transition-colors font-medium">Mes cours</a>
                    <a href="./students.php" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Étudiants</a>
                    <a href="./settings.php" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Paramètres</a>
                </nav>
                
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="p-2 rounded-full text-gray-500 hover:bg-gray-100 relative">
                            <i class="ri-notification-3-line text-xl"></i>
                            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                        </button>
                    </div>
                    
                    <div class="relative">
                        <button class="flex items-center space-x-2 focus:outline-none">
                            <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="User" class="w-9 h-9 rounded-full border-2 border-indigo-200">
                            <span class="hidden md:block text-sm font-medium text-gray-700">John Doe</span>
                        </button>
                    </div>
                    
                    <button id="mobile-menu-btn" class="p-2 rounded-full text-gray-500 hover:bg-gray-100 md:hidden">
                        <i class="ri-menu-line text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-3 border-b">
        <div class="container mx-auto px-6">
            <div class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="./dashboard.php" class="hover:text-indigo-600">Tableau de bord</a>
                <i class="ri-arrow-right-s-line"></i>
                <a href="./courses.php" class="hover:text-indigo-600">Mes cours</a>
                <i class="ri-arrow-right-s-line"></i>
                <span class="text-gray-800 font-medium">Éditer le cours</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Éditer le cours : {{ $course->title }}</h1>
            
            <!-- Formulaire pour les informations générales du cours -->
            <form method="POST" action="{{ route('courses.update', $course->id) }}" enctype="multipart/form-data" class="mb-8">
                @csrf
                @method('PUT')
                
                <!-- Informations générales -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Informations générales</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Titre -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre du cours <span class="text-red-600">*</span></label>
                            <input type="text" id="title" name="title" value="{{ $course->title }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                        </div>
                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-600">*</span></label>
                            <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>{{ $course->description }}</textarea>
                        </div>
                        <!-- Image -->
                        <div class="md:col-span-2">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image du cours</label>
                            <div class="image-preview mb-2">
                                <img src="{{ Storage::url($course->image) }}" alt="Course Image">
                            </div>
                            <input type="file" id="image" name="image" class="w-full px-4 py-2 border border-gray-300 rounded-lg" accept="image/*">
                        </div>
                        <!-- Catégorie -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Catégorie <span class="text-red-600">*</span></label>
                            <select id="category_id" name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Prix -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Prix (en €) <span class="text-red-600">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">€</span>
                                <input type="number" id="price" name="price" value="{{ $course->price }}" min="0" step="0.01" class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                            </div>
                        </div>
                        <!-- Niveau -->
                        <div>
                            <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Niveau <span class="text-red-600">*</span></label>
                            <select id="level" name="level" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                                <option value="debutant" {{ $course->level == 'debutant' ? 'selected' : '' }}>Débutant</option>
                                <option value="intermediaire" {{ $course->level == 'intermediaire' ? 'selected' : '' }}>Intermédiaire</option>
                                <option value="avance" {{ $course->level == 'avance' ? 'selected' : '' }}>Avancé</option>
                                <option value="expert" {{ $course->level == 'expert' ? 'selected' : '' }}>Expert</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Boutons -->
                <div class="flex justify-end space-x-3">
                    <a href="./courses.php" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Annuler</a>
                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all shadow-md hover:shadow-lg">
                        <i class="ri-save-line mr-1"></i> Mettre à jour
                    </button>
                </div>
            </form>

            <!-- Chapitres -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Chapitres et leçons</h3>
                <div id="chapters-container" class="space-y-4">
                    @forelse ($course->chapters as $chapterIndex => $chapter)
                        <div class="chapter-card bg-gray-50 rounded-lg border border-gray-200 p-4">
                            <div class="flex justify-between items-center mb-3">
                                <h4 class="font-medium text-gray-800">Chapitre {{ $chapterIndex + 1 }} : {{ $chapter->title }}</h4>
                                <div class="flex space-x-2">
                                    <button type="button" class="toggle-chapter-btn text-indigo-600 hover:text-indigo-800" data-chapter-id="{{ $chapter->id }}">
                                        <i class="ri-edit-line"></i> Éditer
                                    </button>
                                    <form action="" method="POST" class="inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce chapitre ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="ri-delete-bin-line"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="chapter-form hidden">
                                <form action="/enseignant/chapters/{{ $chapter->id }}" method="POST"  enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Titre du chapitre <span class="text-red-600">*</span></label>
                                        <input type="text" name="title" value="{{ $chapter->title }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Description du chapitre</label>
                                        <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded-lg" rows="2">{{ $chapter->description }}</textarea>
                                    </div>
                                    <div class="flex justify-end space-x-2 mt-4">
                                        <button type="button" class="cancel-chapter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Annuler</button>
                                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Mettre à jour</button>
                                    </div>
                                </form>
                            </div>
                            <div class="pl-4 border-l-2 border-indigo-100 mt-4">
                                <h5 class="font-medium text-gray-700 mb-2">Leçons</h5>
                                <div class="lessons-container space-y-2">
                                    @foreach ($chapter->lessons as $lessonIndex => $lesson)
                                        <div class="lesson-card bg-white rounded border border-gray-200 p-3 relative">
                                            <div class="flex justify-between items-center mb-2">
                                                <h6 class="font-medium text-sm text-gray-700">Leçon {{ $lessonIndex + 1 }} : {{ $lesson->title }}</h6>
                                                <div class="flex space-x-2">
                                                    <button type="button" class="toggle-lesson-btn text-indigo-600 hover:text-indigo-800" data-lesson-id="{{ $lesson->id }}">
                                                        <i class="ri-edit-line"></i> Éditer
                                                    </button>
                                                    <form action="" method="POST" class="inline" onsubmit="return confirm('Voulez-vous vraiment supprimer cette leçon ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                                            <i class="ri-delete-bin-line"></i> Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="lesson-form hidden">
                                                <form method="POST" action="" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-2">
                                                        <label class="block text-xs font-medium text-gray-700 mb-1">Titre de la leçon <span class="text-red-600">*</span></label>
                                                        <input type="text" name="title" value="{{ $lesson->title }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="block text-xs font-medium text-gray-700 mb-1">Type de contenu <span class="text-red-600">*</span></label>
                                                        <select name="type" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg content-type-select" required>
                                                            <option value="text" {{ $lesson->type == 'text' ? 'selected' : '' }}>Texte</option>
                                                            <option value="video" {{ $lesson->type == 'video' ? 'selected' : '' }}>Vidéo</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-2 content-type-text {{ $lesson->type == 'text' ? '' : 'hidden' }}">
                                                        <label class="block text-xs font-medium text-gray-700 mb-1">Contenu texte <span class="text-red-600">*</span></label>
                                                        <textarea name="text_content" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" rows="3">{{ $lesson->text_content }}</textarea>
                                                    </div>
                                                    <div class="mb-2 content-type-video {{ $lesson->type == 'video' ? '' : 'hidden' }}">
                                                        <label class="block text-xs font-medium text-gray-700 mb-1">Vidéo</label>
                                                        <input type="file" name="video" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" accept="video/*">
                                                    </div>
                                                    <div class="flex items-center text-xs text-gray-500 mb-2">
                                                        <label class="flex items-center">
                                                            <input type="checkbox" name="is_free" class="mr-1 rounded text-indigo-600" {{ $lesson->is_free ? 'checked' : '' }}>
                                                            Leçon gratuite (prévisualisation)
                                                        </label>
                                                    </div>
                                                    <div class="flex justify-end space-x-2">
                                                        <button type="button" class="cancel-lesson-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm">Annuler</button>
                                                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Mettre à jour</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <form method="POST" action="" enctype="multipart/form-data" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="chapter_id" value="{{ $chapter->id }}">
                                    <button type="submit" class="add-lesson-btn px-3 py-1 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 text-sm flex items-center">
                                        <i class="ri-add-line mr-1"></i> Ajouter une leçon
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Aucun chapitre trouvé.</p>
                    @endforelse
                </div>
                <form method="POST" action="" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <button type="submit" id="add-chapter-btn" class="px-4 py-2 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 flex items-center space-x-2">
                        <i class="ri-add-line"></i> Ajouter un chapitre
                    </button>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 py-8 mt-12">
        <div class="container mx-auto px-6">
            <div class="border_tolkit border-gray-200 pt-6">
                <p class="text-center text-gray-600 text-sm">
                    © 2025 E-Learning Platform. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chaptersContainer = document.getElementById('chapters-container');

            // Afficher/Masquer les formulaires des chapitres
            chaptersContainer.addEventListener('click', function (e) {
                if (e.target.closest('.toggle-chapter-btn')) {
                    const btn = e.target.closest('.toggle-chapter-btn');
                    const chapterCard = btn.closest('.chapter-card');
                    const form = chapterCard.querySelector('.chapter-form');
                    form.classList.toggle('hidden');
                }
                if (e.target.closest('.cancel-chapter-btn')) {
                    const btn = e.target.closest('.cancel-chapter-btn');
                    const chapterCard = btn.closest('.chapter-card');
                    const form = chapterCard.querySelector('.chapter-form');
                    form.classList.add('hidden');
                }
            });

            // Afficher/Masquer les formulaires des leçons
            chaptersContainer.addEventListener('click', function (e) {
                if (e.target.closest('.toggle-lesson-btn')) {
                    const btn = e.target.closest('.toggle-lesson-btn');
                    const lessonCard = btn.closest('.lesson-card');
                    const form = lessonCard.querySelector('.lesson-form');
                    form.classList.toggle('hidden');
                }
                if (e.target.closest('.cancel-lesson-btn')) {
                    const btn = e.target.closest('.cancel-lesson-btn');
                    const lessonCard = btn.closest('.lesson-card');
                    const form = lessonCard.querySelector('.lesson-form');
                    form.classList.add('hidden');
                }
            });

            // Basculer entre texte et vidéo
            chaptersContainer.addEventListener('change', function (e) {
                if (e.target.classList.contains('content-type-select')) {
                    const select = e.target;
                    const lessonCard = select.closest('.lesson-card');
                    const textContent = lessonCard.querySelector('.content-type-text');
                    const videoContent = lessonCard.querySelector('.content-type-video');
                    
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
            });
        });
    </script>
</body>
</html>