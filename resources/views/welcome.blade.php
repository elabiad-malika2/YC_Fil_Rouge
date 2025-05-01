@extends('Etudiant.layout')

@section('title', 'E-Learning Platform - Accueil')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gray-50">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-full h-64 bg-gradient-to-t from-indigo-50 to-transparent"></div>

        <div class="container mx-auto px-6 py-12 md:py-20 lg:py-24">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="w-full md:w-1/2 z-10">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-800 mb-6">
                        Apprenez Sans <span class="text-indigo-600">Limites</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8">
                        Débloquez votre potentiel avec nos cours dirigés par des experts. Apprentissage à tout moment, partout.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <a href="#courses-container" class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium text-center">
                            Explorer les Cours
                        </a>
                    </div>
                </div>
                <div class="w-full md:w-1/2 z-10">
                    <div class="relative">
                        <div class="absolute -top-5 -right-5 w-32 h-32 bg-indigo-100 rounded-full"></div>
                        <div class="absolute -bottom-5 -left-5 w-24 h-24 bg-purple-100 rounded-full"></div>
                        <div class="glass-card p-8 rounded-2xl shadow-xl">
                            <div class="flex flex-col items-center text-center">
                                <div class="w-24 h-24 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                                    <i class="ri-book-open-line text-5xl text-indigo-600"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-4">Apprentissage en Ligne</h3>
                                <p class="text-gray-600 mb-6">Accédez à des cours de qualité depuis le confort de votre maison</p>
                                <div class="flex items-center justify-center space-x-6">
                                    <div class="flex items-center space-x-2">
                                        <i class="ri-video-line text-xl text-indigo-600"></i>
                                        <span class="text-gray-600">Cours Vidéo</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <i class="ri-heart-line text-xl text-indigo-600"></i>
                                        <span class="text-gray-600">Favoris</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <i class="ri-user-voice-line text-xl text-indigo-600"></i>
                                        <span class="text-gray-600">Enseignants</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Nos Catégories</h2>
                <p class="text-gray-600">Choisissez votre domaine d'apprentissage</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 max-w-6xl mx-auto">
                @foreach($categories as $category)
                <a  class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-indigo-50 transition-colors duration-200">
                    <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center mb-3">
                        <i class="ri-book-line text-xl text-indigo-600"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700 text-center">{{ $category->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Courses -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Cours</h2>
                    <p class="text-lg text-gray-600">
                        Développez vos compétences avec nos cours 
                    </p>
                </div>
                <div class="mt-6 md:mt-0 flex items-center space-x-4">
                    <div class="relative w-full max-w-md">
                        <input type="text" id="search" placeholder="Rechercher par titre ou enseignant..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <i class="ri-search-line absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <a href="{{ route('courses.show') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                        Parcourir Tous les Cours
                    </a>
                </div>
            </div>

            <div id="courses-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Les cours seront insérés ici par JavaScript -->
            </div>

            <!-- Pagination -->
            <div id="pagination" class="flex justify-center space-x-2 mt-10">
                <!-- Les boutons de pagination seront insérés ici par JavaScript -->
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50 relative overflow-hidden">
        <div class="absolute top-1/3 -right-24 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
        <div class="absolute bottom-1/3 -left-24 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>

        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Pourquoi Choisir Notre Plateforme</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Nous offrons une expérience d'apprentissage complète conçue pour vous aider à atteindre vos objectifs
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                <div class="feature-card p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="bg-indigo-100 w-14 h-14 rounded-full flex items-center justify-center mb-6">
                        <i class="ri-device-line text-2xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Apprenez Partout</h3>
                    <p class="text-gray-600">
                        Accédez à notre plateforme depuis n'importe quel appareil avec notre design réactif et notre application mobile dédiée
                    </p>
                </div>

                <div class="feature-card p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="bg-blue-100 w-14 h-14 rounded-full flex items-center justify-center mb-6">
                        <i class="ri-user-voice-line text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Instructeurs Experts</h3>
                    <p class="text-gray-600">
                        Apprenez auprès de professionnels de l'industrie avec une expérience réelle et des méthodes d'enseignement éprouvées
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const coursesContainer = document.getElementById('courses-container');
            const paginationContainer = document.getElementById('pagination');
            const searchInput = document.getElementById('search');
            let currentPage = 1;
            let searchQuery = '';

            // Fonction pour récupérer les cours
            async function fetchCourses(page = 1, search = '') {
                const url = new URL('{{ route('api.courses.show') }}');
                url.searchParams.append('page', page);
                if (search) {
                    url.searchParams.append('search', search);
                }

                try {
                    coursesContainer.innerHTML = '<div class="col-span-full text-center"><i class="ri-loader-4-line text-2xl text-indigo-600 animate-spin"></i></div>';
                    const response = await fetch(url);
                    const data = await response.json();

                    // Afficher les cours
                    displayCourses(data.courses);

                    // Afficher la pagination
                    displayPagination(data.pagination);
                } catch (error) {
                    console.error('Erreur lors de la récupération des cours:', error);
                    coursesContainer.innerHTML = '<p class="text-red-600 col-span-full text-center">Erreur lors du chargement des cours.</p>';
                }
            }

            // Afficher les cours dans le DOM
            function displayCourses(courses) {
                coursesContainer.innerHTML = '';
                if (courses.length === 0) {
                    coursesContainer.innerHTML = '<p class="text-gray-500 col-span-full text-center">Aucun cours trouvé.</p>';
                    return;
                }

                courses.forEach(course => {
                    const courseCard = document.createElement('div');
                    courseCard.className = 'course-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100';
                    courseCard.innerHTML = `
                    <div class="relative">
                        <img src="${course.image_url}" alt="${course.title}" class="w-full h-56 object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="bg-indigo-600 text-white text-xs font-medium px-3 py-1 rounded-full">${course.level}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">${course.category.name}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">${course.title}</h3>
                        <p class="text-gray-600 mb-4">${course.description.substring(0, 100)}${course.description.length > 100 ? '...' : ''}</p>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <div class="flex items-center mr-4">
                                <i class="ri-time-line mr-2"></i>
                                <span>${course.chapters.reduce((total, chapter) => total + chapter.lessons.length, 0)} heures</span>
                            </div>
                            <div class="flex items-center">
                                <i class="ri-file-list-3-line mr-2"></i>
                                <span>${course.chapters.length} leçons</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center">
                                <img src="${course.teacher_photo}" alt="${course.teacher_name}" class="teacher-photo mr-2">
                                <span class="text-sm font-medium text-gray-700">${course.teacher_name}</span>
                            </div>
                            <span class="text-xl font-bold text-gray-800">€${course.price}</span>
                        </div>
                        <div class="mt-4 space-y-2">
                            ${@json(Auth::check() && Auth::user()->role->name === 'etudiant') ? `
                                <a href="/courses/${course.id}" class="block w-full px-6 py-2 bg-indigo-600 text-white rounded-lg text-center hover:bg-indigo-700 transition-colors font-medium">Voir les détails</a>
                                ${course.is_favorited ? `
                                    <form action="/etudiant/courses/${course.id}/favorite" method="POST" class="favorite-form">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="w-full px-6 py-2 bg-red-50 text-red-600 rounded-lg text-center hover:bg-red-100 transition-colors font-medium flex items-center justify-center">
                                            <i class="ri-heart-fill mr-2"></i>
                                            Retirer des favoris
                                        </button>
                                    </form>
                                ` : `
                                    <form action="/etudiant/courses/${course.id}/favorite" method="POST" class="favorite-form">
                                        @csrf
                                        <button type="submit" class="w-full px-6 py-2 bg-gray-50 text-gray-600 rounded-lg text-center hover:bg-gray-100 transition-colors font-medium flex items-center justify-center">
                                            <i class="ri-heart-line mr-2"></i>
                                            Ajouter aux favoris
                                        </button>
                                    </form>
                                `}
                            ` : `<p class="text-sm text-gray-500 text-center">Connectez-vous en tant qu'étudiant pour voir les détails.</p>`}
                        </div>
                    </div>
                `;
                    coursesContainer.appendChild(courseCard);
                });
            }

            // Afficher la pagination dans le DOM
            function displayPagination(pagination) {
                paginationContainer.innerHTML = '';

                // Bouton "Précédent"
                const prevButton = document.createElement('button');
                prevButton.className = `px-4 py-2 rounded-lg ${pagination.current_page === 1 ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'bg-indigo-100 text-indigo-600 hover:bg-indigo-200'}`;
                prevButton.innerHTML = '<i class="ri-arrow-left-line"></i>';
                prevButton.disabled = pagination.current_page === 1;
                prevButton.addEventListener('click', () => {
                    if (pagination.current_page > 1) {
                        currentPage = pagination.current_page - 1;
                        fetchCourses(currentPage, searchQuery);
                    }
                });
                paginationContainer.appendChild(prevButton);

                // Boutons de page
                for (let i = 1; i <= pagination.last_page; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.className = `px-4 py-2 rounded-lg ${i === pagination.current_page ? 'bg-indigo-600 text-white' : 'bg-indigo-100 text-indigo-600 hover:bg-indigo-200'}`;
                    pageButton.textContent = i;
                    pageButton.addEventListener('click', () => {
                        currentPage = i;
                        fetchCourses(currentPage, searchQuery);
                    });
                    paginationContainer.appendChild(pageButton);
                }

                // Bouton "Suivant"
                const nextButton = document.createElement('button');
                nextButton.className = `px-4 py-2 rounded-lg ${pagination.current_page === pagination.last_page ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'bg-indigo-100 text-indigo-600 hover:bg-indigo-200'}`;
                nextButton.innerHTML = '<i class="ri-arrow-right-line"></i>';
                nextButton.disabled = pagination.current_page === pagination.last_page;
                nextButton.addEventListener('click', () => {
                    if (pagination.current_page < pagination.last_page) {
                        currentPage = pagination.current_page + 1;
                        fetchCourses(currentPage, searchQuery);
                    }
                });
                paginationContainer.appendChild(nextButton);
            }

            // Événement de recherche avec debounce
            let timeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    searchQuery = this.value.trim();
                    currentPage = 1;
                    fetchCourses(currentPage, searchQuery);
                }, 300);
            });

            // Charger les cours initiaux
            fetchCourses(currentPage, searchQuery);
        });

        // Gestion des favoris
        document.addEventListener('submit', function(e) {
            if (e.target.classList.contains('favorite-form')) {
                e.preventDefault();

                const form = e.target;
                const button = form.querySelector('button');
                const originalText = button.innerHTML;
                button.disabled = true;
                button.innerHTML = '<i class="ri-loader-4-line animate-spin mr-2"></i>Chargement...';

                // Récupérer le token CSRF
                const csrfToken = form.querySelector('input[name="_token"]').value;

                // Déterminer si c'est une action d'ajout ou de suppression
                const isRemoving = form.querySelector('input[name="_method"]') !== null;

                // Préparer les données de la requête
                const formData = new FormData();
                formData.append('_token', csrfToken);
                if (isRemoving) {
                    formData.append('_method', 'DELETE');
                }

                // Envoyer la requête
                fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erreur réseau');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Recharger la page pour refléter les changements
                            window.location.reload();
                        } else {
                            throw new Error(data.message || 'Une erreur est survenue');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        button.disabled = false;
                        button.innerHTML = originalText;
                        alert('Une erreur est survenue lors de l\'action sur les favoris');
                    });
            }
        });
    </script>
@endsection