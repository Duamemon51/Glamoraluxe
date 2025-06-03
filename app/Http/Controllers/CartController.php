<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✅ Yeh bilkul sahi jagah hai
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Product;   
use App\Models\Coupon;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Store the current URL (cart or any page user was on)
            return redirect()->route('login')->with('redirect_url', url()->previous());
        }
    
        // Validate the incoming data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Find the product by ID
        $product = Product::find($request->product_id);
    
        // Calculate the total price
        $total = $product->price * $request->quantity;
    
        // Retrieve the cart from the session or initialize a new one
        $cart = Session::get('cart', []);
    
        // Check if the product already exists in the cart
        if (isset($cart[$product->id])) {
            // If the product exists, update the quantity and recalculate the total in the session
            $cart[$product->id]['quantity'] += $request->quantity;
            $cart[$product->id]['total'] = $product->price * $cart[$product->id]['quantity'];  // Update total
        } else {
            // Otherwise, add the product to the cart in the session
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'image' => $product->image,
                'total' => $total,  // Store total in session as well
            ];
        }
    
        // Store the updated cart back in the session
        Session::put('cart', $cart);
    
        // Save the product to the database (Cart model) with the total field
        Cart::create([
            'user_id' => Auth::id(),  // If you're using user authentication
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $product->price,
            'total' => $total,  // Insert the calculated total
            'image' => $product->image,  // assuming there is an image attribute
        ]);
    
        // Optionally, return a response (redirect, etc.)
        return redirect()->route('cart.index')->with('success', 'Product added to cart');
    }
    
    public function index()
{
    // 🧹 clear the cart session
    $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
    return view('cart.index', compact('cartItems'));
}

  
public function update(Request $request)
{
    foreach ($request->quantities as $id => $quantity) {
        $cartItem = Cart::find($id);
        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->total = $cartItem->price * $quantity;
            $cartItem->save();

            // Also update the session
            $cart = session()->get('cart', []);
            if (isset($cart[$cartItem->product_id])) {
                $cart[$cartItem->product_id]['quantity'] = $quantity;
                $cart[$cartItem->product_id]['total'] = $cartItem->total;
                session()->put('cart', $cart);
            }
        }
    }

    return redirect()->back()->with('success', 'Cart updated successfully!');
}


    public function remove($id)
    {
        // Use cart item's ID, not product_id
        $cartItem = Cart::where('user_id', Auth::id())->where('id', $id)->first();
    
        if ($cartItem) {
            $productId = $cartItem->product_id;
    
            // Delete from database
            $cartItem->delete();
    
            // Also remove from session cart
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->put('cart', $cart);
            }
    
            return redirect()->route('cart.index')->with('success', 'Item removed from cart');
        }
    
        return redirect()->route('cart.index')->with('error', 'Item not found in cart');
    }
    
    
    public function showCart()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $subtotal = $cartItems->sum('total');
        
        $total = $subtotal;
        $discount = 0;
        $couponCode = null;
    
        // Get the applied coupon from the database
        $user = Auth::user();
        $coupon = $user->coupon()->first();
    
        if ($coupon) {
            $couponCode = $coupon->code;
            // Check coupon type
            if ($coupon->type == 'fixed') {
                $discount = $coupon->discount;
            } elseif ($coupon->type == 'percent') {
                $discount = $subtotal * ($coupon->discount / 100);
            }
        }
    
        $total = max(0, $subtotal - $discount); // Make sure total doesn't go negative
    
        // Store in session
        session([
            'coupon' => [
                'code' => $couponCode,
                'discount' => $discount
            ],
            'total' => $total,
        ]);
    
        return view('cart.index', compact('cartItems', 'subtotal', 'discount', 'total'));
    }
    
    
    
    

    public function showCheckout()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
    
        // Calculate the subtotal
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    
        $total = $subtotal; // Default total
        $discount = 0;
        $couponCode = null;
    
        // Get the applied coupon from the database
        $user = Auth::user();
        $coupon = $user->coupon()->first();
    
        if ($coupon) {
            $couponCode = $coupon->code;
            if ($coupon->type == 'fixed') {
                $discount = $coupon->discount;
            } elseif ($coupon->type == 'percent') {
                $discount = $subtotal * ($coupon->discount / 100);
            }
        }
    
        $total = max(0, $subtotal - $discount); // Prevent negative totals
    
        // Store values in session
        session([
            'coupon' => [
                'code' => $couponCode,
                'discount' => $discount
            ],
            'total' => $total
        ]);
    
        return view('checkout', compact('cartItems', 'subtotal', 'discount', 'total'));
    }
    


   
    
}
