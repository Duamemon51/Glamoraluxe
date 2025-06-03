<?php
// app/Http/Controllers/CouponController.php
namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\User;

class CouponController extends Controller
{
   public function applyCoupon(Request $request)
{
    $coupon = Coupon::where('code', $request->coupon_code)->first();

    if (!$coupon) {
        return response()->json(['error' => 'Invalid coupon code.'], 400);
    }

    if (!$coupon->is_active) {
        return response()->json(['error' => 'This coupon is not active.'], 400);
    }

    if ($coupon->expires_at && now()->greaterThan($coupon->expires_at)) {
        return response()->json(['error' => 'Coupon expired.'], 400);
    }

    $discount = 0;
    if ($coupon->type === 'fixed') {
        $discount = $coupon->value;
    } elseif ($coupon->type === 'percent') {
        $discount = ($coupon->value / 100) * $request->cart_total;
    }

    // Store in session
    session([
        'coupon_code' => $coupon->code,
        'discount_amount' => $discount
    ]);

    return response()->json(['discount' => $discount]);
}

    

    public function index() {
        $coupons = Coupon::latest()->paginate(7);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create() {
        $users = User::all(); 
        return view('admin.coupons.create' , compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'code' => 'required|unique:coupons,code',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'expires_at' => 'required|date',
        ]);
    
        Coupon::create([
            'user_id' => $request->user_id,
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
            'expires_at' => $request->expires_at,
            'is_active' => $request->has('is_active'),
        ]);
    
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully.');
    }
    
    
    public function edit(Coupon $coupon) {
        $users = User::all();  // Load all users
        
        return view('admin.coupons.edit', compact('coupon', 'users'));
    }
    public function update(Request $request, Coupon $coupon) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'expires_at' => 'nullable|date',
        ]);
    
        $coupon->update([
            'user_id' => $request->user_id,
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
            'expires_at' => $request->expires_at,
            'is_active' => $request->has('is_active'),
        ]);
    
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully.');
    }
    
    

    public function destroy($id) {
        $coupon = Coupon::find($id);
        
        if ($coupon) {
            $coupon->delete();
            return back()->with('success', 'Coupon deleted successfully.');
        }
        
        return back()->with('error', 'Coupon not found.');
    }
    
}

