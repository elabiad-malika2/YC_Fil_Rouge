<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des catégories et tags - E-Learning</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon.svg">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        
        .category-card, .tag-card {
            transition: all 0.3s ease;
        }

        .category-card:hover, .tag-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .form-gradient {
            background: linear-gradient(135deg, #f3f4f6 0%, #ffffff 100%);
        }

        .modal-gradient {
            background: linear-gradient(135deg, #ffffff 0%, #f3f4f6 100%);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-indigo-50 to-purple-100">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl z-50">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-between p-5 border-b bg-gradient-to-r from-indigo-600 to-purple-600">
                <div class="flex items-center space-x-2">
                    <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-lg font-bold text-white">E-Learning</span>
                </div>
            </div>
            <nav class="flex-1 px-5 py-6 space-y-2">
                <a href="./dashboard.php" class="flex items-center py-3 px-4 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                    <i class="ri-dashboard-line mr-3"></i> Tableau de bord
                </a>
                <a href="./courses.php" class="flex items-center py-3 px-4 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                    <i class="ri-book-open-line mr-3"></i> Mes cours
                </a>
                <a href="./students.php" class="flex items-center py-3 px-4 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                    <i class="ri-user-line mr-3"></i> Étudiants
                </a>
                <a href="./categories-tags.php" class="flex items-center py-3 px-4 rounded-lg text-indigo-600 bg-indigo-50 font-medium">
                    <i class="ri-price-tag-3-line mr-3"></i> Catégories & Tags
                </a>
                <a href="./settings.php" class="flex items-center py-3 px-4 rounded-lg text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                    <i class="ri-settings-3-line mr-3"></i> Paramètres
                </a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64">

        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-40">
            <div class="container mx-auto px-6">
                <div class="flex items-center justify-end py-4">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="ri-search-line text-gray-400"></i>
                            </span>
                            <input type="text" placeholder="Rechercher..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm">
                        </div>
                        <div class="relative">
                            <button class="p-2 rounded-full text-gray-500 hover:bg-gray-100 relative">
                                <i class="ri-notification-3-line text-xl"></i>
                                <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                            </button>
                        </div>
                        <div class="relative">
                            <button class="flex items-center space-x-2 focus:outline-none">
                                <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="User" class="w-9 h-9 rounded-full border-2 border-indigo-200">
                                <span class="text-sm font-medium text-gray-700">
                                    John Doe
                                    <i class="ri-arrow-down-s-line text-gray-400"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Breadcrumb -->
        <div class="bg-gray-100 py-3 border-b">
            <div class="container mx-auto px-6">
                <div class="flex items-center space-x-2 text-sm text-gray-600">
                    <a href="./dashboard.php" class="hover:text-indigo-600">Tableau de bord</a>
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
                        <form method="POST" action="{{ route('categories.store') }}">
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
                                <button class="edit-category-btn px-3 py-1 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 transition-colors" data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                                    <i class="ri-edit-line"></i>
                                </button>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-category-btn px-3 py-1 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tags -->
                <div class="glass-card p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Tags</h2>
                    <!-- Add Tag Form -->
                    <div class="form-gradient p-4 rounded-lg mb-6 shadow-sm">
                        <form method="POST" action="{{ route('tags.store') }}">
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
                                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="inline">
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
    </div>

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

    <!-- JavaScript for Modal Interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryModal = document.getElementById('category-modal');
            const tagModal = document.getElementById('tag-modal');
            const closeCategoryModal = document.getElementById('close-category-modal');
            const closeTagModal = document.getElementById('close-tag-modal');
            const cancelCategory = document.getElementById('cancel-category');
            const cancelTag = document.getElementById('cancel-tag');
            const categoryForm = document.getElementById('category-form');
            const tagForm = document.getElementById('tag-form');

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

            // Edit category buttons
            document.querySelectorAll('.edit-category-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const name = btn.dataset.name;
                    document.getElementById('category-name').value = name;
                    document.getElementById('category-id').value = id;
                    document.getElementById('category-modal-title').textContent = 'Modifier la catégorie';
                    categoryForm.action = `/categories/${id}`;
                    showModal(categoryModal);
                });
            });

            // Edit tag buttons
            document.querySelectorAll('.edit-tag-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const name = btn.dataset.name;
                    const color = btn.dataset.color;
                    document.getElementById('tag-name').value = name;
                    document.getElementById('tag-color').value = color;
                    document.getElementById('tag-id').value = id;
                    document.getElementById('tag-modal-title').textContent = 'Modifier le tag';
                    tagForm.action = `/tags/${id}`;
                    showModal(tagModal);
                });
            });

            // Close modals
            closeCategoryModal.addEventListener('click', () => hideModal(categoryModal));
            closeTagModal.addEventListener('click', () => hideModal(tagModal));
            cancelCategory.addEventListener('click', () => hideModal(categoryModal));
            cancelTag.addEventListener('click', () => hideModal(tagModal));
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
    </script>
</body>
</html>