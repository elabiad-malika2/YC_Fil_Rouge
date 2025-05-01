@extends('Etudiant.layout')

@section('title', 'Mes Résultats de Quiz - E-Learning')

@section('content')
    <!-- Page Header -->
    <section class="page-header py-12">
        <div class="container mx-auto px-6">
            <div class="page-header-content">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div class="mb-6 md:mb-0">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center">
                                <i class="ri-file-list-3-line text-2xl text-blue-600"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-800">Mes Résultats de Quiz</h1>
                                <p class="text-gray-500 mt-1">Consultez vos performances aux quiz</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Results Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            @if($quizResults->isEmpty())
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="ri-file-list-3-line text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-800 mb-2">Aucun résultat de quiz</h3>
                    <p class="text-gray-500">Vous n'avez pas encore passé de quiz.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($quizResults as $result)
                        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-800">{{ $result->quiz->title }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">{{ $result->quiz->course->title }}</p>
                                </div>
                                <div class="w-12 h-12 rounded-full flex items-center justify-center {{ $result->score_percentage >= 70 ? 'bg-green-100 text-green-600' : ($result->score_percentage >= 50 ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600') }}">
                                    <span class="text-lg font-bold">{{ $result->score_percentage}}%</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Date</span>
                                    <span class="text-gray-800">{{ $result->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Questions</span>
                                    <span class="text-gray-800">{{ $result->total_questions }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Réponses correctes</span>
                                    <span class="text-green-600 font-medium">{{ $result->correct_answers }}</span>
                                </div>
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('etudiant.quizzes.results', $result->quiz_id) }}" class="w-full bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors rounded-lg py-2 px-4 flex items-center justify-center space-x-2">
                                    <i class="ri-eye-line"></i>
                                    <span>Voir les détails</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection 