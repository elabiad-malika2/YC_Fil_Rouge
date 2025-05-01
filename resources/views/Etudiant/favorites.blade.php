@extends('Etudiant.layout')

@section('title', 'Mes Cours Favoris - E-Learning')

@section('styles')
    <style>
        .course-image {
            transition: transform 0.3s ease;
        }
        .course-image:hover {
            transform: scale(1.03);
        }
    </style>
@endsection

@section('content')
    <!-- Page Title -->
    <section class="py-12 gradient-bg text-white">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-bold mb-2">Mes Cours Favoris</h1>
            <div class="flex items-center text-sm">
                <a href="{{ route('etudiant.dashboard') }}" class="hover:underline">Accueil</a>
                <span class="mx-2">/</span>
                <a href="{{ route('courses.show') }}" class="hover:underline">Cours</a>
                <span class="mx-2">/</span>
                <span>Mes Favoris</span>
            </div>
        </div>
    </section>

    <!-- Favorites Section -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('info'))
                <div class="bg-blue-100 text-blue-800 p-4 rounded-lg mb-6">
                    {{ session('info') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if($favoriteCourses->isEmpty())
                <div class="glass-card p-8 text-center">
                    <i class="ri-heart-line text-5xl text-gray-400 mb-4"></i>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Vous n'avez pas encore de cours favoris</h2>
                    <p class="text-gray-600 mb-6">Explorez nos cours et ajoutez vos préférés à cette liste pour y accéder facilement.</p>
                    <a href="{{ route('courses.show') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        Découvrir les cours
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($favoriteCourses as $course)
                        <div class="glass-card overflow-hidden">
                            <div class="relative">
                                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-48 object-cover course-image">
                                <div class="absolute top-4 right-4">
                                <form action="{{ route('etudiant.favorites.destroy', $course->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="from_favorites" value="true">
                                    <button type="submit" class="bg-white p-2 rounded-full shadow-md hover:bg-red-50 transition-colors">
                                        <i class="ri-heart-fill text-red-500 text-xl"></i>
                                    </button>
                                </form>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-2">
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs font-medium rounded-full">
                                        {{ $course->category->name }}
                                    </span>
                                    <span class="ml-2 text-sm text-gray-500">
                                        {{ $course->chapters->sum(function ($chapter) { return $chapter->lessons->count(); }) }} leçons
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $course->title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $course->description }}</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img src="{{ $course->user->image ? Storage::url($course->user->image) : 'https://cdn-icons-png.flaticon.com/512/219/219969.png' }}" alt="{{ $course->user->name }}" class="w-8 h-8 rounded-full mr-2">
                                        <span class="text-sm text-gray-700">{{ $course->user->name }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-indigo-600 font-bold">€{{ number_format($course->price, 2) }}</span>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <a href="{{ route('courses.details', $course->id) }}" class="block w-full py-3 bg-indigo-600 text-white rounded-lg text-center hover:bg-indigo-700 transition-colors">
                                        Voir le cours
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection