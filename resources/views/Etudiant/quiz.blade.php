<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $quiz->title }} - Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.svg') }}">
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
        
        .quiz-option {
            background-color: transparent;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .quiz-option:hover {
            border-color: #6366F1;
        }
        
        .quiz-option.selected {
            border-color: #6366F1;
            border-width: 2px;
            background-color: #EEF2FF;
        }
        
        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background: #E5E7EB;
            overflow: hidden;
        }
        
        .progress-value {
            height: 100%;
            background: linear-gradient(90deg, #6366F1 0%, #8B5CF6 100%);
            border-radius: 4px;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between py-4">
                <a href="{{ route('courses.show') }}" class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-xl font-bold text-gray-800">E-Learning</span>
                </a>
                
                <div class="flex items-center space-x-4">
                    @if (Auth::check())
                        <div class="relative group">
                            <button class="flex items-center space-x-2">
                                <img src="{{ Auth::user()->photo ? Storage::url(Auth::user()->photo) : 'https://cdn-icons-png.flaticon.com/512/219/219969.png' }}" alt="User" class="w-8 h-8 rounded-full object-cover border-2 border-indigo-100">
                                <span class="text-gray-700 font-medium hidden md:block">{{ Auth::user()->name }}</span>
                                <i class="ri-arrow-down-s-line text-gray-500 hidden md:block"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 invisible group-hover:visible transition-all opacity-0 group-hover:opacity-100 z-50">
                                <div class="p-3 border-b border-gray-100">
                                    <p class="text-sm text-gray-500">Connecté en tant que</p>
                                    <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                                </div>
                                <div class="py-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mon profil</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Paramètres</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Aide</a>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Déconnexion</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
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
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $quiz->title }} <span class="text-indigo-600">Quiz</span></h1>
                <p class="text-lg text-gray-600 text-center max-w-2xl">Testez vos connaissances avec ce quiz interactif. Répondez à toutes les questions pour compléter l'évaluation.</p>
            </div>
            
            <div class="max-w-3xl mx-auto">
                <!-- Quiz Progress -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-600">Question <span id="current-question">1</span> of <span id="total-questions">{{ $quiz->questions->count() }}</span></span>
                        <span class="text-sm font-medium text-gray-600">Score: <span id="current-score">0</span></span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-value" style="width: {{ $quiz->questions->count() ? (1 / $quiz->questions->count() * 100) : 0 }}%"></div>
                    </div>
                </div>
                
                <!-- Quiz Card -->
                <div class="glass-card p-8 mb-10">
                    <div id="quiz-container">
                        <!-- Timer -->
                        <div class="flex justify-end mb-4">
                            <div class="px-4 py-2 bg-gray-100 rounded-full">
                                <span class="text-gray-800 font-medium"><i class="ri-time-line mr-2"></i> <span id="timer">00:00</span></span>
                            </div>
                        </div>
                        
                        <!-- Question -->
                        <div class="mb-6">
                            <h2 id="question-text" class="text-xl font-semibold text-gray-800 mb-4">Chargement...</h2>
                            <p class="text-gray-600 mb-2 text-sm">Sélectionnez la réponse correcte ci-dessous :</p>
                        </div>
                        
                        <!-- Options -->
                        <div id="options-container" class="space-y-3">
                            <!-- Les réponses seront injectées ici -->
                        </div>
                        
                        <div class="mt-8">
                            <div class="flex justify-end">
                                <button id="next-button" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                                    Suivant <i class="ri-arrow-right-line ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quiz Info -->
                <div class="glass-card p-6">
                    <h3 class="font-semibold text-gray-800 mb-3">Informations sur le Quiz</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 p-3 rounded-full mr-3">
                                <i class="ri-questionnaire-line text-xl text-indigo-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">{{ $quiz->questions->count() }} Questions</h4>
                                <p class="text-xs text-gray-500">Choix multiples</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-indigo-100 p-3 rounded-full mr-3">
                                <i class="ri-time-line text-xl text-indigo-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">{{ $quiz->questions->sum('duration') }} Minutes</h4>
                                <p class="text-xs text-gray-500">Limite de temps totale</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-indigo-100 p-3 rounded-full mr-3">
                                <i class="ri-trophy-line text-xl text-indigo-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">70% pour Réussir</h4>
                                <p class="text-xs text-gray-500">Score minimum</p>
                            </div>
                        </div>
                    </div>
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
                    <p class="text-gray-600 mb-4">Transformez votre vie grâce à l'éducation avec notre plateforme d'apprentissage en ligne.</p>
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
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('courses.show') }}" class="text-gray-600 hover:text-indigo-600">Accueil</a></li>
                        <li><a href="{{ route('courses.show') }}" class="text-gray-600 hover:text-indigo-600">Cours</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Tarification</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Fonctionnalités</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Blog</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Centre d'aide</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">FAQ</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Contactez-nous</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Politique de confidentialité</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Conditions d'utilisation</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">S'abonner</h3>
                    <p class="text-gray-600 mb-4">Abonnez-vous à notre newsletter pour recevoir les dernières mises à jour.</p>
                    <form action="#" method="POST" class="flex flex-col space-y-3">
                        <input type="email" name="email" placeholder="Votre email" required
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            S'abonner
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-200 mt-10 pt-6">
                <p class="text-center text-gray-600 text-sm">
                    © 2025 Plateforme E-Learning. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Données des questions passées depuis PHP
        const questions = {!! json_encode($quiz->questions->map(function($question) {
            return [
                'id' => $question->id,
                'text' => $question->text,
                'points' => $question->points,
                'duration' => $question->duration ?? 1,
                'answers' => $question->answers->map(function($answer) {
                    return [
                        'id' => $answer->id,
                        'text' => $answer->text
                    ];
                })->toArray()
            ];
        })->toArray()) !!};

        console.log('Questions chargées:', questions);

        let currentQuestionIndex = 0;
        let score = 0;
        let userAnswers = {};
        let quizId = {{ $quiz->id }};
        let timeLeft = 0;
        let timerInterval = null;

        // Fonction pour formater le temps
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = seconds % 60;
            return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
        }

        // Fonction pour mettre à jour le timer
        function updateTimer() {
            const timerDisplay = document.getElementById('timer');
            if (!timerDisplay) {
                console.error('Élément #timer introuvable');
                return;
            }

            timerDisplay.textContent = formatTime(timeLeft);

            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                // Passer à la question suivante ou soumettre le quiz
                if (currentQuestionIndex < questions.length - 1) {
                    currentQuestionIndex++;
                    showQuestion(currentQuestionIndex);
                } else {
                    submitQuiz();
                }
            } else {
                timeLeft--;
            }
        }

        // Fonction pour démarrer le timer
        function startTimer(durationInMinutes) {
            if (timerInterval) {
                clearInterval(timerInterval);
            }
            timeLeft = Math.max(1, durationInMinutes) * 60; // Convertir en secondes, minimum 1 seconde
            updateTimer(); // Afficher immédiatement
            timerInterval = setInterval(updateTimer, 1000);
        }

        function showQuestion(index) {
            const question = questions[index];
            console.log('Affichage question:', question);

            if (!question) {
                console.error('Question non trouvée à l\'index:', index);
                return;
            }

            // Mise à jour du texte de la question
            document.getElementById('question-text').textContent = question.text;

            // Mise à jour de la progression
            document.getElementById('current-question').textContent = index + 1;
            const progressValue = document.querySelector('.progress-value');
            if (progressValue) {
                progressValue.style.width = `${((index + 1) / questions.length) * 100}%`;
            }

            // Démarrer le timer pour cette question
            startTimer(question.duration || 1);

            // Affichage des réponses
            const optionsContainer = document.getElementById('options-container');
            optionsContainer.innerHTML = ''; // Nettoyer les anciennes réponses

            if (question.answers && question.answers.length > 0) {
                question.answers.forEach((answer, i) => {
                    const answerHtml = `
                        <div class="answer-option">
                            <input type="radio" 
                                   name="answer" 
                                   id="answer-${i}" 
                                   value="${answer.id}" 
                                   class="hidden peer">
                            <label for="answer-${i}" 
                                   class="block w-full p-4 bg-white border border-gray-200 rounded-lg cursor-pointer 
                                          hover:border-indigo-500 peer-checked:border-indigo-500 
                                          peer-checked:bg-indigo-50 transition-all">
                                ${answer.text}
                            </label>
                        </div>
                    `;
                    optionsContainer.insertAdjacentHTML('beforeend', answerHtml);
                });

                // Ajouter les écouteurs d'événements pour les réponses
                document.querySelectorAll('input[name="answer"]').forEach(input => {
                    input.addEventListener('change', () => {
                        document.getElementById('next-button').disabled = false;
                    });
                });
            } else {
                optionsContainer.innerHTML = '<p class="text-red-500">Aucune réponse disponible pour cette question.</p>';
            }

            // Réinitialiser le bouton Suivant
            document.getElementById('next-button').disabled = true;
        }

        // Gérer le clic sur le bouton Suivant
        document.getElementById('next-button').addEventListener('click', () => {
            const selectedAnswer = document.querySelector('input[name="answer"]:checked');
            if (!selectedAnswer) return;

            // Arrêter le timer de la question actuelle
            if (timerInterval) {
                clearInterval(timerInterval);
            }

            userAnswers[questions[currentQuestionIndex].id] = selectedAnswer.value;

            if (currentQuestionIndex < questions.length - 1) {
                currentQuestionIndex++;
                showQuestion(currentQuestionIndex);
            } else {
                submitQuiz();
            }
        });

        function submitQuiz() {
            // Arrêter le timer si actif
            if (timerInterval) {
                clearInterval(timerInterval);
            }

            const formData = {
                quiz_id: quizId,
                answers: userAnswers,
                _token: document.querySelector('meta[name="csrf-token"]').content
            };

            fetch('/student/quiz/submit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect_url;
                } else {
                    alert('Une erreur est survenue lors de la soumission du quiz');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors de la soumission du quiz');
            });
        }

        // Démarrer le quiz
        showQuestion(currentQuestionIndex);
    </script>
</body>
</html>