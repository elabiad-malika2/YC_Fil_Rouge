@extends('Enseignant.layout')

@section('content')
<style>
.image-preview {
    width: 150px;
    height: 100px;
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
                            <img src="{{ Storage::url($course->image) }}" alt="Course Image" class="w-full h-full object-cover">
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

            <!-- Tags -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Tags</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($tags as $tag)
                        <div class="flex items-center">
                            <input type="checkbox" id="tag_{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}" 
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                {{ $course->tags->contains($tag->id) ? 'checked' : '' }}>
                            <label for="tag_{{ $tag->id }}" class="ml-2 block text-sm text-gray-700">
                                {{ $tag->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('tags')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
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
            <!-- Affichage des erreurs de validation -->
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
            <div id="chapters-container" class="space-y-4">
                @forelse ($course->chapters as $chapterIndex => $chapter)
                    <div class="chapter-card bg-gray-50 rounded-lg border border-gray-200 p-4">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="font-medium text-gray-800">Chapitre {{ $chapterIndex + 1 }} : {{ $chapter->title }}</h4>
                            <div class="flex space-x-2">
                                <button type="button" class="toggle-chapter-btn text-indigo-600 hover:text-indigo-800" data-chapter-id="{{ $chapter->id }}">
                                    <i class="ri-edit-line"></i> Éditer
                                </button>
                                <form action="{{ route('chapters.destroy', $chapter->id) }}" method="POST" class="inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce chapitre ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="ri-delete-bin-line"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="chapter-form hidden">
                            <form action="{{ route('chapters.update', $chapter->id) }}" method="POST" enctype="multipart/form-data">
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
                                                <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" class="inline" onsubmit="return confirm('Voulez-vous vraiment supprimer cette leçon ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                        <i class="ri-delete-bin-line"></i> Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="lesson-form hidden">
                                            <form action="{{ route('lessons.update', $lesson->id) }}" method="POST" enctype="multipart/form-data">
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
                                                    <textarea name="text_content" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" rows="3" required>{{ $lesson->text_content }}</textarea>
                                                </div>
                                                <div class="mb-2 content-type-video {{ $lesson->type == 'video' ? '' : 'hidden' }}">
                                                    <label class="block text-xs font-medium text-gray-700 mb-1">Vidéo <span class="text-red-600">*</span></label>
                                                    <input type="file" name="video" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" accept="video/mp4,video/avi,video/mov">
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
                            <div class="mt-2">
                                <button type="button" class="add-lesson-btn px-3 py-1 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 text-sm flex items-center" data-chapter-id="{{ $chapter->id }}">
                                    <i class="ri-add-line mr-1"></i> Ajouter une leçon
                                </button>
                                <div class="add-lesson-form hidden">
                                    <form method="POST" action="{{ route('lessons.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="chapitres_id" value="{{ $chapter->id }}">
                                        <div class="mb-2">
                                            <label class="block text-xs font-medium text-gray-700 mb-1">Titre de la leçon <span class="text-red-600">*</span></label>
                                            <input type="text" name="title" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" required>
                                            @error('title')
                                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="block text-xs font-medium text-gray-700 mb-1">Type de contenu <span class="text-red-600">*</span></label>
                                            <select name="type" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg content-type-select" required>
                                                <option value="text">Texte</option>
                                                <option value="video">Vidéo</option>
                                            </select>
                                            @error('type')
                                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-2 content-type-text">
                                            <label class="block text-xs font-medium text-gray-700 mb-1">Contenu texte <span class="text-red-600">*</span></label>
                                            <textarea name="text_content" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" rows="3" required></textarea>
                                            @error('text_content')
                                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-2 content-type-video hidden">
                                            <label class="block text-xs font-medium text-gray-700 mb-1">Vidéo <span class="text-red-600">*</span></label>
                                            <input type="file" name="video" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg" accept="video/mp4,video/avi,video/mov">
                                            @error('video')
                                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            @error('chapitres_id')
                                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="flex items-center text-xs text-gray-500 mb-2">
                                            <label class="flex items-center">
                                                <input type="checkbox" name="is_free" class="mr-1 rounded text-indigo-600">
                                                Leçon gratuite (prévisualisation)
                                            </label>
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <button type="button" class="cancel-lesson-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm">Annuler</button>
                                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Créer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Aucun chapitre trouvé.</p>
                @endforelse
            </div>
            <div class="mt-4">
                <button type="button" id="add-chapter-btn" class="px-4 py-2 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 flex items-center space-x-2">
                    <i class="ri-add-line"></i> Ajouter un chapitre
                </button>
                <div id="add-chapter-form" class="hidden mt-2">
                    <form method="POST" action="{{ route('chapters.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Titre du chapitre <span class="text-red-600">*</span></label>
                            <input type="text" name="title" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description du chapitre</label>
                            <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded-lg" rows="2"></textarea>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" id="cancel-add-chapter" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Annuler</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chaptersContainer = document.getElementById('chapters-container');

        // Afficher/Masquer les formulaires des chapitres
        chaptersContainer.addEventListener('click', function (e) {
            const btn = e.target.closest('.toggle-chapter-btn');
            if (btn) {
                const chapterCard = btn.closest('.chapter-card');
                const form = chapterCard.querySelector('.chapter-form');
                form.classList.toggle('hidden');
            }
        });

        chaptersContainer.addEventListener('click', function (e) {
            const btn = e.target.closest('.cancel-chapter-btn');
            if (btn) {
                const chapterCard = btn.closest('.chapter-card');
                const form = chapterCard.querySelector('.chapter-form');
                form.classList.add('hidden');
            }
        });

        // Afficher/Masquer les formulaires des leçons
        chaptersContainer.addEventListener('click', function (e) {
            const btn = e.target.closest('.toggle-lesson-btn');
            if (btn) {
                const lessonCard = btn.closest('.lesson-card');
                const form = lessonCard.querySelector('.lesson-form');
                form.classList.toggle('hidden');
            }
        });

        chaptersContainer.addEventListener('click', function (e) {
            const btn = e.target.closest('.cancel-lesson-btn');
            if (btn) {
                const form = btn.closest('.add-lesson-form') || btn.closest('.lesson-form');
                if (form) {
                    form.classList.add('hidden');
                }
            }
        });

        // Afficher/Masquer les formulaires d'ajout de leçons
        chaptersContainer.addEventListener('click', function (e) {
            const btn = e.target.closest('.add-lesson-btn');
            if (btn) {
                const chapterCard = btn.closest('.chapter-card');
                const form = chapterCard.querySelector('.add-lesson-form');
                if (form) {
                    form.classList.toggle('hidden');
                }
            }
        });

        // Afficher/Masquer le formulaire d'ajout de chapitre
        const addChapterBtn = document.getElementById('add-chapter-btn');
        const addChapterForm = document.getElementById('add-chapter-form');
        const cancelAddChapterBtn = document.getElementById('cancel-add-chapter');

        if (addChapterBtn && addChapterForm) {
            addChapterBtn.addEventListener('click', function () {
                addChapterForm.classList.toggle('hidden');
            });
        }

        if (cancelAddChapterBtn && addChapterForm) {
            cancelAddChapterBtn.addEventListener('click', function () {
                addChapterForm.classList.add('hidden');
            });
        }

        // Basculer entre texte et vidéo
        chaptersContainer.addEventListener('change', function (e) {
            if (e.target.classList.contains('content-type-select')) {
                const select = e.target;
                const lessonCard = select.closest('.lesson-card') || select.closest('.add-lesson-form');
                if (lessonCard) {
                    const textContent = lessonCard.querySelector('.content-type-text');
                    const videoContent = lessonCard.querySelector('.content-type-video');
                    
                    if (textContent && videoContent) {
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
                }
            }
        });
    });
</script>
@endsection