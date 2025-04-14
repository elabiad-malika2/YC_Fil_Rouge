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
                <a href="../index.php" class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-xl font-bold text-gray-800">E-Learning</span>
                </a>
                
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="./index.php" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Home</a>
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
                    <a href="./index.php" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Home</a>
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
                        <div class="flex items-center gap-3 p-4 bg-white rounded-lg shadow-sm border border-gray-100">
                            <div class="bg-indigo-100 p-3 rounded-full">
                                <i class="ri-wallet-3-line text-xl text-indigo-600"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-800">Money-back Guarantee</h3>
                                <p class="text-sm text-gray-500">30-day refund policy</p>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-gray-600">Don't have an account yet? <a href="./register.php" class="text-indigo-600 font-medium hover:underline">Sign up for free</a> and join our learning community.</p>
                </div>
                
                <!-- Login Form -->
                <div class="w-full md:w-5/12">
                    <div class="glass-card p-8 md:p-10 shadow-xl">
                        <div class="flex items-center justify-center mb-8">
                            <h2 class="text-2xl font-bold text-gray-800">Log In to Your Account</h2>
                        </div>
                        
                        <form action="../Back-end/Actions/Auth/auth.php" method="POST" id="loginForm">
                            <div class="space-y-6">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <i class="ri-mail-line text-gray-400"></i>
                                    </div>
                                    <input type="email" placeholder="Email Address" name="emailLogin" required
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
                                    <input type="password" placeholder="Password" name="passwordLogin" id="passwordField" required
                                        class="w-full pl-12 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="rememberMe" name="rememberMe" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        <label for="rememberMe" class="ml-2 block text-sm text-gray-600">
                                            Remember me
                                        </label>
                                    </div>
                                    <div>
                                        <a href="./forgot-password.php" class="text-sm text-indigo-600 hover:underline">
                                            Forgot password?
                                        </a>
                                    </div>
                                </div>
                                
                                <button type="submit" class="w-full py-3 px-6 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors font-medium">
                                    Log In
                                </button>
                            </div>
                        </form>
                        
                        <div class="mt-8">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">Or continue with</span>
                                </div>
                            </div>
                            
                            <div class="mt-6 grid grid-cols-2 gap-3">
                                <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.283 10.356h-8.327v3.451h4.792c-.446 2.193-2.313 3.453-4.792 3.453a5.27 5.27 0 0 1-5.279-5.28 5.27 5.27 0 0 1 5.279-5.279c1.259 0 2.397.447 3.29 1.178l2.6-2.599c-1.584-1.381-3.615-2.233-5.89-2.233a8.908 8.908 0 0 0-8.934 8.934 8.907 8.907 0 0 0 8.934 8.934c4.467 0 8.529-3.249 8.529-8.934 0-.528-.081-1.097-.202-1.625z" fill="#4285F4"/>
                                        <path d="M12.297 14.558v-4.202h3.957c-.356 1.234-1.449 2.099-2.724 2.099-.777 0-1.487-.294-2.004-.77l-2.366 1.85c1.07 1.058 2.539 1.712 4.2 1.712 3.04 0 5.576-2.456 5.576-5.498 0-.76-.151-1.485-.421-2.146H7.932v2.142h4.365z" fill="#EA4335"/>
                                        <path d="M12.297 14.558c-1.657 0-3.126-.651-4.197-1.712l-2.366 1.85c1.505 1.501 3.57 2.423 5.83 2.423 4.467 0 8.529-3.249 8.529-8.934 0-.528-.081-1.097-.202-1.625H12.29v4.203l4.372-.001c-.356 1.234-1.449 2.099-2.724 2.099l-1.641.003v1.693z" fill="#34A853"/>
                                        <path d="M8.1 12.846c-.507-.653-.814-1.456-.814-2.331s.307-1.678.814-2.331l-2.366-1.85a8.142 8.142 0 0 0-1.614 4.181c0 1.56.55 2.988 1.463 4.112l2.517-1.781z" fill="#FBBC05"/>
                                    </svg>
                                    Google
                                </a>
                                
                                <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z" fill="#3B5998"/>
                                    </svg>
                                    Facebook
                                </a>
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