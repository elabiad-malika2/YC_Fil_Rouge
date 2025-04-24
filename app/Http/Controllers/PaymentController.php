<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function show($courseId)
    {
        $course = Course::with(['category', 'chapters'])->findOrFail($courseId);

        if (Auth::user()->enrollments()->where('course_id', $courseId)->where('payment_status', 'completed')->exists()) {
            return redirect()->route('courses.details', $courseId)->with('info', 'You are already enrolled in this course.');
        }

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            
            $intent = PaymentIntent::create([
                'amount' => (int)($course->price * 100),
                'currency' => 'eur',
                'metadata' => [
                    'course_id' => $courseId,
                    'user_id' => Auth::id(),
                    'course_title' => $course->title
                ],
                'description' => "Enrollment in course: " . $course->title,
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'always'
                ]
            ]);
            
            return view('Etudiant.payment', compact('course', 'intent'));
        } catch (\Exception $e) {
            return redirect()->route('courses.details', $courseId)->with('error', 'Payment setup failed: ' . $e->getMessage());
        }
    }

    public function process(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::retrieve($request->input('payment_intent_id'));
            
            if ($paymentIntent->metadata->user_id != Auth::id() || 
                $paymentIntent->metadata->course_id != $courseId) {
                throw new \Exception('Invalid payment intent');
            }

            $paymentIntent->confirm([
                'payment_method' => $request->input('payment_method'),
                'return_url' => route('courses.details', $courseId)
            ]);

            if ($paymentIntent->status === 'succeeded') {
                DB::beginTransaction();
                try {
                    $enrollment = Enrollment::create([
                        'user_id' => Auth::id(),
                        'course_id' => $courseId,
                        'amount' => $course->price,
                        'payment_status' => 'completed',
                        'payment_id' => $paymentIntent->id,
                    ]);
                    
                    DB::commit();
                    return response()->json([
                        'success' => true,
                        'redirect_url' => route('courses.details', $courseId)
                    ]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    throw $e;
                }
            }

            return response()->json([
                'error' => 'Payment failed. Please try again.'
            ], 400);

        } catch (\Stripe\Exception\CardException $e) {
            return response()->json([
                'error' => 'Card declined: ' . $e->getMessage()
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Payment failed: ' . $e->getMessage()
            ], 500);
        }
    }
}