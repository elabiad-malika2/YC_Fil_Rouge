<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} - Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
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

        .course-image {
            transition: transform 0.3s ease;
        }

        .course-image:hover {
            transform: scale(1.03);
        }

        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            background-color: white;
        }

        .StripeElement--focus {
            border-color: #6366F1;
            box-shadow: 0 1px 3px 0 rgba(99, 102, 241, 0.2);
        }

        .StripeElement--invalid {
            border-color: #EF4444;
        }

        .StripeElement--webkit-autofill {
            background-color: #F9FAFB !important;
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
                <a href="{{ route('courses.show') }}" class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="currentColor" />
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-xl font-bold text-gray-800">E-Learning</span>
                </a>
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('courses.show') }}" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Home</a>
                    <a href="{{ route('courses.show') }}" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Courses</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Pricing</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Features</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Blog</a>
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">Help Center</a>
                </nav>
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
                        <a href="{{ route('login') }}" class="hidden md:block px-5 py-2 text-gray-700 hover:text-indigo-600 transition-colors font-medium">Connexion</a>
                        <a href="{{ route('register.form') }}" class="hidden md:block px-5 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors font-medium">Inscription</a>
                    @endif
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
                    <a href="{{ route('courses.show') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Home</a>
                    <a href="{{ route('courses.show') }}" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Courses</a>
                    <a href="#" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Pricing</a>
                    <a href="#" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Features</a>
                    <a href="#" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Blog</a>
                    <a href="#" class="py-3 px-4 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition-colors">Help Center</a>
                    <div class="mt-6 space-y-4 px-4">
                        <a href="{{ route('login') }}" class="block w-full py-3 text-center bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition-colors">Connexion</a>
                        <a href="{{ route('register.form') }}" class="block w-full py-3 text-center bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">Inscription</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Page Title -->
    <section class="py-12 gradient-bg text-white">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-bold mb-2">Secure Checkout</h1>
            <div class="flex items-center text-sm">
                <a href="{{ route('courses.show') }}" class="hover:underline">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('courses.show') }}" class="hover:underline">Courses</a>
                <span class="mx-2">/</span>
                <span>Payment</span>
            </div>
        </div>
    </section>

    <!-- Payment Section -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif
            <div class="flex flex-col lg:flex-row gap-10">
                <!-- Payment Form -->
                <div class="w-full lg:w-2/3 order-2 lg:order-1">
                    <div class="glass-card p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Payment Information</h2>
                        <form id="payment-form" action="{{ route('payment.process', $course->id) }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="payment_intent_id" id="payment-intent-id" value="{{ $intent->id }}">
                            <!-- Stripe Card Element -->
                            <div>
                                <label for="card-element" class="block text-sm font-medium text-gray-700 mb-1">Credit or Debit Card</label>
                                <div id="card-element" class="mt-1"></div>
                                <div id="card-errors" role="alert" class="text-red-600 text-sm mt-2"></div>
                            </div>
                            <!-- Submit Button -->
                            <button type="submit" id="pay-button" class="w-full py-3 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center">
                                <i class="ri-secure-payment-line mr-2"></i>
                                Pay €{{ number_format($course->price, 2) }}
                            </button>
                            <!-- Security Note -->
                            <div class="flex items-center justify-center text-sm text-gray-500 mt-6">
                                <i class="ri-lock-line mr-2"></i>
                                <span>Your payment information is secure. We use SSL encryption for all transactions.</span>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Order Summary -->
                <div class="w-full lg:w-1/3 order-1 lg:order-2">
                    <div class="glass-card p-6 sticky top-24">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Order Summary</h2>
                        <!-- Course Info -->
                        <div class="flex mb-4 pb-4 border-b border-gray-100">
                            <div class="w-20 h-20 overflow-hidden rounded-lg flex-shrink-0">
                                <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="w-full h-full object-cover course-image">
                            </div>
                            <div class="ml-4">
                                <h3 class="font-medium text-gray-800">{{ $course->title }}</h3>
                                <p class="text-sm text-gray-500">{{ $course->chapters->sum(function ($chapter) { return $chapter->lessons->count(); }) }} lessons • All levels</p>
                                <div class="flex items-center mt-1">
                                    <i class="ri-star-fill text-yellow-400 text-sm"></i>
                                    <span class="text-sm font-medium text-gray-800 ml-1">4.9</span>
                                    <span class="text-xs text-gray-500 ml-1">(2.5k reviews)</span>
                                </div>
                            </div>
                        </div>
                        <!-- Price Details -->
                        <div class="space-y-3 pb-4 border-b border-gray-100">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Course Price</span>
                                <span class="text-gray-800">€{{ number_format($course->price, 2) }}</span>
                            </div>
                        </div>
                        <!-- Total -->
                        <div class="flex justify-between pt-4 mb-6">
                            <span class="font-medium text-gray-800">Total</span>
                            <span class="font-bold text-gray-800 text-xl">€{{ number_format($course->price, 2) }}</span>
                        </div>
                        <!-- Course Access Info -->
                        <div class="bg-indigo-50 p-4 rounded-lg mb-6">
                            <h4 class="font-medium text-indigo-800 mb-2">What you'll get</h4>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li class="flex items-center">
                                    <i class="ri-check-line text-green-600 mr-2"></i>
                                    Full lifetime access
                                </li>
                                <li class="flex items-center">
                                    <i class="ri-check-line text-green-600 mr-2"></i>
                                    Access on mobile and desktop
                                </li>
                                <li class="flex items-center">
                                    <i class="ri-check-line text-green-600 mr-2"></i>
                                    Certificate of completion
                                </li>
                            </ul>
                        </div>
                        <!-- Money Back Guarantee -->
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="ri-refund-2-line mr-2 text-green-600"></i>
                            30-day money-back guarantee
                        </div>
                    </div>
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
                            <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stripe-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-xl font-bold text-gray-800">E-Learning</span>
                    </div>
                    <p class="text-gray-600 mb-4">Transform your life through education with our online learning platform.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-indigo-600"><i class="ri-facebook-fill text-xl"></i></a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600"><i class="ri-twitter-fill text-xl"></i></a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600"><i class="ri-instagram-fill text-xl"></i></a>
                        <a href="#" class="text-gray-500 hover:text-indigo-600"><i class="ri-linkedin-fill text-xl"></i></a>
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
                        <input type="email" name="email" placeholder="Your email" required class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-200 mt-10 pt-6">
                <p class="text-center text-gray-600 text-sm">© 2025 E-Learning Platform. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Stripe JavaScript -->
    <script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#374151',
                '::placeholder': { color: '#9CA3AF' },
            },
            invalid: { color: '#EF4444' },
        }
    });
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    const payButton = document.getElementById('pay-button');
    const cardErrors = document.getElementById('card-errors');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        payButton.disabled = true;
        payButton.innerHTML = 'Processing...';
        cardErrors.textContent = '';

        try {
            const { paymentMethod, error } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
            });

            if (error) {
                throw error;
            }

            const response = await fetch('{{ route('payment.process', $course->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    payment_intent_id: '{{ $intent->id }}',
                    payment_method: paymentMethod.id,
                }),
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.error || 'Payment failed');
            }

            if (result.success) {
                // Redirect to the course details page
                window.location.href = '{{ route('courses.details', $course->id) }}';
            } else if (result.requires_action) {
                // Handle 3D Secure or other redirect-based authentication
                const { error: confirmError } = await stripe.handleCardAction(result.client_secret);
                if (confirmError) {
                    throw confirmError;
                }
                
                // Retry the payment after authentication
                const retryResponse = await fetch('{{ route('payment.process', $course->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        payment_intent_id: '{{ $intent->id }}',
                        payment_method: paymentMethod.id,
                    }),
                });
                
                const retryResult = await retryResponse.json();
                if (retryResult.success) {
                    window.location.href = '{{ route('courses.details', $course->id) }}';
                } else {
                    throw new Error(retryResult.error || 'Payment failed after authentication');
                }
            }

        } catch (error) {
            cardErrors.textContent = error.message;
            payButton.disabled = false;
            payButton.innerHTML = 'Pay €{{ number_format($course->price, 2) }}';
        }
    });

    // Mobile menu toggle
    document.getElementById('mobile-menu-btn').addEventListener('click', () => {
        document.getElementById('sidebar-menu').classList.toggle('hidden');
    });

    document.getElementById('close-sidebar').addEventListener('click', () => {
        document.getElementById('sidebar-menu').classList.add('hidden');
    });
</script>
</body>
</html>