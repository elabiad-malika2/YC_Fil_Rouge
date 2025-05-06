@extends('Etudiant.layout')

@section('title', '{{ $course->title }} - Paiement')

@section('styles')
    <style>
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
@endsection

@section('content')
    <!-- Page Title -->
    <section class="py-12 gradient-bg text-white">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-bold mb-2">Paiement Sécurisé</h1>
            <div class="flex items-center text-sm">
                <a href="{{ route('etudiant.dashboard') }}" class="hover:underline">Accueil</a>
                <span class="mx-2">/</span>
                <a href="{{ route('courses.show') }}" class="hover:underline">Cours</a>
                <span class="mx-2">/</span>
                <span>Paiement</span>
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
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Informations de Paiement</h2>
                        <form id="payment-form" action="{{ route('etudiant.payment.process', $course->id) }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="payment_intent_id" id="payment-intent-id" value="{{ $intent->id }}">
                            <!-- Stripe Card Element -->
                            <div>
                                <label for="card-element" class="block text-sm font-medium text-gray-700 mb-1">Carte de Crédit ou Débit</label>
                                <div id="card-element" class="mt-1"></div>
                                <div id="card-errors" role="alert" class="text-red-600 text-sm mt-2"></div>
                            </div>
                            <!-- Submit Button -->
                            <button type="submit" id="pay-button" class="w-full py-3 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center">
                                <i class="ri-secure-payment-line mr-2"></i>
                                Payer €{{ number_format($course->price, 2) }}
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Order Summary -->
                <div class="w-full lg:w-1/3 order-1 lg:order-2">
                    <div class="glass-card p-6 sticky top-24">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Résumé de la Commande</h2>
                        <!-- Course Info -->
                        <div class="flex mb-4 pb-4 border-b border-gray-100">
                            <div class="w-20 h-20 overflow-hidden rounded-lg flex-shrink-0">
                                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover course-image">
                            </div>
                            <div class="ml-4">
                                <h3 class="font-medium text-gray-800">{{ $course->title }}</h3>
                                <p class="text-sm text-gray-500">{{ $course->chapters->sum(function ($chapter) { return $chapter->lessons->count(); }) }} leçons • Tous niveaux</p>
                            </div>
                        </div>
                        <!-- Price Details -->
                        <div class="space-y-3 pb-4 border-b border-gray-100">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Prix du Cours</span>
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
                            <h4 class="font-medium text-indigo-800 mb-2">Ce que vous obtiendrez</h4>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li class="flex items-center">
                                    <i class="ri-check-line text-green-600 mr-2"></i>
                                    Accès à vie complet
                                </li>
                                <li class="flex items-center">
                                    <i class="ri-check-line text-green-600 mr-2"></i>
                                    Accès sur mobile et ordinateur
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
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
            payButton.innerHTML = 'Traitement...';
            cardErrors.textContent = '';

            try {
                const { paymentMethod, error } = await stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                });

                if (error) {
                    throw error;
                }

                const response = await fetch('{{ route('etudiant.payment.process', $course->id) }}', {
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
                    throw new Error(result.error || 'Échec du paiement');
                }

                if (result.success) {
                    window.location.href = '{{ route('courses.details', $course->id) }}';
                }

            } catch (error) {
                cardErrors.textContent = error.message;
                payButton.disabled = false;
                payButton.innerHTML = 'Payer €{{ number_format($course->price, 2) }}';
            }
        });
    </script>
@endsection