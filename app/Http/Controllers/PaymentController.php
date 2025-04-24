<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function create(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        Stripe::setApiKey(env('STRIPE_SECRET'));

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $course->title,
                        ],
                        'unit_amount' => $course->price * 100, 
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel'),
            ]);

            Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $courseId,
                'amount' => $course->price,
                'payment_status' => 'pending',
                'payment_id' => $session->id,
            ]);

            return redirect($session->url);
        
    }
    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');
        Stripe::setApiKey(env('STRIPE_SECRET'));

            $session = Session::retrieve($sessionId);
            $enrollment = Enrollment::where('payment_id', $sessionId)->firstOrFail();
            $enrollment->update([
                'payment_status' => 'completed',
            ]);

            return redirect()->route('courses.details', $enrollment->course_id)->with('success', 'Payment successful! You are now enrolled in the course.');
        
    }
}
