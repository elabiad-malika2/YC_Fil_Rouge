@extends('Admin.layout')

@section('title', 'Utilisateurs')

@section('styles')
<style>
    .user-card {
        transition: all 0.3s ease;
    }

    .user-card:hover {
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
            <a href="{{ route('admin.dashboard') }}" class="text-indigo-600">Tableau de bord</a>
            <i class="ri-arrow-right-s-line"></i>
            <span class="text-gray-800 font-medium">Utilisateurs</span>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="container mx-auto px-6 py-8">
    <!-- Welcome Banner -->
    <div class="glass-card p-6 mb-8">
        <div class="flex flex-col justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Utilisateurs</h1>
                <p class="text-gray-600">Gérez les utilisateurs de la plateforme.</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="glass-card p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                    <i class="ri-user-line text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Total Utilisateurs</h3>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="glass-card p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="ri-user-follow-line text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Utilisateurs Actifs</h3>
                    <p class="text-2xl font-semibold text-gray-900">{{ $activeUsers }}</p>
                </div>
            </div>
        </div>
        <div class="glass-card p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="ri-user-unfollow-line text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-gray-500 text-sm">Utilisateurs Inactifs</h3>
                    <p class="text-2xl font-semibold text-gray-900">{{ $inactiveUsers }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="glass-card">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Liste des utilisateurs</h2>
                <!-- <button class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-colors">
                    <i class="ri-user-add-line mr-2"></i>Ajouter un utilisateur
                </button> -->
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                        @if($user->role->name !== 'admin')
                        <tr class="user-card">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover" 
                                             src="{{ $user->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                                             alt="{{ $user->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $user->role->name === 'enseignant' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($user->role->name) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-3">
                                    <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="{{ $user->is_active ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }}">
                                            <i class="ri-{{ $user->is_active ? 'close' : 'check' }}-line"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $users->links() }}
        </div>
    </div>
</main>
@endsection