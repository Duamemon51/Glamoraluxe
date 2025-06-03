<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function createPaymentIntent()
    {
        // Set your Stripe secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a PaymentIntent
        $paymentIntent = PaymentIntent::create([
            'amount' => 5000, // $50.00
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        // Return client secret to frontend
        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }
}
