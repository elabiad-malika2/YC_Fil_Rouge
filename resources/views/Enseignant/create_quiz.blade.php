<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz - E-Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.svg">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .wave-shape {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .wave-shape svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 150px;
        }

        .wave-shape .shape-fill {
            fill: #F3F4F6;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Top Info Bar -->
    <div class="hidden md:block w-full gradient-bg text-white">
        <div class="container mx-auto px-6 py-2">
            <div class="flex justify-between items-center text-sm">
                <div class="flex items-center space-x-6">
                    <span class="flex items-center">
                        <i class="ri-phone-line mr-2"></i> +212 772508881
                    </span>
                    <span class="flex items-center">
                        <i class="ri-mail-line mr-2"></i> contact@e-learning.com
                    </span>
                </div>
                <span class="flex items-center">
                    <i class="ri-map-pin-line mr-2"></i> Massira N641 Safi, Morocco
                </span>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between py-4">
                <a href="/" class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-xl font-bold text-gray-800">E-Learning</span>
                </a>
                
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="/teacher/dashboard" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Tableau de bord</a>
                    <a href="/teacher/courses" class="text-indigo-600 border-b-2 border-indigo-600 pb-1 transition-colors font-medium">Mes cours</a>
                    <a href="/teacher/quizzes" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Quiz</a>
                    <a href="/teacher/assignments" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Devoirs</a>
                </nav>
                
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="p-2 rounded-full text-gray-500 hover:bg-gray-100">
                            <i class="ri-notification-3-line text-xl"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                    </div>
                    
                    <div class="relative group">
                        <button class="flex items-center space-x-2">
                            <img src="/assets/images/avatar.jpg" alt="User" class="w-8 h-8 rounded-full object-cover border-2 border-indigo-100">
                            <span class="text-gray-700 font-medium hidden md:block">{{ Auth::user()->name }}</span>
                            <i class="ri-arrow-down-s-line text-gray-500 hidden md:block"></i>
                        </button>
                        
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 invisible group-hover:visible transition-all opacity-0 group-hover:opacity-100 z-50">
                            <div class="p-3 border-b border-gray-100">
                                <p class="text-sm text-gray-500">Connecté en tant que</p>
                                <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="py-1">
                                <a href="/teacher/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mon profil</a>
                                <a href="/teacher/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Paramètres</a>
                                <a href="/help" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Aide</a>
                                <a href="/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Déconnexion</a>
                            </div>
                        </div>
                    </div>
                    
                    <button id="mobile-menu-btn" class="p-2 rounded-full text-gray-500 hover:bg-gray-100 md:hidden">
                        <i class="ri-menu-line text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="sidebar-menu" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden transition-opacity">
            <div class="fixed top-0 right-0 w-72 bg-white h-full shadow-xl transform transition-transform duration-300">
                <div class="flex justify-between items-center p-5 border-b">
                    <div class="flex items-center space-x-2">
                        <svg class="h-6 w-6 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                            <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-lg font-bold text-gray-800">E-Learning</span>
                    </div>
                    <button id="close-sidebar" class="text-gray-500 hover:text-gray-700">
                        <i class="ri-close-line text-2xl"></i>
                    </button>
                </div>
                <div class="px-5 py-4 border-b">
                    <div class="flex items-center space-x-3">
                        <img src="/assets/images/avatar.jpg" alt="User" class="w-10 h-10 rounded-full object-cover border-2 border-indigo-100">
                        <div>
                            <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500">Enseignant</p>
                        </div>
                    </div>
                </div>
                <nav class="flex flex-col px-5 py-6">
                    <a href="/teacher/dashboard" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Tableau de bord</a>
                    <a href="/teacher/courses" class="py-3 px-4 rounded-lg text-indigo-600 bg-indigo-50 font-medium">Mes cours</a>
                    <a href="/teacher/quizzes" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Quiz</a>
                    <a href="/teacher/assignments" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Devoirs</a>
                    <div class="border-t border-gray-200 my-4"></div>
                    <a href="/teacher/profile" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Mon profil</a>
                    <a href="/teacher/settings" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Paramètres</a>
                    <a href="/help" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Aide</a>
                    <a href="/logout" class="mt-4 py-3 px-4 rounded-lg text-red-600 hover:bg-red-50 transition-colors">Déconnexion</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen relative overflow-hidden">
        <!-- Background Patterns -->
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        <div class="absolute top-1/4 -left-24 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        <div class="absolute bottom-1/4 right-12 w-80 h-80 bg-pink-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        
        <div class="container mx-auto px-6 py-12 md:py-20 relative z-10">
            <div class="flex flex-col items-center justify-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Créer un <span class="text-indigo-600">Quiz</span></h1>
                <p class="text-lg text-gray-600 text-center max-w-2xl">Ajoutez un nouveau quiz pour vos étudiants. Remplissez les détails ci-dessous et ajoutez des questions à choix multiples (4 réponses par question).</p>
            </div>
            
            <div class="max-w-3xl mx-auto">
                <!-- Quiz Creation Form -->
                <div class="glass-card p-8">
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('quizzes.create') }}" id="quiz-form">
                        @csrf
                        <!-- Quiz Details -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Titre du Quiz</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Entrez le titre du quiz" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <label for="course_id" class="block text-sm font-medium text-gray-700">Cours</label>
                            <select name="course_id" id="course_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                <option value="" disabled selected>Sélectionnez un cours</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Questions Container -->
                        <div id="questions-container">
                            <!-- Question Template -->
                            <template id="question-template">
                                <div class="question-block mb-8 border-t border-gray-200 pt-6">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Question <span class="question-number"></span></h3>
                                    
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Texte de la question</label>
                                        <textarea name="questions[][text]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Entrez la question" required></textarea>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Points</label>
                                            <input type="number" name="questions[][points]" min="1" value="10" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Points" required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Durée (secondes)</label>
                                            <input type="number" name="questions[][duration]" min="1" value="30" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Durée" required>
                                        </div>
                                    </div>
                                    
                                    <!-- Answers -->
                                    <div class="mb-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Réponses (sélectionnez la réponse correcte)</label>
                                        <div class="flex items-center mb-3">
                                            <input type="radio" name="questions[][correct_answer]" value="0" class="mr-2" required>
                                            <input type="text" name="questions[][answers][0][text]" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Réponse 1" required>
                                            <input type="hidden" name="questions[][answers][0][is_correct]" value="0">
                                        </div>
                                        <div class="flex items-center mb-3">
                                            <input type="radio" name="questions[][correct_answer]" value="1" class="mr-2">
                                            <input type="text" name="questions[][answers][1][text]" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Réponse 2" required>
                                            <input type="hidden" name="questions[][answers][1][is_correct]" value="0">
                                        </div>
                                        <div class="flex items-center mb-3">
                                            <input type="radio" name="questions[][correct_answer]" value="2" class="mr-2">
                                            <input type="text" name="questions[][answers][2][text]" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Réponse 3" required>
                                            <input type="hidden" name="questions[][answers][2][is_correct]" value="0">
                                        </div>
                                        <div class="flex items-center mb-3">
                                            <input type="radio" name="questions[][correct_answer]" value="3" class="mr-2">
                                            <input type="text" name="questions[][answers][3][text]" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Réponse 4" required>
                                            <input type="hidden" name="questions[][answers][3][is_correct]" value="0">
                                        </div>
                                    </div>
                                </div>
                            </template>
                            
                            <!-- Initial Question -->
                            <div class="question-block mb-8 border-t border-gray-200 pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Question 1</h3>
                                
                                <div class="mb-4">
                                    <label for="questions[0][text]" class="block text-sm font-medium text-gray-700">Texte de la question</label>
                                    <textarea name="questions[0][text]" id="questions[0][text]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Entrez la question" required>{{ old('questions.0.text') }}</textarea>
                                    @error('questions.0.text')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="questions[0][points]" class="block text-sm font-medium text-gray-700">Points</label>
                                        <input type="number" name="questions[0][points]" id="questions[0][points]" min="1" value="{{ old('questions.0.points', 10) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Points" required>
                                        @error('questions.0.points')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="questions[0][duration]" class="block text-sm font-medium text-gray-700">Durée (secondes)</label>
                                        <input type="number" name="questions[0][duration]" id="questions[0][duration]" min="1" value="{{ old('questions.0.duration', 30) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Durée" required>
                                        @error('questions.0.duration')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Answers -->
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Réponses (sélectionnez la réponse correcte)</label>
                                    @for ($a = 0; $a < 4; $a++)
                                        <div class="flex items-center mb-3">
                                            <input type="radio" name="questions[0][correct_answer]" value="{{ $a }}" class="mr-2" {{ old('questions.0.correct_answer') == $a ? 'checked' : '' }} required>
                                            <input type="text" name="questions[0][answers][{{ $a }}][text]" value="{{ old("questions.0.answers.$a.text") }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Réponse {{ $a + 1 }}" required>
                                            <input type="hidden" name="questions[0][answers][{{ $a }}][is_correct]" value="{{ old('questions.0.correct_answer') == $a ? '1' : '0' }}">
                                        </div>
                                        @error("questions.0.answers.$a.text")
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    @endfor
                                    @error('questions.0.correct_answer')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Add Question Button -->
                        <button type="button" id="add-question-btn" class="mt-6 px-6 py-2 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 flex items-center">
                            <i class="ri-add-line mr-2"></i> Ajouter une question
                        </button>
                        
                        <!-- Submit Button -->
                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                Créer le Quiz
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Quiz List -->
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Vos Quiz</h2>
                    @if ($quizzes->isEmpty())
                        <p class="text-gray-600">Aucun quiz créé pour le moment.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($quizzes as $quiz)
                                <div class="glass-card p-6">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $quiz->title }}</h3>
                                    <p class="text-gray-600 mb-1"><span class="font-medium">Cours :</span> {{ $quiz->course ? $quiz->course->title : 'Non assigné' }}</p>
                                    <p class="text-gray-600 mb-1"><span class="font-medium">Questions :</span> {{ $quiz->questions->count() }}</p>
                                    <p class="text-gray-600 mb-4"><span class="font-medium">Créé le :</span> {{ $quiz->created_at->format('d/m/Y H:i') }}</p>
                                    <div class="flex space-x-4">
                                        <a href="{{ route('quizzes.edit', $quiz->id) }}" class="px-4 py-2 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 flex items-center">
                                            <i class="ri-edit-line mr-2"></i> Modifier
                                        </a>
                                        <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce quiz ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 flex items-center">
                                                <i class="ri-delete-bin-line mr-2"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Wave Shape -->
        <div class="wave-shape">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
            </svg>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                            <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-xl font-bold text-gray-800">E-Learning</span>
                    </div>
                    <p class="text-gray-600 mb-4">Transform your life through education with our online learning platform.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-indigo-600">
                            <i class="ri-facebook-fill text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600">
                            <i class="ri-twitter-fill text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600">
                            <i class="ri-instagram-fill text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600">
                            <i class="ri-linkedin-fill text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-600 hover:text-indigo-600">Home</a></li>
                        <li><a href="/courses" class="text-gray-600 hover:text-indigo-600">Courses</a></li>
                        <li><a href="/pricing" class="text-gray-600 hover:text-indigo-600">Pricing</a></li>
                        <li><a href="/features" class="text-gray-600 hover:text-indigo-600">Features</a></li>
                        <li><a href="/blog" class="text-gray-600 hover:text-indigo-600">Blog</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="/help" class="text-gray-600 hover:text-indigo-600">Help Center</a></li>
                        <li><a href="/faq" class="text-gray-600 hover:text-indigo-600">FAQs</a></li>
                        <li><a href="/contact" class="text-gray-600 hover:text-indigo-600">Contact Us</a></li>
                        <li><a href="/privacy" class="text-gray-600 hover:text-indigo-600">Privacy Policy</a></li>
                        <li><a href="/terms" class="text-gray-600 hover:text-indigo-600">Terms of Service</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Subscribe</h3>
                    <p class="text-gray-600 mb-4">Subscribe to our newsletter to get the latest updates.</p>
                    <form action="/newsletter/subscribe" method="POST" class="flex flex-col space-y-3">
                        <input type="email" name="email" placeholder="Your email" required
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-200 mt-10 pt-6">
                <p class="text-center text-gray-600 text-sm">
                    © 2025 E-Learning Platform. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const sidebar = document.getElementById('sidebar-menu');
        const menuBtn = document.getElementById('mobile-menu-btn');
        const closeBtn = document.getElementById('close-sidebar');
        
        menuBtn.addEventListener('click', () => {
            sidebar.classList.remove('hidden');
            sidebar.querySelector('div').classList.remove('translate-x-full');
        });
        
        closeBtn.addEventListener('click', () => {
            sidebar.querySelector('div').classList.add('translate-x-full');
            setTimeout(() => sidebar.classList.add('hidden'), 300);
        });

        // Add question logic
        const addQuestionBtn = document.getElementById('add-question-btn');
        const questionsContainer = document.getElementById('questions-container');
        const questionTemplate = document.getElementById('question-template').content;

        let questionCount = 1;

        addQuestionBtn.addEventListener('click', () => {
            const clone = document.importNode(questionTemplate, true);
            const questionBlock = clone.querySelector('.question-block');

            // Update question number
            questionBlock.querySelector('.question-number').textContent = questionCount + 1;

            // Update field names with correct index
            questionBlock.querySelectorAll('input, textarea').forEach(input => {
                if (input.name.includes('questions[]')) {
                    input.name = input.name.replace('questions[]', `questions[${questionCount}]`);
                }
            });

            // Update radio button names to ensure unique group per question
            const radioName = `questions[${questionCount}][correct_answer]`;
            questionBlock.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.name = radioName;
            });

            questionsContainer.appendChild(clone);
            questionCount++;
        });

        // Update is_correct values when radio buttons are changed
        document.addEventListener('change', (e) => {
            if (e.target.type === 'radio' && e.target.name.includes('correct_answer')) {
                const questionIndex = e.target.name.match(/\[(\d+)\]/)[1];
                const correctIndex = e.target.value;
                
                // Update all is_correct fields for this question
                document.querySelectorAll(`input[name="questions[${questionIndex}][answers][${0}][is_correct]"]`).forEach(input => {
                    input.value = correctIndex == 0 ? '1' : '0';
                });
                document.querySelectorAll(`input[name="questions[${questionIndex}][answers][${1}][is_correct]"]`).forEach(input => {
                    input.value = correctIndex == 1 ? '1' : '0';
                });
                document.querySelectorAll(`input[name="questions[${questionIndex}][answers][${2}][is_correct]"]`).forEach(input => {
                    input.value = correctIndex == 2 ? '1' : '0';
                });
                document.querySelectorAll(`input[name="questions[${questionIndex}][answers][${3}][is_correct]"]`).forEach(input => {
                    input.value = correctIndex == 3 ? '1' : '0';
                });
            }
        });
    </script>
</body>
</html>