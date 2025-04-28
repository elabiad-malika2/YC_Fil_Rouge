@extends('Admin.layout')

@section('title', 'Détails du cours')

@section('styles')
<style>
    .stat-card {
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
</style>
@endsection

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 py-3 border-b">
    <div class="container mx-auto px-6">
        <div class="flex items-center space-x-2 text-sm text-gray-600">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600">Tableau de bord</a>
            <i class="ri-arrow-right-s-line"></i>
            <a href="{{ route('admin.courses.index') }}" class="hover:text-indigo-600">Cours</a>
            <i class="ri-arrow-right-s-line"></i>
            <span class="text-gray-800 font-medium">Détails du cours</span>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="container mx-auto px-6 py-8">
    <!-- Title and Actions -->
    <div class="glass-card p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $course->title }}</h1>
                <p class="text-gray-600">{{ Str::limit($course->description, 100) }}</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('admin.courses.index') }}" class="px-4 py-2 bg-white border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors flex items-center">
                    <i class="ri-arrow-left-line mr-2"></i>
                    Retour
                </a>
                <form action="{{ route('admin.courses.toggle-status', $course->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="px-4 py-2 {{ $course->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg transition-colors flex items-center">
                        <i class="ri-{{ $course->is_active ? 'close' : 'check' }}-line mr-2"></i>
                        {{ $course->is_active ? 'Désactiver' : 'Activer' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Informations générales -->
        <div class="lg:col-span-2">
            <div class="glass-card p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Informations générales</h2>
                <div class="space-y-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Description complète</h3>
                        <p class="mt-2 text-gray-800">{{ $course->description }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Prix</h3>
                            <p class="mt-2 text-gray-800 text-lg font-semibold">{{ number_format($course->price, 2, ',', ' ') }} €</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Enseignant</h3>
                            <p class="mt-2 text-gray-800">{{ $course->user->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Catégorie</h3>
                            <p class="mt-2 text-gray-800">{{ $course->category->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Statut</h3>
                            <span class="inline-flex mt-2 px-2.5 py-0.5 rounded-full text-sm font-medium {{ $course->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $course->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="lg:col-span-1">
            <div class="glass-card p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Statistiques</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="stat-card bg-indigo-50 rounded-lg p-4">
                        <p class="text-indigo-600 text-sm font-medium">Inscrits</p>
                        <p class="mt-2 text-3xl font-bold text-indigo-700">{{ $course->enrollments_count ?? 0 }}</p>
                    </div>
                    <div class="stat-card bg-purple-50 rounded-lg p-4">
                        <p class="text-purple-600 text-sm font-medium">Chapitres</p>
                        <p class="mt-2 text-3xl font-bold text-purple-700">{{ $course->chapters_count ?? 0 }}</p>
                    </div>
                    <div class="stat-card bg-blue-50 rounded-lg p-4">
                        <p class="text-blue-600 text-sm font-medium">Quiz</p>
                        <p class="t-2 text-3xl font-bold text-blue-700">{{ $course->quizzes_count ?? 0 }}</p>
                    </div>
                    <div class="stat-card bg-emerald-50 rounded-lg p-4">
                        <p class="text-emerald-600 text-sm font-medium">Date de création</p>
                        <p class="mt-2 text-sm font-semibold text-emerald-700">{{ $course->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection