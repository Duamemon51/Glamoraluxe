<?php

namespace App\Http\Controllers;
use App\Models\Order;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
class CheckoutController extends Controller
{
    public function index(Product $product)
    {
        return view('checkout', compact('product'));
    }
    public function showCheckout()
{
    $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

    $subtotal = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    $total = $subtotal; // Add shipping/tax if needed

    return view('checkout', compact('cartItems', 'subtotal', 'total'));
}
public function create()
{
    return view('checkout'); // Make sure the checkout form blade exists
}
public function store(Request $request)
{
    // ✅ Step 1: Validate required fields
    $request->validate([
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'country' => 'required|string',
        'address' => 'required|string',
        'state' => 'required|string',
        'postal_code' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'total_price' => 'required|numeric',
    ]);

    // ✅ Step 2: Create order after validation
    $order = Order::create([
        'user_id' => auth()->id(),

        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'company_name' => $request->company_name,
        'country' => $request->country,
        'address' => $request->address,
        'apartment' => $request->apartment,
        'state' => $request->state,
        'postal_code' => $request->postal_code,
        'email' => $request->email,
        'phone' => $request->phone,

        'ship_to_different_address' => $request->has('ship_to_different_address'),
        'shipping_first_name' => $request->shipping_first_name,
        'shipping_last_name' => $request->shipping_last_name,
        'shipping_company_name' => $request->shipping_company_name,
        'shipping_country' => $request->shipping_country,
        'shipping_address' => $request->shipping_address,
        'shipping_apartment' => $request->shipping_apartment,
        'shipping_state' => $request->shipping_state,
        'shipping_postal_code' => $request->shipping_postal_code,
        'shipping_email' => $request->shipping_email,
        'shipping_phone' => $request->shipping_phone,

        'order_notes' => $request->order_notes,
        'coupon_code' => $request->coupon_code,

        'total_price' => $request->total_price,
        'payment_status' => $request->payment_status ?? 'pending',
        'order_status' => $request->order_status ?? 'pending',
    ]);
    dd($order); 
}

use Stripe\Stripe;
use Stripe\PaymentIntent;

public function place(Request $request)
{
    if ($request->payment_method === 'stripe') {
        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $request->total_price * 100,
            'currency' => 'usd',
            'payment_method' => $request->stripe_payment_method,
            'confirmation_method' => 'manual',
            'confirm' => true,
        ]);

        if ($paymentIntent->status !== 'succeeded') {
            return back()->withErrors('Stripe payment failed.');
        }
    }

    // Handle storing order in DB, other methods, etc.
}

}
