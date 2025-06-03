<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use App\Models\Product;

use Illuminate\Http\Request;

class HomeController extends Controller
{
public function index()
{
    $categories = Category::take(3)->get(); // Show only 3 categories
    $popularProducts = Product::take(6)->get();
    $mostRatedProducts = Product::where('rating', '>=', 4)->take(10)->get();
    
    return view('home', compact('categories','popularProducts','mostRatedProducts'));
}

public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'nullable|string|min:6',
        'address' => 'nullable|string|max:500',
    ]);

    $user->name = $request->name;
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }
    $user->address = $request->address;
    $user->save();

    return back()->with('success', 'Profile updated successfully.');
}
public function showProducts($id) 
{
    $category = Category::findOrFail($id);
    $products = $category->products()->paginate(8);

    return view('admin.products.by-category', compact('category', 'products'));
}

    public function indexx()
{
    $products = Product::all();
    return view('products', compact('products'));
}


public function destroy(Request $request)
{
    $user = Auth::user();

    // Optional: delete related records like notifications, orders, etc.
    // DB::table('orders')->where('user_id', $user->id)->delete();

    Auth::logout();
    $user->delete();

    return redirect('/')->with('status', 'Your account has been deleted successfully.');
}
// In a controller
public function showNewArrivals()
{
   $newProducts = Product::where('is_new', true)
                      ->orderBy('created_at', 'desc')
                      ->take(6)
                      ->get();

    return view('new-arrivals', compact('newProducts'));
}

}
