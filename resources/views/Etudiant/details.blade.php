@extends('Etudiant.layout')

@section('title', '{{ $course->title }} - Détails du Cours')

@section('styles')
    <style>
        .chapter-card {
            transition: all 0.3s ease;
        }
        .chapter-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .lesson-item {
            transition: background-color 0.2s ease;
        }
        .lesson-item:hover {
            background-color: #f1f5f9;
        }
        .accordion-toggle:checked + .accordion-content {
            max-height: 500px;
            opacity: 1;
            padding: 1rem;
        }
        .accordion-content {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }
    </style>
@endsection

@section('content')
    <section class="relative py-12 bg-gray-50">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-full h-64 bg-gradient-to-t from-indigo-50 to-transparent"></div>

        <div class="container mx-auto px-6">
            <!-- Notifications -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Quiz Results -->
            @if ($isEnrolled && $quizResult)
                <div class="glass-card p-6 rounded-2xl mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Résultat du Quiz</h2>
                    <p class="text-gray-600 mb-4">
                        Score : {{ $quizResult->score }} / {{ $quizResult->total_points }}
                        ({{ number_format(($quizResult->score / $quizResult->total_points) * 100, 2) }}%)
                    </p>
                    <p class="text-gray-600 mb-4">
                        Statut : 
                        <span class="{{ $quizResult->status === 'passed' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $quizResult->status === 'passed' ? 'Réussi' : 'Échoué' }}
                        </span>
                    </p>
                    <div class="flex space-x-4">
                        <a href="{{ route('quizzes.results', ['id' => $course->quiz->id]) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            Voir les détails
                        </a>
                        @if($quizResult->status === 'failed')
                            <a href="{{ route('quizzes.show', ['id' => $course->quiz->id]) }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                                Repasser le quiz
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Course Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Course Details -->
                <div class="lg:col-span-2">
                    <div class="glass-card p-6 rounded-2xl">
                        <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-64 object-cover rounded-lg mb-6">
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $course->title }}</h1>
                        <p class="text-gray-600 mb-6">{{ $course->description }}</p>
                        <div class="flex items-center mb-6">
                            <img src="{{ $course->teacher_photo }}" alt="{{ $course->teacher_name }}" class="w-12 h-12 rounded-full mr-3">
                            <div>
                                <span class="text-gray-700 font-medium">{{ $course->teacher_name }}</span>
                                <p class="text-sm text-gray-500">Instructeur</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-6 text-sm text-gray-600 mb-6">
                            <div class="flex items-center">
                                <i class="ri-bookmark-line mr-2"></i>
                                <span>{{ $course->category->name }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="ri-time-line mr-2"></i>
                                <span>{{ $course->chapters->sum(function ($chapter) { return $chapter->lessons->count(); }) }} leçons</span>
                            </div>
                            <div class="flex items-center">
                                <i class="ri-wallet-line mr-2"></i>
                                <span>€{{ number_format($course->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enrollment Card -->
                <div class="lg:col-span-1">
                    <div class="glass-card p-6 rounded-2xl sticky top-24">
                        @if ($isEnrolled)
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Vous êtes inscrit !</h3>
                            <p class="text-gray-600 mb-6">Vous avez un accès complet à tout le contenu du cours. Commencez à apprendre maintenant !</p>
                            <a href="#course-content" class="block w-full py-3 bg-indigo-600 text-white rounded-lg text-center hover:bg-indigo-700 transition-colors font-medium mb-3">
                                Voir le Contenu
                            </a>
                            @if ($course->quiz && !$quizResult)
                                <a href="{{ route('quizzes.show', $course->quiz->id) }}" class="block w-full py-3 bg-green-600 text-white rounded-lg text-center hover:bg-green-700 transition-colors font-medium">
                                    Passer le quiz
                                </a>
                            @endif
                        @else
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Inscrivez-vous à ce Cours</h3>
                            <p class="text-gray-600 mb-6">Débloquez tous les chapitres et leçons pour seulement €{{ number_format($course->price, 2) }}.</p>
                            @if (Auth::check() && Auth::user()->role->name === 'etudiant')
                                <div class="space-y-3">
                                    <a href="{{ route('payment.show', $course->id) }}" class="block w-full py-3 bg-indigo-600 text-white rounded-lg text-center hover:bg-indigo-700 transition-colors font-medium">
                                        S'inscrire Maintenant (€{{ number_format($course->price, 2) }})
                                    </a>
                                    @if(Auth::user()->hasFavorited($course))
                                        <form action="{{ route('favorites.destroy', $course->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full py-3 bg-red-50 text-red-600 rounded-lg text-center hover:bg-red-100 transition-colors font-medium flex items-center justify-center">
                                                <i class="ri-heart-fill mr-2"></i>
                                                Retirer des favoris
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('favorites.store', $course->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full py-3 bg-gray-50 text-gray-600 rounded-lg text-center hover:bg-gray-100 transition-colors font-medium flex items-center justify-center">
                                                <i class="ri-heart-line mr-2"></i>
                                                Ajouter aux favoris
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @else
                                <p class="text-gray-500 mb-4">Veuillez vous connecter en tant qu'étudiant pour vous inscrire.</p>
                                <a href="{{ route('login') }}" class="block w-full py-3 bg-gray-200 text-gray-700 rounded-lg text-center hover:bg-gray-300 transition-colors font-medium">
                                    Se Connecter
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Course Content -->
            <div id="course-content" class="mt-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Contenu du Cours</h2>
                @if ($isEnrolled)
                    <!-- Full Content for Enrolled Users -->
                    <div class="space-y-4">
                        @forelse ($course->chapters as $chapter)
                            <div class="chapter-card glass-card rounded-xl overflow-hidden">
                                <label class="block cursor-pointer">
                                    <input type="checkbox" class="accordion-toggle hidden">
                                    <div class="flex items-center justify-between p-4 bg-indigo-50">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-800">{{ $chapter->title }}</h3>
                                            <p class="text-sm text-gray-500">{{ $chapter->lessons->count() }} leçons</p>
                                        </div>
                                        <i class="ri-arrow-down-s-line text-2xl text-indigo-600 transition-transform accordion-toggle:checked:rotate-180"></i>
                                    </div>
                                    <div class="accordion-content">
                                        <ul class="space-y-2">
                                            @foreach ($chapter->lessons as $lesson)
                                                <li class="lesson-item p-3 rounded-lg flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <i class="ri-play-circle-line text-indigo-600 mr-2"></i>
                                                        <span class="text-gray-700">{{ $lesson->title }}</span>
                                                    </div>
                                                    <span class="text-sm text-gray-500">Leçon {{ $loop->iteration }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </label>
                            </div>
                        @empty
                            <p class="text-gray-500">Aucun chapitre disponible pour ce cours.</p>
                        @endforelse
                    </div>
                @else
                    <!-- Partial Content for Non-Enrolled Users -->
                    <div class="glass-card p-6 rounded-xl">
                        <p class="text-gray-600 mb-4">Ce cours comprend {{ $course->chapters->count() }} chapitres et {{ $course->chapters->sum(function ($chapter) { return $chapter->lessons->count(); }) }} leçons.</p>
                        <ul class="space-y-2 mb-6">
                            @foreach ($course->chapters as $chapter)
                                <li class="flex items-center">
                                    <i class="ri-lock-line text-indigo-600 mr-2"></i>
                                    <span class="text-gray-700">{{ $chapter->title }} ({{ $chapter->lessons->count() }} leçons)</span>
                                </li>
                            @endforeach
                        </ul>
                        <p class="text-gray-500">Inscrivez-vous maintenant pour débloquer tous les chapitres et leçons.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection