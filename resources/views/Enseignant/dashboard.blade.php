@extends('Enseignant.layout')

@section('title', 'Mes Cours')

@section('styles')
    <style>
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
@endsection

@section('content')
    <!-- Background Patterns -->
    <div class="absolute -top-24 -right-24 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    <div class="absolute top-1/4 -left-24 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    <div class="absolute bottom-1/4 right-12 w-80 h-80 bg-pink-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    
    <div class="container mx-auto px-6 py-12 md:py-20 relative z-10">
        <div class="flex flex-col items-center justify-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Mes <span class="text-indigo-600">Cours</span></h1>
            <p class="text-lg text-gray-600 text-center max-w-2xl">Gérez vos cours et créez du contenu éducatif engageant pour vos étudiants.</p>
        </div>
        
        <!-- Welcome Banner -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Bonjour, {{ Auth::user()->name }} 👋</h1>
                    <p class="text-gray-600">Créez et gérez vos cours en toute simplicité.</p>
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="dashboard-stat-card bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center mr-4">
                        <i class="ri-book-open-line text-2xl text-indigo-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Cours actifs</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $activeCoursesCount }}</h3>
                    </div>
                </div>
            </div>

            <div class="dashboard-stat-card bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                        <i class="ri-user-line text-2xl text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Étudiants inscrits</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $enrolledStudentsCount }}</h3>
                    </div>
                </div>
            </div>

            <div class="dashboard-stat-card bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mr-4">
                        <i class="ri-coin-line text-2xl text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Revenus</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ number_format($totalRevenue, 2) }} €</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg max-w-3xl mx-auto">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg max-w-3xl mx-auto">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Recent Courses -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Vos cours récents</h2>
            </div>
            
            <div class="space-y-4">
                @forelse ($courses as $course)
                    <div class="course-card flex items-center p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                        <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-16 h-16 object-cover rounded mr-4">
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-800">{{ $course->title }}</h3>
                            <div class="flex items-center mt-1">
                                <span class="text-sm text-gray-500 mr-4">
                                    {{ $course->chapitres_count }} chapitre{{ $course->chapitres_count > 1 ? 's' : '' }} • {{ $course->lessons_count }} leçon{{ $course->lessons_count > 1 ? 's' : '' }}
                                </span>
                                <div class="flex items-center">
                                    <i class="ri-user-line text-gray-400 mr-1"></i>
                                    <span class="text-sm text-gray-500">{{ $course->students_count ?? 0 }} étudiant{{ ($course->students_count ?? 0) > 1 ? 's' : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="ml-4 flex items-center space-x-2">
                            <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                {{ ucfirst($course->level) }}
                            </span>
                            <!-- Bouton Modifier -->
                            <a href="{{ route('enseignant.courses.edit', $course->id) }}" class="text-indigo-600 hover:text-indigo-800" title="Modifier">
                                <i class="ri-edit-line text-lg"></i>
                            </a>
                            <!-- Bouton Supprimer -->
                            <form action="{{ route('enseignant.courses.destroy', $course->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" title="Supprimer">
                                    <i class="ri-delete-bin-line text-lg"></i>
                                </button>
                            </form>
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

    <!-- Formulaire d'ajout de cours - Modal -->
    <div id="create-course-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden overflow-y-auto">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-4xl relative">
                <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data" class="p-6">
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
                                <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors" placeholder="Entrez un titre accrocheur" required>
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-600">*</span></label>
                                <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors" placeholder="Décrivez votre cours en détail" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Catégorie -->
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Catégorie <span class="text-red-600">*</span></label>
                                <select id="category_id" name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors" required>
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Prix -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Prix (en €) <span class="text-red-600">*</span></label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">€</span>
                                    <input type="number" id="price" name="price" min="0" step="0.01" value="{{ old('price') }}" class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors" placeholder="19.99" required>
                                </div>
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Niveau -->
                            <div>
                                <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Niveau <span class="text-red-600">*</span></label>
                                <select id="level" name="level" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors" required>
                                    <option value="">Sélectionnez un niveau</option>
                                    <option value="debutant" {{ old('level') == 'debutant' ? 'selected' : '' }}>Débutant</option>
                                    <option value="intermediaire" {{ old('level') == 'intermediaire' ? 'selected' : '' }}>Intermédiaire</option>
                                    <option value="avance" {{ old('level') == 'avance' ? 'selected' : '' }}>Avancé</option>
                                    <option value="expert" {{ old('level') == 'expert' ? 'selected' : '' }}>Expert</option>
                                </select>
                                @error('level')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tags -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Tags</label>
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                                    @foreach($tags as $tag)
                                        <label class="relative flex items-center p-3 rounded-lg border border-gray-200 hover:border-indigo-500 transition-colors cursor-pointer">
                                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                            <span class="ml-3 text-sm font-medium" style="color: {{ $tag->color }};">
                                                {{ $tag->name }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('tags')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
@endsection

@section('scripts')
    <script>
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
                        <input type="file" name="chapitres[${chapterIndex}][lessons][${chapterIndex}][video]" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" accept="video/*">
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
@endsection