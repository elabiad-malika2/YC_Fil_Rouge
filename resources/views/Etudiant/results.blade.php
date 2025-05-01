@extends('Etudiant.layout')

@section('title', 'Résultats du Quiz - {{ $quiz->title }}')

@section('styles')
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <main class="min-h-screen py-12">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <!-- Résultat Global -->
                <div class="glass-card p-8 mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-6">Résultats du Quiz : {{ $quiz->title }}</h1>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-semibold text-gray-800">Score Final</h3>
                                <i class="ri-trophy-line text-2xl text-yellow-500"></i>
                            </div>
                            <p class="text-3xl font-bold {{ ($result->score / $result->total_points) >= 0.7 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $result->score }}/{{ $result->total_points }}
                            </p>
                            <p class="text-gray-500 text-sm">
                                ({{ number_format(($result->score / $result->total_points) * 100, 1) }}%)
                            </p>
                        </div>
                        
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-semibold text-gray-800">Statut</h3>
                                <i class="ri-checkbox-circle-line text-2xl {{ $result->status === 'passed' ? 'text-green-500' : 'text-red-500' }}"></i>
                            </div>
                            <p class="text-2xl font-bold {{ $result->status === 'passed' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $result->status === 'passed' ? 'Réussi' : 'Échoué' }}
                            </p>
                            <p class="text-gray-500 text-sm">Score minimum requis : 70%</p>
                        </div>
                        
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-semibold text-gray-800">Date</h3>
                                <i class="ri-calendar-line text-2xl text-indigo-500"></i>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">
                                {{ $result->created_at->format('d/m/Y') }}
                            </p>
                            <p class="text-gray-500 text-sm">{{ $result->created_at->format('H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Détail des Réponses -->
                <div class="glass-card p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Détail des Réponses</h2>
                    
                    <div class="space-y-6">
                        @foreach($answers as $answer)
                            <div class="bg-white rounded-lg p-6 shadow-sm">
                                <div class="flex items-start justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800">Question {{ $loop->iteration }}</h3>
                                    <span class="px-3 py-1 rounded-full {{ $answer->is_correct ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $answer->is_correct ? 'Correct' : 'Incorrect' }}
                                    </span>
                                </div>
                                
                                <p class="text-gray-700 mb-4">{{ $answer->answer->question->text }}</p>
                                
                                <div class="space-y-2">
                                    @foreach($answer->answer->question->answers as $option)
                                        <div class="flex items-center p-3 rounded-lg {{ $option->is_correct ? 'bg-green-50 border border-green-200' : ($option->id === $answer->answer_id && !$answer->is_correct ? 'bg-red-50 border border-red-200' : 'bg-gray-50 border border-gray-200') }}">
                                            <span class="w-6 h-6 flex items-center justify-center rounded-full {{ $option->is_correct ? 'bg-green-500 text-white' : ($option->id === $answer->answer_id && !$answer->is_correct ? 'bg-red-500 text-white' : 'bg-gray-200') }} mr-3">
                                                @if($option->is_correct)
                                                    <i class="ri-check-line"></i>
                                                @elseif($option->id === $answer->answer_id && !$answer->is_correct)
                                                    <i class="ri-close-line"></i>
                                                @endif
                                            </span>
                                            <span class="text-gray-700">{{ $option->text }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Boutons d'Action -->
                <div class="flex justify-center mt-8 space-x-4">
                    <a href="{{ route('courses.show') }}" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                        Retour aux cours
                    </a>

                </div>
            </div>
        </div>
    </main>
@endsection