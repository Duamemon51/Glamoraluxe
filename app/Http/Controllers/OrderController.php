<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\PaymentIntent;

    
    class OrderController extends Controller
    {
        public function showCheckoutForm()
        {
            $cartItems = \App\Models\Cart::with('product')->where('user_id', auth()->id())->get();
        
            $subtotal = $cartItems->sum(function($item) {
                return $item->quantity * $item->price;
            });
        
            $discount = session('discount_amount', 0);
            $total = $subtotal - $discount;
        
            return view('checkout', compact('cartItems', 'subtotal', 'discount', 'total'));
        }
        
        public function showStatusChangeForm(Order $order)
        {
            return view('admin.orders.change-status', compact('order'));
        }
        public function updateStatus(Request $request, Order $order)
        {
            $request->validate([
                'status' => 'required|in:pending,processing,shipped,delivered,cancelled', // restrict to enum values
            ]);
        
            $order->order_status = $request->status;  // update to 'order_status'
            $order->payment_status = $request->payment_status; 
            $order->save();
        
            return redirect()->route('admin.orders.list', $order->id)->with('success', 'Order status updated successfully.');
        }
        
        public function deleteOrder($id)
        {
            $order = Order::findOrFail($id);
            $order->delete();
        
            return redirect()->route('admin.orders.list')->with('success', 'Order deleted successfully.');
        }


 
        
        
        
        public function placeOrder(Request $request)
        {
            $validated = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'country' => 'required|string',
                'address' => 'required|string',
                'state' => 'required|string',
                'postal_code' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'total_price' => 'required|numeric',
                'payment_method' => 'required|in:cod,stripe',
            ]);
        
            $order = new Order();
            $order->user_id = auth()->id();
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->company_name = $request->company_name ?? null;
            $order->country = $request->country;
            $order->address = $request->address;
            $order->apartment = $request->apartment ?? null;
            $order->state = $request->state;
            $order->postal_code = $request->postal_code;
            $order->email = $request->email;
            $order->phone = $request->phone;
           
            $order->ship_to_different_address = $request->has('ship_to_different_address');
            
            $order->shipping_first_name = $request->shipping_first_name ?? null;
            $order->shipping_last_name = $request->shipping_last_name ?? null;
            $order->shipping_company_name = $request->shipping_company_name ?? null;
            $order->shipping_country = $request->shipping_country ?? null;
            $order->shipping_address = $request->shipping_address ?? null;
            $order->shipping_apartment = $request->shipping_apartment ?? null;
            $order->shipping_state = $request->shipping_state ?? null;
            $order->shipping_postal_code = $request->shipping_postal_code ?? null;
            $order->shipping_email = $request->shipping_email ?? null;
            $order->shipping_phone = $request->shipping_phone ?? null;
        
            $order->order_notes = $request->order_notes ?? null;
            $order->coupon_code = $request->coupon_code ?? null;
           // Calculate final total again
$cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
$subtotal = $cartItems->sum(function ($item) {
    return $item->quantity * $item->price;
});
$discount = session('discount_amount', 0);
$finalTotal = $subtotal - $discount;

// Apply to order

$order->coupon_code = session('coupon_code') ?? null;
$order->total_price = $finalTotal;
            $order->payment_method = $request->payment_method;
            $order->payment_status = 'pending'; // unpaid by default
            $order->save();
        
            // Save order items
            $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name ?? 'Unknown',
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }
        
            if ($request->payment_method === 'stripe') {
                return redirect()->route('stripe.checkout', ['order_id' => $order->id]);
            }
        
            // For COD
            Cart::where('user_id', auth()->id())->delete();
            session()->forget('cart');
            session()->forget('coupon_code');
            session()->forget('discount_amount');
            
            return redirect()->route('checkout.thankyou')->with('success', 'Order placed successfully.');
        }
        
        

    
        public function thankYou()
        {
            return view('thank-you');
        }
    }
    

