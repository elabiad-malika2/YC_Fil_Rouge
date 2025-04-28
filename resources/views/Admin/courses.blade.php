@extends('Admin.layout')

@section('title', 'Gestion des cours')

@section('styles')
<style>
    .course-card {
        transition: all 0.3s ease;
    }

    .course-card:hover {
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
            <span class="text-gray-800 font-medium">Gestion des cours</span>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="container mx-auto px-6 py-8">
    <!-- Statistics Banner -->
    <div class="glass-card p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-indigo-50 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-lg p-3">
                        <i class="ri-book-open-line text-2xl text-white"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-indigo-600">Total des cours</p>
                        <p class="text-2xl font-bold text-indigo-900">{{ $totalCourses }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-green-50 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-lg p-3">
                        <i class="ri-check-line text-2xl text-white"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-green-600">Cours actifs</p>
                        <p class="text-2xl font-bold text-green-900">{{ $activeCourses }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-red-50 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-red-500 rounded-lg p-3">
                        <i class="ri-close-line text-2xl text-white"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-red-600">Cours inactifs</p>
                        <p class="text-2xl font-bold text-red-900">{{ $inactiveCourses }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course List -->
    <div class="glass-card p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Liste des cours</h2>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="ri-search-line text-gray-400"></i>
                </span>
                <input type="text" placeholder="Rechercher un cours..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cours</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enseignant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($courses as $course)
                    <tr class="course-card hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $course->title }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($course->description, 50) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $course->user->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $course->category->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ number_format($course->price, 2, ',', ' ') }} €</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $course->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $course->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.courses.show', $course->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                <i class="ri-eye-line"></i>
                            </a>
                            <form action="{{ route('admin.courses.toggle-status', $course->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-{{ $course->is_active ? 'red' : 'green' }}-600 hover:text-{{ $course->is_active ? 'red' : 'green' }}-900">
                                    <i class="ri-{{ $course->is_active ? 'close' : 'check' }}-line"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $courses->links() }}
        </div>
    </div>
</main>
@endsection