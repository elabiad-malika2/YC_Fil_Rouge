@extends('Admin.layout')

@section('title', 'Gestion des catégories et tags')

@section('styles')
<style>
    .category-card, .tag-card {
        transition: all 0.3s ease;
    }

    .category-card:hover, .tag-card:hover {
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
            <span class="text-gray-800 font-medium">Gestion des catégories et tags</span>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="container mx-auto px-6 py-8">
    <!-- Welcome Banner -->
    <div class="glass-card p-6 mb-8">
        <div class="flex flex-col justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Gestion des catégories et tags</h1>
                <p class="text-gray-600">Organisez vos cours avec des catégories et tags vibrants et intuitifs.</p>
            </div>
        </div>
    </div>

    <!-- Categories and Tags Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Categories -->
        <div class="glass-card p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Catégories</h2>
            <!-- Add Category Form -->
            <div class="form-gradient p-4 rounded-lg mb-6 shadow-sm">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="new-category-name" class="block text-sm font-medium text-gray-700 mb-2">Nouvelle catégorie <span class="text-red-600">*</span></label>
                        <input type="text" id="new-category-name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm" placeholder="Ex: Programmation" required>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-colors">Ajouter</button>
                </form>
            </div>
            <div id="categories-list" class="space-y-4">
                @foreach($categories as $category)
                <div class="category-card flex items-center justify-between p-4 border border-gray-200 rounded-lg bg-white">
                    <h3 class="font-semibold text-gray-800">{{ $category->name }}</h3>
                    <div class="flex space-x-2">
                        <button type="button" onclick="showEditCategoryForm({{ $category->id }}, '{{ $category->name }}')" class="px-3 py-1 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 transition-colors">
                            <i class="ri-edit-line"></i>
                        </button>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Formulaire d'édition de catégorie -->
            <div id="edit-category-form" class="hidden form-gradient p-6 rounded-lg mt-6 shadow-sm">
                <form method="POST" action="" id="category-edit-form">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit-category-name" class="block text-sm font-medium text-gray-700 mb-2">Nom de la catégorie <span class="text-red-600">*</span></label>
                        <input type="text" id="edit-category-name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm" required>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="hideEditCategoryForm()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Annuler</button>
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-colors">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tags -->
        <div class="glass-card p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Tags</h2>
            <!-- Add Tag Form -->
            <div class="form-gradient p-4 rounded-lg mb-6 shadow-sm">
                <form method="POST" action="{{ route('admin.tags.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="new-tag-name" class="block text-sm font-medium text-gray-700 mb-2">Nouveau tag <span class="text-red-600">*</span></label>
                        <input type="text" id="new-tag-name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm" placeholder="Ex: JavaScript" required>
                    </div>
                    <div class="mb-4">
                        <label for="new-tag-color" class="block text-sm font-medium text-gray-700 mb-2">Couleur du tag</label>
                        <input type="color" id="new-tag-color" name="color" value="#4F46E5" class="w-full h-10 border border-gray-300 rounded-lg">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-colors">Ajouter</button>
                </form>
            </div>
            <div id="tags-list" class="space-y-4">
                @foreach($tags as $tag)
                <div class="tag-card flex items-center justify-between p-4 border border-gray-200 rounded-lg bg-white">
                    <span class="inline-block px-3 py-1 text-white text-sm font-medium rounded-full" style="background-color: {{ $tag->color }};">#{{ $tag->name }}</span>
                    <div class="flex space-x-2">
                        <button type="button" onclick="showEditForm({{ $tag->id }} ,'{{ $tag->name }}', '{{ $tag->color }}')" class="px-3 py-1 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 transition-colors">
                            <i class="ri-edit-line"></i>
                        </button>
                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Formulaire d'édition de tag -->
            <div id="edit-tag-form" class="hidden form-gradient p-6 rounded-lg mt-6 shadow-sm">
                <form method="POST" action="" id="tag-edit-form">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit-tag-name" class="block text-sm font-medium text-gray-700 mb-2">Nom du tag <span class="text-red-600">*</span></label>
                        <input type="text" id="edit-tag-name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="edit-tag-color" class="block text-sm font-medium text-gray-700 mb-2">Couleur du tag</label>
                        <input type="color" id="edit-tag-color" name="color" class="w-full h-10 border border-gray-300 rounded-lg">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="hideEditForm()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Annuler</button>
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-colors">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Modal for Editing Category -->
<div id="category-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="min-h-screen flex items-center justify-center">
        <div class="modal-gradient rounded-3xl p-8 max-w-md w-full shadow-2xl">
            <form id="category-form" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="flex justify-between items-center mb-6">
                    <h2 id="category-modal-title" class="text-xl font-bold text-gray-800">Modifier la catégorie</h2>
                    <button type="button" id="close-category-modal" class="text-gray-500 hover:text-gray-700">
                        <i class="ri-close-line text-2xl"></i>
                    </button>
                </div>
                <div class="mb-6">
                    <label for="category-name" class="block text-sm font-medium text-gray-700 mb-2">Nom de la catégorie <span class="text-red-600">*</span></label>
                    <input type="text" id="category-name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-sm" required>
                    <input type="hidden" id="category-id" name="id">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancel-category" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-colors">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryModal = document.getElementById('category-modal');
        const closeCategoryModal = document.getElementById('close-category-modal');
        const cancelCategory = document.getElementById('cancel-category');
        const categoryForm = document.getElementById('category-form');

        // Function to show modal
        function showModal(modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Function to hide modal
        function hideModal(modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modals
        closeCategoryModal.addEventListener('click', () => hideModal(categoryModal));
        cancelCategory.addEventListener('click', () => hideModal(categoryModal));
    });

    function showEditForm(id, name, color) {
        const form = document.getElementById('edit-tag-form');
        const editForm = document.getElementById('tag-edit-form');
        const nameInput = document.getElementById('edit-tag-name');
        const colorInput = document.getElementById('edit-tag-color');
        
        nameInput.value = name;
        colorInput.value = color;
        editForm.action = `/admin/tags/${id}`;
        
        form.classList.remove('hidden');
        form.scrollIntoView({ behavior: 'smooth' });
    }

    function hideEditForm() {
        document.getElementById('edit-tag-form').classList.add('hidden');
    }

    function showEditCategoryForm(id, name) {
        const form = document.getElementById('edit-category-form');
        const editForm = document.getElementById('category-edit-form');
        const nameInput = document.getElementById('edit-category-name');
        
        nameInput.value = name;
        editForm.action = `/admin/categories/${id}`;
        
        form.classList.remove('hidden');
        form.scrollIntoView({ behavior: 'smooth' });
    }

    function hideEditCategoryForm() {
        document.getElementById('edit-category-form').classList.add('hidden');
    }
</script>
@endsection