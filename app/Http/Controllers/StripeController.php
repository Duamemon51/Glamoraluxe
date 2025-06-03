<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;
use App\Models\Cart; // Add this if you're using Cart
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Stripe\PaymentIntent;
class StripeController extends Controller
{
    public function checkout($order_id)
    {
        $order = Order::findOrFail($order_id);
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $order->total_price * 100,
                    'product_data' => [
                        'name' => 'Order #' . $order->id,
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success', ['order_id' => $order->id]),
            'cancel_url' => route('stripe.cancel'),
        ]);
    
        // Convert Stripe session creation time to Asia/Karachi timezone
        $localTime = Carbon::createFromTimestamp($session->created)
                          ->setTimezone('Asia/Karachi')
                          ->toDateTimeString();

        // Optionally, you can pass the $localTime to the view or log it.
        \Log::info('Stripe session created at: ' . $localTime); // Example logging

        return Redirect::to($session->url);
    }

    

public function createPaymentIntent(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $intent = PaymentIntent::create([
        'amount' => $request->amount,
        'currency' => 'usd',
        'automatic_payment_methods' => ['enabled' => true],
    ]);

    return response()->json(['clientSecret' => $intent->client_secret]);
}


    public function success($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->payment_status = 'paid';
        $order->save();

        Cart::where('user_id', Auth::id())->delete();
        session()->forget('cart');

        return redirect()->route('checkout.thankyou')->with('success', 'Payment successful! Order placed.');
    }

    public function cancel()
    {
        return redirect()->route('checkout')->with('error', 'Payment canceled.');
    }
}
