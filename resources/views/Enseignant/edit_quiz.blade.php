@extends('Enseignant.layout')

@section('title', 'Modifier Quiz')

@section('content')
    <!-- Background Patterns -->
    <div class="absolute -top-24 -right-24 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    <div class="absolute top-1/4 -left-24 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    <div class="absolute bottom-1/4 right-12 w-80 h-80 bg-pink-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    
    <div class="container mx-auto px-6 py-12 md:py-20 relative z-10">
        <div class="flex flex-col items-center justify-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Modifier le <span class="text-indigo-600">Quiz</span></h1>
            <p class="text-lg text-gray-600 text-center max-w-2xl">Modifiez les détails du quiz et ses questions à choix multiples (4 réponses par question).</p>
        </div>
        
        <div class="max-w-3xl mx-auto">
            <!-- Quiz Edit Form -->
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

                <form method="POST" action="{{ route('enseignant.quizzes.update', $quiz->id) }}" id="quiz-form">
                    @csrf
                    @method('PUT')
                    <!-- Quiz Details -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700">Titre du Quiz</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $quiz->title) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Entrez le titre du quiz" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-6">
                        <label for="course_id" class="block text-sm font-medium text-gray-700">Cours</label>
                        <select name="course_id" id="course_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            <option value="" disabled>Sélectionnez un cours</option>
                            <!-- Inclure le cours actuel du quiz -->
                            @if ($quiz->course)
                                <option value="{{ $quiz->course->id }}" {{ old('course_id', $quiz->course_id) == $quiz->course->id ? 'selected' : '' }}>{{ $quiz->course->title }}</option>
                            @endif
                            <!-- Inclure les autres cours sans quiz -->
                            @foreach ($courses as $course)
                                @if (!$quiz->course || $course->id != $quiz->course->id)
                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                                @endif
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
                        
                        <!-- Existing Questions -->
                        @foreach ($quiz->questions as $qIndex => $question)
                            <div class="question-block mb-8 border-t border-gray-200 pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Question {{ $qIndex + 1 }}</h3>
                                
                                <div class="mb-4">
                                    <label for="questions[{{ $qIndex }}][text]" class="block text-sm font-medium text-gray-700">Texte de la question</label>
                                    <textarea name="questions[{{ $qIndex }}][text]" id="questions[{{ $qIndex }}][text]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Entrez la question" required>{{ old("questions.$qIndex.text", $question->text) }}</textarea>
                                    @error("questions.$qIndex.text")
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="questions[{{ $qIndex }}][points]" class="block text-sm font-medium text-gray-700">Points</label>
                                        <input type="number" name="questions[{{ $qIndex }}][points]" id="questions[{{ $qIndex }}][points]" min="1" value="{{ old("questions.$qIndex.points", $question->points) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Points" required>
                                        @error("questions.$qIndex.points")
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="questions[{{ $qIndex }}][duration]" class="block text-sm font-medium text-gray-700">Durée (secondes)</label>
                                        <input type="number" name="questions[{{ $qIndex }}][duration]" id="questions[{{ $qIndex }}][duration]" min="1" value="{{ old("questions.$qIndex.duration", $question->duration) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Durée" required>
                                        @error("questions.$qIndex.duration")
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Answers -->
                                <div class="mb-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Réponses (sélectionnez la réponse correcte)</label>
                                    @foreach ($question->answers as $aIndex => $answer)
                                        <div class="flex items-center mb-3">
                                            <input type="radio" name="questions[{{ $qIndex }}][correct_answer]" value="{{ $aIndex }}" class="mr-2" {{ old("questions.$qIndex.correct_answer", $answer->is_correct ? $aIndex : null) == $aIndex ? 'checked' : '' }} required>
                                            <input type="text" name="questions[{{ $qIndex }}][answers][{{ $aIndex }}][text]" value="{{ old("questions.$qIndex.answers.$aIndex.text", $answer->text) }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Réponse {{ $aIndex + 1 }}" required>
                                            <input type="hidden" name="questions[{{ $qIndex }}][answers][{{ $aIndex }}][is_correct]" value="{{ old("questions.$qIndex.correct_answer", $answer->is_correct ? 1 : 0) == $aIndex ? '1' : '0' }}">
                                        </div>
                                        @error("questions.$qIndex.answers.$aIndex.text")
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    @endforeach
                                    @error("questions.$qIndex.correct_answer")
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Add Question Button -->
                    <button type="button" id="add-question-btn" class="mt-6 px-6 py-2 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 flex items-center">
                        <i class="ri-add-line mr-2"></i> Ajouter une question
                    </button>
                    
                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            Mettre à jour le Quiz
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Add question logic
        const addQuestionBtn = document.getElementById('add-question-btn');
        const questionsContainer = document.getElementById('questions-container');
        const questionTemplate = document.getElementById('question-template').content;

        let questionCount = {{ $quiz->questions->count() }};

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
                document.querySelectorAll(`input[name="questions[${questionIndex}][answers][0][is_correct]"]`).forEach(input => {
                    input.value = correctIndex == 0 ? '1' : '0';
                });
                document.querySelectorAll(`input[name="questions[${questionIndex}][answers][1][is_correct]"]`).forEach(input => {
                    input.value = correctIndex == 1 ? '1' : '0';
                });
                document.querySelectorAll(`input[name="questions[${questionIndex}][answers][2][is_correct]"]`).forEach(input => {
                    input.value = correctIndex == 2 ? '1' : '0';
                });
                document.querySelectorAll(`input[name="questions[${questionIndex}][answers][3][is_correct]"]`).forEach(input => {
                    input.value = correctIndex == 3 ? '1' : '0';
                });
            }
        });
    </script>
@endsection