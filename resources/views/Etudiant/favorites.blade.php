@extends('Etudiant.layout')

@section('title', 'Mes Cours Favoris - E-Learning')

@section('styles')
    <style>
        .course-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .course-image {
            transition: transform 0.3s ease;
        }
        .course-image:hover {
            transform: scale(1.05);
        }
        .favorite-btn {
            transition: all 0.3s ease;
        }
        .favorite-btn:hover {
            transform: scale(1.1);
            background-color: rgba(239, 68, 68, 0.1);
        }
        .empty-state {
            background: linear-gradient(135deg, #f6f7fb 0%, #f0f2f5 100%);
        }
        .page-header {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }
        .page-header-content {
            position: relative;
        }
        .page-header-content::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, #e5e7eb, transparent);
        }
    </style>
@endsection

@section('content')
    <!-- Page Header -->
    <section class="page-header py-12">
        <div class="container mx-auto px-6">
            <div class="page-header-content">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div class="mb-6 md:mb-0">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center">
                                <i class="ri-heart-line text-2xl text-blue-600"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-800">Mes Cours Favoris</h1>
                               
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-50 rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="ri-book-mark-line text-xl text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Total des cours</p>
                                    <p class="text-xl font-bold text-gray-800">{{ $favoriteCourses->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Favorites Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg mb-6">
                    <div class="flex items-center">
                        <i class="ri-checkbox-circle-fill text-green-500 text-xl mr-2"></i>
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            @if (session('info'))
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-6">
                    <div class="flex items-center">
                        <i class="ri-information-line text-blue-500 text-xl mr-2"></i>
                        <p class="text-blue-700">{{ session('info') }}</p>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-6">
                    <div class="flex items-center">
                        <i class="ri-error-warning-line text-red-500 text-xl mr-2"></i>
                        <p class="text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @if($favoriteCourses->isEmpty())
                <div class="empty-state p-12 rounded-2xl text-center">
                    <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-heart-line text-4xl text-blue-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-3">Vous n'avez pas encore de cours favoris</h2>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">Explorez nos cours et ajoutez vos préférés à cette liste pour y accéder facilement.</p>
                    <a href="{{ route('courses.show') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="ri-compass-3-line mr-2"></i>
                        Découvrir les cours
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($favoriteCourses as $course)
                        <div class="course-card bg-white rounded-xl overflow-hidden">
                            <div class="relative">
                                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-48 object-cover course-image">
                                <div class="absolute top-4 right-4">
                                    <form action="{{ route('etudiant.favorites.destroy', $course->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="from_favorites" value="true">
                                        <button type="submit" class="favorite-btn bg-white p-2 rounded-full shadow-md">
                                            <i class="ri-heart-fill text-red-500 text-xl"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-3">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                        {{ $course->category->name }}
                                    </span>
                                    <span class="ml-2 text-sm text-gray-500 flex items-center">
                                        <i class="ri-book-open-line mr-1"></i>
                                        {{ $course->chapters->sum(function ($chapter) { return $chapter->lessons->count(); }) }} leçons
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">{{ $course->title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $course->description }}</p>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <img src="{{ $course->user->image ? Storage::url($course->user->image) : 'https://cdn-icons-png.flaticon.com/512/219/219969.png' }}" 
                                             alt="{{ $course->user->name }}" 
                                             class="w-8 h-8 rounded-full mr-2 border-2 border-blue-100">
                                        <span class="text-sm text-gray-700">{{ $course->user->name }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-blue-600 font-bold">€{{ number_format($course->price, 2) }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('courses.details', $course->id) }}" 
                                   class="block w-full py-3 bg-blue-600 text-white rounded-lg text-center hover:bg-blue-700 transition-colors flex items-center justify-center">
                                    <i class="ri-eye-line mr-2"></i>
                                    Voir le cours
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection