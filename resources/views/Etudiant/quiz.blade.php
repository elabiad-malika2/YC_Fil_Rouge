@extends('Etudiant.layout')

@section('title', '{{ $quiz->title }} - Quiz')

@section('styles')
    <style>
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
@endsection

@section('content')
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
@endsection

@section('scripts')
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

        function formatTime(seconds) {
            return seconds;
        }

        function updateTimer() {
            const timerDisplay = document.getElementById('timer');
            if (!timerDisplay) {
                console.error('Élément timer introuvable');
                return;
            }

            timerDisplay.textContent = formatTime(timeLeft);

            if (timeLeft <= 0) {
                clearInterval(timerInterval);
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

        function startTimer(durationInSeconds) {
            if (timerInterval) {
                clearInterval(timerInterval);
            }
            timeLeft = durationInSeconds;
            updateTimer();
            timerInterval = setInterval(updateTimer, 1000);
        }

        function showQuestion(index) {
            const question = questions[index];
            console.log('Affichage question:', question);

            if (!question) {
                console.error('Question non trouvée à l\'index:', index);
                return;
            }

            document.getElementById('question-text').textContent = question.text;

            document.getElementById('current-question').textContent = index + 1;
            const progressValue = document.querySelector('.progress-value');
            if (progressValue) {
                progressValue.style.width = `${((index + 1) / questions.length) * 100}%`;
            }

            startTimer(question.duration || 1);

            const optionsContainer = document.getElementById('options-container');
            optionsContainer.innerHTML = ''; 

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

                document.querySelectorAll('input[name="answer"]').forEach(input => {
                    input.addEventListener('change', () => {
                        document.getElementById('next-button').disabled = false;
                    });
                });
            } else {
                optionsContainer.innerHTML = '<p class="text-red-500">Aucune réponse disponible pour cette question.</p>';
            }

            document.getElementById('next-button').disabled = true;
        }

        document.getElementById('next-button').addEventListener('click', () => {
            const selectedAnswer = document.querySelector('input[name="answer"]:checked');
            if (!selectedAnswer) return;

            if (timerInterval) {
                clearInterval(timerInterval);
            }

            userAnswers[questions[currentQuestionIndex].id] =  selectedAnswer.value;
            console.log("test",userAnswers);
            

            if (currentQuestionIndex < questions.length - 1) {
                currentQuestionIndex++;
                showQuestion(currentQuestionIndex);
            } else {
                submitQuiz();
            }
        });

        function submitQuiz() {
            if (timerInterval) {
                clearInterval(timerInterval);
            }

            const formData = {
                quiz_id: quizId,
                answers: userAnswers,
                _token: document.querySelector('meta[name="csrf-token"]').content
            };
            console.log('aaaa',formData);
            
            fetch('/etudiant/answers/submit', {
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
                console.log("nnnnnn",data);
                if (data.success) {
                    window.location.href = data.redirect_url;
                } else {
                    console.error('Erreur:', error);
                    Swal.fire({
                    title: 'Erreur',
                    text: 'Une erreur est survenue lors  du quiz',
                    icon: 'error',
                    confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                Swal.fire({
                title: 'Erreur',
                text: 'Une erreur est survenue lors de la soumission du quiz',
                icon: 'error',
                confirmButtonText: 'OK'
                });
            });
        }

        showQuestion(currentQuestionIndex);
    </script>
@endsection