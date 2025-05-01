<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="../assets/scripts/login.js" defer></script>
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
                        <i class="ri-phone-line mr-2"></i> +212 234-234-234
                    </span>
                    <span class="flex items-center">
                        <i class="ri-mail-line mr-2"></i> contact@e-learning.com
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-sm ">
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
                
                <div class="flex items-center space-x-4">
                    <a href="./login" class="hidden md:block px-5 py-2 text-gray-700 hover:text-indigo-600 transition-colors font-medium">
                        Login
                    </a>
                    <a href="./register" class="hidden md:block px-5 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors font-medium">
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
                    <div class="mt-6 space-y-4 px-4">
                        <a href="./login" class="block w-full py-3 text-center bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition-colors">
                            Login
                        </a>
                        <a href="./register" class="block w-full py-3 text-center bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            Register
                        </a>
                    </div>
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
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                <!-- Left Content Area -->
                <div class="w-full md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Welcome Back to <span class="text-indigo-600">E-Learning</span></h1>
                    <p class="text-lg text-gray-600 mb-8">Continue your learning journey with access to your courses, materials, and community. We're excited to see you again!</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="flex items-center gap-3 p-4 bg-white rounded-lg shadow-sm border border-gray-100">
                            <div class="bg-indigo-100 p-3 rounded-full">
                                <i class="ri-time-line text-xl text-indigo-600"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-800">Learn at Your Pace</h3>
                                <p class="text-sm text-gray-500">24/7 access</p>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-gray-600">Don't have an account yet? <a href="./register" class="text-indigo-600 font-medium hover:underline">Sign up </a> and join our learning community.</p>
                </div>
                
                <!-- Login Form -->
                <div class="w-full md:w-5/12">
                    <div class="glass-card p-8 md:p-10 shadow-xl">
                        <div class="flex items-center justify-center mb-8">
                            <h2 class="text-2xl font-bold text-gray-800">Log In to Your Account</h2>
                        </div>
                        @if ($errors->any())
                            <div class="mb-4 text-red-500">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST" id="loginForm">
                            @csrf
                            <div class="space-y-6">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <i class="ri-mail-line text-gray-400"></i>
                                    </div>
                                    <input type="email" placeholder="Email Address" name="email" required
                                        class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                                </div>
                                
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <i class="ri-lock-line text-gray-400"></i>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                        <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-600">
                                            <i class="ri-eye-line text-lg password-toggle-icon"></i>
                                        </button>
                                    </div>
                                    <input type="password" placeholder="Password" name="password" id="passwordField" required
                                        class="w-full pl-12 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                                </div>
                                
                                <button type="submit" class="w-full py-3 px-6 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors font-medium">
                                    Log In
                                </button>
                            </div>
                        </form>
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
            
            <div class="border-t border-gray-200 mt-10 pt-6">
                <p class="text-center text-gray-600 text-sm">
                    &copy; 2025 E-Learning Platform. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const closeSidebarBtn = document.getElementById('close-sidebar');
            const sidebarMenu = document.getElementById('sidebar-menu');
            const togglePasswordBtn = document.getElementById('togglePassword');
            const passwordField = document.getElementById('passwordField');
            const passwordToggleIcon = document.querySelector('.password-toggle-icon');
            
            mobileMenuBtn.addEventListener('click', function() {
                sidebarMenu.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
            
            closeSidebarBtn.addEventListener('click', function() {
                sidebarMenu.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });
            
            // Password visibility toggle
            togglePasswordBtn.addEventListener('click', function() {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    passwordToggleIcon.classList.remove('ri-eye-line');
                    passwordToggleIcon.classList.add('ri-eye-off-line');
                } else {
                    passwordField.type = 'password';
                    passwordToggleIcon.classList.remove('ri-eye-off-line');
                    passwordToggleIcon.classList.add('ri-eye-line');
                }
            });
        });
    </script>
</body>

</html> 