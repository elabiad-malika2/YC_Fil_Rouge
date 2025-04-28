<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} - Course Details</title>
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

        .chapter-card {
            transition: all 0.3s ease;
        }

        .chapter-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .lesson-item {
            transition: background-color 0.2s ease;
        }

        .lesson-item:hover {
            background-color: #f1f5f9;
        }

        .accordion-toggle:checked + .accordion-content {
            max-height: 500px;
            opacity: 1;
            padding: 1rem;
        }

        .accordion-content {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.3s ease;
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
                        <div class="flex items-center space-x-2">
                            <img src="{{ Auth::user()->photo ? Storage::url(Auth::user()->photo) : 'https://cdn-icons-png.flaticon.com/512/219/219969.png' }}" alt="User" class="w-9 h-9 rounded-full border-2 border-indigo-200">
                            <span class="hidden md:block text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 text-gray-700 hover:text-indigo-600 transition-colors font-medium">Connexion</a>
                        <a href="{{ route('register.form') }}" class="px-5 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors font-medium">Inscription</a>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <section class="relative py-12 bg-gray-50">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-full h-64 bg-gradient-to-t from-indigo-50 to-transparent"></div>

        <div class="container mx-auto px-6">
            <!-- Notifications -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Quiz Results -->
            @if ($isEnrolled && $quizResult)
                <div class="glass-card p-6 rounded-2xl mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Résultat du Quiz</h2>
                    <p class="text-gray-600 mb-4">
                        Score : {{ $quizResult->score }} / {{ $quizResult->total_points }}
                        ({{ number_format(($quizResult->score / $quizResult->total_points) * 100, 2) }}%)
                    </p>
                    <p class="text-gray-600 mb-4">
                        Statut : 
                        <span class="{{ $quizResult->status === 'passed' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $quizResult->status === 'passed' ? 'Réussi' : 'Échoué' }}
                        </span>
                    </p>
                    <div class="flex space-x-4">
                        <a href="{{ route('quizzes.results', ['id' => $course->quiz->id]) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            Voir les détails
                        </a>
                        @if($quizResult->status === 'failed')
                            <a href="{{ route('quizzes.show', ['id' => $course->quiz->id]) }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                                Repasser le quiz
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Course Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Course Details -->
                <div class="lg:col-span-2">
                    <div class="glass-card p-6 rounded-2xl">
                        <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-64 object-cover rounded-lg mb-6">
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $course->title }}</h1>
                        <p class="text-gray-600 mb-6">{{ $course->description }}</p>
                        <div class="flex items-center mb-6">
                            <img src="{{ $course->teacher_photo }}" alt="{{ $course->teacher_name }}" class="w-12 h-12 rounded-full mr-3">
                            <div>
                                <span class="text-gray-700 font-medium">{{ $course->teacher_name }}</span>
                                <p class="text-sm text-gray-500">Instructor</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-6 text-sm text-gray-600 mb-6">
                            <div class="flex items-center">
                                <i class="ri-bookmark-line mr-2"></i>
                                <span>{{ $course->category->name }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="ri-time-line mr-2"></i>
                                <span>{{ $course->chapters->sum(function ($chapter) { return $chapter->lessons->count(); }) }} lessons</span>
                            </div>
                            <div class="flex items-center">
                                <i class="ri-wallet-line mr-2"></i>
                                <span>€{{ number_format($course->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enrollment Card -->
                <div class="lg:col-span-1">
                    <div class="glass-card p-6 rounded-2xl sticky top-24">
                        @if ($isEnrolled)
                            <h3 class="text-xl font-bold text-gray-800 mb-4">You're Enrolled!</h3>
                            <p class="text-gray-600 mb-6">You have full access to all course content. Start learning now!</p>
                            <a href="#course-content" class="block w-full py-3 bg-indigo-600 text-white rounded-lg text-center hover:bg-indigo-700 transition-colors font-medium mb-3">
                                View Content
                            </a>
                            @if ($course->quiz && !$quizResult)
                                <a href="{{ route('quizzes.show', $course->quiz->id) }}" class="block w-full py-3 bg-green-600 text-white rounded-lg text-center hover:bg-green-700 transition-colors font-medium">
                                    Passer le quiz
                                </a>
                            @endif
                        @else
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Enroll in This Course</h3>
                            <p class="text-gray-600 mb-6">Unlock all chapters and lessons for only €{{ number_format($course->price, 2) }}.</p>
                            @if (Auth::check() && Auth::user()->role->name === 'etudiant')
                                <div class="space-y-3">
                                    <a href="{{ route('payment.show', $course->id) }}" class="block w-full py-3 bg-indigo-600 text-white rounded-lg text-center hover:bg-indigo-700 transition-colors font-medium">
                                        Enroll Now (€{{ number_format($course->price, 2) }})
                                    </a>
                                    @if(Auth::user()->hasFavorited($course))
                                        <form action="{{ route('favorites.destroy', $course->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full py-3 bg-red-50 text-red-600 rounded-lg text-center hover:bg-red-100 transition-colors font-medium flex items-center justify-center">
                                                <i class="ri-heart-fill mr-2"></i>
                                                Retirer des favoris
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('favorites.store', $course->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full py-3 bg-gray-50 text-gray-600 rounded-lg text-center hover:bg-gray-100 transition-colors font-medium flex items-center justify-center">
                                                <i class="ri-heart-line mr-2"></i>
                                                Ajouter aux favoris
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @else
                                <p class="text-gray-500 mb-4">Please log in as a student to enroll.</p>
                                <a href="{{ route('login') }}" class="block w-full py-3 bg-gray-200 text-gray-700 rounded-lg text-center hover:bg-gray-300 transition-colors font-medium">
                                    Log In
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Course Content -->
            <div id="course-content" class="mt-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Course Content</h2>
                @if ($isEnrolled)
                    <!-- Full Content for Enrolled Users -->
                    <div class="space-y-4">
                        @forelse ($course->chapters as $chapter)
                            <div class="chapter-card glass-card rounded-xl overflow-hidden">
                                <label class="block cursor-pointer">
                                    <input type="checkbox" class="accordion-toggle hidden">
                                    <div class="flex items-center justify-between p-4 bg-indigo-50">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-800">{{ $chapter->title }}</h3>
                                            <p class="text-sm text-gray-500">{{ $chapter->lessons->count() }} lessons</p>
                                        </div>
                                        <i class="ri-arrow-down-s-line text-2xl text-indigo-600 transition-transform accordion-toggle:checked:rotate-180"></i>
                                    </div>
                                    <div class="accordion-content">
                                        <ul class="space-y-2">
                                            @foreach ($chapter->lessons as $lesson)
                                                <li class="lesson-item p-3 rounded-lg flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <i class="ri-play-circle-line text-indigo-600 mr-2"></i>
                                                        <span class="text-gray-700">{{ $lesson->title }}</span>
                                                    </div>
                                                    <span class="text-sm text-gray-500">Lesson {{ $loop->iteration }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </label>
                            </div>
                        @empty
                            <p class="text-gray-500">No chapters available for this course.</p>
                        @endforelse
                    </div>
                @else
                    <!-- Partial Content for Non-Enrolled Users -->
                    <div class="glass-card p-6 rounded-xl">
                        <p class="text-gray-600 mb-4">This course includes {{ $course->chapters->count() }} chapters and {{ $course->chapters->sum(function ($chapter) { return $chapter->lessons->count(); }) }} lessons.</p>
                        <ul class="space-y-2 mb-6">
                            @foreach ($course->chapters as $chapter)
                                <li class="flex items-center">
                                    <i class="ri-lock-line text-indigo-600 mr-2"></i>
                                    <span class="text-gray-700">{{ $chapter->title }} ({{ $chapter->lessons->count() }} lessons)</span>
                                </li>
                            @endforeach
                        </ul>
                        <p class="text-gray-500">Enroll now to unlock all chapters and lessons.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                            <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="ව
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
                        <li><a href="{{ route('courses.show') }}" class="text-gray-600 hover:text-indigo-600">Home</a></li>
                        <li><a href="{{ route('courses.show') }}" class="text-gray-600 hover:text-indigo-600">Courses</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Pricing</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Features</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Help Center</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">FAQs</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Contact Us</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-indigo-600">Terms of Service</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Subscribe</h3>
                    <p class="text-gray-600 mb-4">Subscribe to our newsletter to get the latest updates.</p>
                    <form action="#" method="POST" class="flex flex-col space-y-3">
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
</body>
</html>