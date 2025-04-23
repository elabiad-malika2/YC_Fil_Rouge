<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Platform - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="../assets/scripts/home.js" defer></script>
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
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        
        

        

        

        .testimonial-card {
            transition: transform 0.3s ease-in-out;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
        }

        .course-card {
            transition: transform 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-8px);
        }

        .category-card {
            transition: all 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .counter-box {
            visibility: hidden;
        }

        .counter-box.visible {
            visibility: visible;
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
                <a href="./index.php" class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-xl font-bold text-gray-800">E-Learning</span>
                </a>
                
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="./index.php" class="text-indigo-600 hover:text-indigo-800 transition-colors font-medium">Home</a>
                    <a href="./courses.php" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Courses</a>
                    <a href="./pricing.php" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Pricing</a>
                    <a href="./features.php" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Features</a>
                    <a href="./blog.php" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Blog</a>
                    <a href="./contact.php" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Help Center</a>
                </nav>
                
                <div class="flex items-center space-x-4">
                    <a href="./login.php" class="hidden md:block px-5 py-2 text-gray-700 hover:text-indigo-600 transition-colors font-medium">
                        Login
                    </a>
                    <a href="./register.php" class="hidden md:block px-5 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors font-medium">
                        Register
                    </a>
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
                <nav class="flex flex-col px-5 py-6">
                    <a href="./index.php" class="py-3 px-4 rounded-lg text-indigo-600 bg-indigo-50 font-medium">Home</a>
                    <a href="./courses.php" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Courses</a>
                    <a href="./pricing.php" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Pricing</a>
                    <a href="./features.php" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Features</a>
                    <a href="./blog.php" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Blog</a>
                    <a href="./contact.php" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Help Center</a>
                    
                    <div class="mt-6 space-y-4 px-4">
                        <a href="./login.php" class="block w-full py-3 text-center bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition-colors">
                            Login
                        </a>
                        <a href="./register.php" class="block w-full py-3 text-center bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            Register
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gray-50">
        <!-- Background Patterns -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-full h-64 bg-gradient-to-t from-indigo-50 to-transparent"></div>
        
        <div class="container mx-auto px-6 py-12 md:py-20 lg:py-24">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="w-full md:w-1/2 z-10">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-800 mb-6">
                        Learn Without <span class="text-indigo-600">Limits</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8">
                        Unlock your potential with our expert-led courses. Anytime, anywhere learning for everyone.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <a href="./courses.php" class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium text-center">
                            Explore Courses
                        </a>
                        <a href="./register.php" class="px-8 py-3 bg-white text-indigo-600 border border-indigo-200 rounded-lg hover:bg-indigo-50 transition-colors font-medium text-center">
                            Join for Free
                        </a>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-2">
                            <img src="https://media.istockphoto.com/id/1059510610/fr/vectoriel/r%C3%A9seau-internet-communication-e-learning-it-comme-la-base-de-connaissances.jpg?s=612x612&w=0&k=20&c=ekWQ--S1W9xWxgqH-oH0LKFDuvcz5is-AyxgjIAqmzg=" alt="User" class="w-9 h-9 rounded-full border-2 border-white">
                            <img src="https://media.istockphoto.com/id/1059510610/fr/vectoriel/r%C3%A9seau-internet-communication-e-learning-it-comme-la-base-de-connaissances.jpg?s=612x612&w=0&k=20&c=ekWQ--S1W9xWxgqH-oH0LKFDuvcz5is-AyxgjIAqmzg=" alt="User" class="w-9 h-9 rounded-full border-2 border-white">
                            <img src="https://media.istockphoto.com/id/1059510610/fr/vectoriel/r%C3%A9seau-internet-communication-e-learning-it-comme-la-base-de-connaissances.jpg?s=612x612&w=0&k=20&c=ekWQ--S1W9xWxgqH-oH0LKFDuvcz5is-AyxgjIAqmzg=" alt="User" class="w-9 h-9 rounded-full border-2 border-white">
                            <img src="https://media.istockphoto.com/id/1059510610/fr/vectoriel/r%C3%A9seau-internet-communication-e-learning-it-comme-la-base-de-connaissances.jpg?s=612x612&w=0&k=20&c=ekWQ--S1W9xWxgqH-oH0LKFDuvcz5is-AyxgjIAqmzg=" alt="User" class="w-9 h-9 rounded-full border-2 border-white">
                        </div>
                        <div class="text-sm text-gray-600">
                            <span class="font-semibold text-indigo-600">25,000+</span> students already learning
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 z-10">
                    <div class="relative">
                        <div class="absolute -top-5 -right-5 w-32 h-32 bg-indigo-100 rounded-full"></div>
                        <div class="absolute -bottom-5 -left-5 w-24 h-24 bg-purple-100 rounded-full"></div>
                        <div class="glass-card p-4 rounded-2xl shadow-xl">
                            <img src="https://media.istockphoto.com/id/1059510610/fr/vectoriel/r%C3%A9seau-internet-communication-e-learning-it-comme-la-base-de-connaissances.jpg?s=612x612&w=0&k=20&c=ekWQ--S1W9xWxgqH-oH0LKFDuvcz5is-AyxgjIAqmzg=" alt="Learning Platform" class="w-full h-auto rounded-lg">
                            <div class="absolute bottom-6 left-10 right-10 bg-white p-4 rounded-lg shadow-lg">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="font-bold text-gray-800">Web Development</h3>
                                        <p class="text-sm text-gray-500">Master modern web development</p>
                                    </div>
                                    <div class="bg-indigo-100 p-2 rounded-full">
                                        <i class="ri-play-circle-line text-2xl text-indigo-600"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class=" bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-12">
                <div class="counter-box text-center">
                    <span class="counter text-4xl font-bold text-indigo-600" data-target="5000">0</span>
                    <span class="text-4xl font-bold text-indigo-600">+</span>
                    <p class="text-gray-600 mt-2">Online Courses</p>
                </div>
                <div class="counter-box text-center">
                    <span class="counter text-4xl font-bold text-indigo-600" data-target="250">0</span>
                    <span class="text-4xl font-bold text-indigo-600">+</span>
                    <p class="text-gray-600 mt-2">Expert Instructors</p>
                </div>
                <div class="counter-box text-center">
                    <span class="counter text-4xl font-bold text-indigo-600" data-target="25000">0</span>
                    <span class="text-4xl font-bold text-indigo-600">+</span>
                    <p class="text-gray-600 mt-2">Active Students</p>
                </div>
                <div class="counter-box text-center">
                    <span class="counter text-4xl font-bold text-indigo-600" data-target="99">0</span>
                    <span class="text-4xl font-bold text-indigo-600">%</span>
                    <p class="text-gray-600 mt-2">Satisfaction Rate</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Explore Top Categories</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Discover the perfect course from our diverse range of subjects taught by industry experts
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <a href="./courses.php?category=development" class="category-card bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                    <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ri-code-s-slash-line text-2xl text-indigo-600"></i>
                    </div>
                    <h3 class="font-medium text-gray-800">Development</h3>
                    <p class="text-sm text-gray-500 mt-1">850+ Courses</p>
                </a>
                <a href="./courses.php?category=business" class="category-card bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ri-line-chart-line text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="font-medium text-gray-800">Business</h3>
                    <p class="text-sm text-gray-500 mt-1">720+ Courses</p>
                </a>
                <a href="./courses.php?category=design" class="category-card bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                    <div class="bg-pink-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ri-pen-nib-line text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="font-medium text-gray-800">Design</h3>
                    <p class="text-sm text-gray-500 mt-1">540+ Courses</p>
                </a>
                <a href="./courses.php?category=marketing" class="category-card bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ri-megaphone-line text-2xl text-green-600"></i>
                    </div>
                    <h3 class="font-medium text-gray-800">Marketing</h3>
                    <p class="text-sm text-gray-500 mt-1">430+ Courses</p>
                </a>
                <a href="./courses.php?category=music" class="category-card bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ri-music-2-line text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="font-medium text-gray-800">Music</h3>
                    <p class="text-sm text-gray-500 mt-1">320+ Courses</p>
                </a>
                <a href="./courses.php?category=photography" class="category-card bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                    <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ri-camera-line text-2xl text-yellow-600"></i>
                    </div>
                    <h3 class="font-medium text-gray-800">Photography</h3>
                    <p class="text-sm text-gray-500 mt-1">290+ Courses</p>
                </a>
            </div>
            
            <div class="text-center mt-10">
                <a href="./courses.php" class="inline-flex items-center text-indigo-600 font-medium hover:text-indigo-800 transition-colors">
                    View All Categories
                    <i class="ri-arrow-right-line ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Courses -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Popular Courses</h2>
                    <p class="text-lg text-gray-600">
                        Expand your skills with our most in-demand courses
                    </p>
                </div>
                <div class="mt-6 md:mt-0">
                    <a href="./courses.php" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                        Browse All Courses
                    </a>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Course Card 1 -->
                <div class="course-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="relative">
                        <img src="https://bilis.com/wp-content/uploads/2020/04/elearning.jpg" alt="JavaScript Course" class="w-full h-56 object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="bg-indigo-600 text-white text-xs font-medium px-3 py-1 rounded-full">Bestseller</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">Development</span>
                            <div class="flex items-center">
                                <i class="ri-star-fill text-yellow-400"></i>
                                <span class="text-sm font-medium text-gray-800 ml-1">4.9</span>
                                <span class="text-sm text-gray-500 ml-1">(2.5k)</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Modern JavaScript from Scratch</h3>
                        <p class="text-gray-600 mb-4">Master JavaScript with projects, challenges and theory. ES6+, OOP, AJAX, Webpack</p>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <div class="flex items-center mr-4">
                                <i class="ri-time-line mr-2"></i>
                                <span>42 hours</span>
                            </div>
                            <div class="flex items-center">
                                <i class="ri-file-list-3-line mr-2"></i>
                                <span>28 lessons</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center">
                                <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="Instructor" class="w-9 h-9 rounded-full">
                                <span class="text-sm font-medium text-gray-700 ml-2">Sarah Johnson</span>
                            </div>
                            <span class="text-xl font-bold text-gray-800">$89.99</span>
                        </div>
                    </div>
                </div>
                
                <!-- Course Card 2 -->
                <div class="course-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="relative">
                        <img src="https://bilis.com/wp-content/uploads/2020/04/elearning.jpg" alt="React Course" class="w-full h-56 object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="bg-green-600 text-white text-xs font-medium px-3 py-1 rounded-full">New</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">Development</span>
                            <div class="flex items-center">
                                <i class="ri-star-fill text-yellow-400"></i>
                                <span class="text-sm font-medium text-gray-800 ml-1">4.8</span>
                                <span class="text-sm text-gray-500 ml-1">(1.8k)</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">React - The Complete Guide 2025</h3>
                        <p class="text-gray-600 mb-4">Learn React from the ground up - build powerful, responsive UIs with React Hooks & Redux</p>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <div class="flex items-center mr-4">
                                <i class="ri-time-line mr-2"></i>
                                <span>48 hours</span>
                            </div>
                            <div class="flex items-center">
                                <i class="ri-file-list-3-line mr-2"></i>
                                <span>32 lessons</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center">
                                <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="Instructor" class="w-9 h-9 rounded-full">
                                <span class="text-sm font-medium text-gray-700 ml-2">Michael Chen</span>
                            </div>
                            <span class="text-xl font-bold text-gray-800">$94.99</span>
                        </div>
                    </div>
                </div>
                
                <!-- Course Card 3 -->
                <div class="course-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="relative">
                        <img src="https://bilis.com/wp-content/uploads/2020/04/elearning.jpg" alt="Digital Marketing Course" class="w-full h-56 object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="bg-purple-600 text-white text-xs font-medium px-3 py-1 rounded-full">Popular</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-green-600 bg-green-50 px-3 py-1 rounded-full">Marketing</span>
                            <div class="flex items-center">
                                <i class="ri-star-fill text-yellow-400"></i>
                                <span class="text-sm font-medium text-gray-800 ml-1">4.7</span>
                                <span class="text-sm text-gray-500 ml-1">(3.2k)</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Complete Digital Marketing Masterclass</h3>
                        <p class="text-gray-600 mb-4">Master digital marketing strategy, social media, SEO, YouTube, email, Facebook marketing & more!</p>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <div class="flex items-center mr-4">
                                <i class="ri-time-line mr-2"></i>
                                <span>38 hours</span>
                            </div>
                            <div class="flex items-center">
                                <i class="ri-file-list-3-line mr-2"></i>
                                <span>24 lessons</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center">
                                <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="Instructor" class="w-9 h-9 rounded-full">
                                <span class="text-sm font-medium text-gray-700 ml-2">Olivia Martinez</span>
                            </div>
                            <span class="text-xl font-bold text-gray-800">$79.99</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50 relative overflow-hidden">
        <!-- Background Patterns -->
        <div class="absolute top-1/3 -right-24 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
        <div class="absolute bottom-1/3 -left-24 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
        
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Why Choose Our Platform</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    We provide a comprehensive learning experience designed to help you achieve your goals
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="feature-card p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="bg-indigo-100 w-14 h-14 rounded-full flex items-center justify-center mb-6">
                        <i class="ri-device-line text-2xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Learn Anywhere</h3>
                    <p class="text-gray-600">
                        Access our platform from any device with our responsive design and dedicated mobile app
                    </p>
                </div>
                
                <div class="feature-card p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="bg-blue-100 w-14 h-14 rounded-full flex items-center justify-center mb-6">
                        <i class="ri-user-voice-line text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Expert Instructors</h3>
                    <p class="text-gray-600">
                        Learn from industry professionals with real-world experience and proven teaching methods
                    </p>
                </div>
                
                <div class="feature-card p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="bg-green-100 w-14 h-14 rounded-full flex items-center justify-center mb-6">
                        <i class="ri-group-line text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Community Support</h3>
                    <p class="text-gray-600">
                        Join our active community of learners to share insights, ask questions, and grow together
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">What Our Students Say</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Discover how our courses have transformed careers and lives
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="testimonial-card p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center mb-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="Student" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h4 class="font-medium text-gray-800">James Wilson</h4>
                            <p class="text-sm text-gray-500">Web Developer</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-2">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                    </div>
                    <p class="text-gray-600">
                        "The JavaScript course was exactly what I needed to level up my skills. The projects were challenging but achievable, and the instructor's explanations were clear and concise."
                    </p>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="testimonial-card p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center mb-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="Student" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h4 class="font-medium text-gray-800">Emily Rodriguez</h4>
                            <p class="text-sm text-gray-500">Marketing Specialist</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-2">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                    </div>
                    <p class="text-gray-600">
                        "The Digital Marketing Masterclass completely transformed my approach to online marketing. I've implemented several strategies and seen incredible results for my business."
                    </p>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="testimonial-card p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center mb-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="Student" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h4 class="font-medium text-gray-800">David Park</h4>
                            <p class="text-sm text-gray-500">UX Designer</p>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 mb-2">
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-fill"></i>
                        <i class="ri-star-half-fill"></i>
                    </div>
                    <p class="text-gray-600">
                        "The design courses here are top-notch. I've taken several and each one has added valuable skills to my portfolio. The instructors are responsive and the community is supportive."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-indigo-600 text-white">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6">Start Your Learning Journey Today</h2>
                <p class="text-lg mb-8 opacity-90">
                    Join over 25,000 students already learning with us. Get access to all our courses with a premium membership.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="./signup.php" class="px-8 py-4 bg-white text-indigo-600 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                        Sign Up Now
                    </a>
                    <a href="./courses.php" class="px-8 py-4 bg-transparent border border-white text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                        Browse Courses
                    </a>
                </div>
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
                        <li><a href="./index.php" class="text-gray-600 hover:text-indigo-600">Home</a></li>
                        <li><a href="./courses.php" class="text-gray-600 hover:text-indigo-600">Courses</a></li>
                        <li><a href="./pricing.php" class="text-gray-600 hover:text-indigo-600">Pricing</a></li>
                        <li><a href="./features.php" class="text-gray-600 hover:text-indigo-600">Features</a></li>
                        <li><a href="./blog.php" class="text-gray-600 hover:text-indigo-600">Blog</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="./help.php" class="text-gray-600 hover:text-indigo-600">Help Center</a></li>
                        <li><a href="./faq.php" class="text-gray-600 hover:text-indigo-600">FAQs</a></li>
                        <li><a href="./contact.php" class="text-gray-600 hover:text-indigo-600">Contact Us</a></li>
                        <li><a href="./privacy.php" class="text-gray-600 hover:text-indigo-600">Privacy Policy</a></li>
                        <li><a href="./terms.php" class="text-gray-600 hover:text-indigo-600">Terms of Service</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Subscribe</h3>
                    <p class="text-gray-600 mb-4">Subscribe to our newsletter to get the latest updates.</p>
                    <form action="../Back-end/Actions/Newsletter/subscribe.php" method="POST" class="flex flex-col space-y-3">
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
                    &copy; 2025 E-Learning Platform. All rights reserved.
                </p>
            </div>
        </div>
    </footer>


</body>
</html>