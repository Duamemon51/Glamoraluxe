<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Tag; // Add this line at the top
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\AdminNotification;
use App\Models\ContactMessage;
class AdminController extends Controller
{
    public function dashboard()
    { 
        $recentOrders = Order::latest()->take(5)->get(); // Fetch the 5 most recent orders
        $newOrders = Order::count(); // Example model
         // Could be calculated based on analytics
        $userRegistrations = User::count();
     
        $deliveredOrders = Order::where('order_status', 'delivered')->count();
        $cancelledOrders = Order::where('order_status', 'cancelled')->count();
        $pendingOrders = Order::where('order_status', 'pending')->count(); // Add this for pending orders

        return view('admin.dashboard', compact('newOrders', 'recentOrders','userRegistrations', 'deliveredOrders', 'cancelledOrders', 'pendingOrders'));
       
    }
  // app/Http/Controllers/AdminController.php

public function categories()
{
    $categories = Category::paginate(4);// Fetch all categories from the database
    return view('admin.categories.index', compact('categories'));
}


    public function createCategory()
    {
        return view('admin.categories.create');  // Create a create-category view
    }
    public function editCategory($id)
    {
        // Find the category by ID
        $category = Category::find($id);
    
        // If the category doesn't exist, redirect with an error message
        if (!$category) {
            return redirect()->route('admin.categories.list')->with('error', 'Category not found!');
        }
    
        // Pass the category data to the edit view
        return view('admin.categories.edit', compact('category'));
    }
 
public function updateCategory(Request $request, $id)
{
    // Find the category by ID
    $category = Category::find($id);

    // If the category doesn't exist, redirect with an error message
    if (!$category) {
        return redirect()->route('admin.categories.index')->with('error', 'Category not found!');
    }

    // Validate the request data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|file|image|max:2048', // Optional image validation
    ]);

    // Update the category's name
    $category->name = $validated['name'];

    // Check if a new image is uploaded
    if ($request->hasFile('image')) {
        // Delete the old image if it exists (optional)
        if ($category->image && file_exists(public_path('storage/' . $category->image))) {
            unlink(public_path('storage/' . $category->image));  // Deleting old image
        }

        // Store the new image
        $imagePath = $request->file('image')->store('categories', 'public');
        $category->image = $imagePath;  // Save the new image path
    }

    // Save the category
    $category->save();

    // Redirect to the categories list with a success message
    return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
}

public function home()
{
    $categories = Category::with('products')->get(); 
    
    return view('admin.categories.home', compact('categories'));  // Pass data to the view
}


public function showByCategory($categoryId)
{
    $category = \App\Models\Category::with('products')->findOrFail($categoryId);

    return view('admin.products.home', compact('category'));
}




public function orders() {
    $orders = Order::latest()->paginate(10);
    return view('admin.orders.index', compact('orders'));
}


public function showOrder(Order $order) {
    return view('admin.orders.show', compact('order'));
}


public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|string'
    ]);

    $order->status = $request->status;
    $order->save();

    return redirect()->route('admin.orders.show', $order->id)->with('success', 'Order status updated successfully.');
}



    public function products()
    {
        // Fetch all products
        $products = Product::paginate(6); 
        // Return the 'admin.products' view and pass the products data
        return view('admin.products.index', compact('products'));
    }
    
   
    public function createProduct()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.products.create', compact('categories', 'tags'));
    }
    // AdminController.php


    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',   // <-- yeh
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'image_url' => 'required|file',
            'stock_quantity' => 'required|integer',
            'status' => 'required|in:in_stock,out_of_stock',
            'tags' => 'nullable|string',
        ]);
        
        // Image Upload Logic
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('products', 'public');
            $validated['image_url'] = $imagePath;
        }
    
        // Product create
        $product = Product::create($validated);
    
        // Attach Tags (handle JSON format from Tagify)
        if ($request->filled('tags')) {
            $tagsJson = $request->input('tags');
            $tagItems = json_decode($tagsJson);
    
            $tagIds = [];
    
            if (is_array($tagItems)) {
                foreach ($tagItems as $tagItem) {
                    if (isset($tagItem->value)) {
                        $tagName = trim($tagItem->value);
                        if ($tagName) {
                            $tag = Tag::firstOrCreate(['name' => $tagName]);
                            $tagIds[] = $tag->id;
                        }
                    }
                }
            }
    
            // Attach all tag IDs to the product
            $product->tags()->sync($tagIds);
        }
    
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }
    public function rate(Request $request)
{
    $product = Product::find($request->product_id);
    if ($product) {
        $product->rating = $request->rating;
        $product->save();
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false], 404);
}


public function mostrated()
{
    $categories = Category::with('products')->get();
    
    // Example: Get top 10 products ordered by rating (make sure 'rating' column exists)
    $mostRatedProducts = Product::orderBy('rating', 'desc')->take(10)->get();

    return view('shoping', compact('categories', 'mostRatedProducts'));
}

  
   public function editProduct($id)
{
    $product = Product::with('tags')->findOrFail($id);
    $categories = Category::all();
    $tags = $product->tags->pluck('name')->toArray(); // 👈 Only tag names

    return view('admin.products.edit', compact('product', 'categories', 'tags'));
}

public function updateProduct(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // Normal product fields update
   $product->name = $request->name;
$product->description = $request->description;
$product->category_id = $request->category_id;
$product->size = $request->size;
$product->color = $request->color;
$product->price = $request->price;
$product->stock_quantity = $request->stock_quantity;
$product->status = $request->status;

// Handle checkboxes (will be true if checked, false if not)
$product->is_new = $request->has('is_new');
$product->is_feature = $request->has('is_feature');
   if ($request->hasFile('image_url')) {
    $imagePath = $request->file('image_url')->store('products', 'public');
    $product->image_url = $imagePath;
}


    $product->save();

    // Tags update in pivot table
    $tags = json_decode($request->tags, true); // Because tagify sends JSON array
    $tagIds = [];

    foreach ($tags as $tag) {
        // Check if tag exists, otherwise create
        $tagModel = \App\Models\Tag::firstOrCreate(['name' => $tag['value']]);
        $tagIds[] = $tagModel->id;
    }

    $product->tags()->sync($tagIds); // Sync tags with pivot table

    return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
}

public function destroyProduct($id)
{
    $product = Product::findOrFail($id);

    // Detach tags from pivot table
    $product->tags()->detach();

    // Delete product
    $product->delete();

    return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
}
   

    public function customers()
    {
        return view('admin.customers');  // Create a customers view
    }

    public function salesReports()
    {
        return view('admin.sales-reports');  // Create a sales-reports view
    }

    public function inventoryReports()
    {
        return view('admin.inventory-reports');  // Create an inventory-reports view
    }

    public function settings()
    {
        return view('admin.settings');  // Create a settings view
    }

    public function paymentSettings()
    {
        return view('admin.payment-settings');  // Create a payment-settings view
    }
    // app/Http/Controllers/AdminController.php
    public function storeCategory(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:4048', // Add image validation if necessary
        ]);

        // Create a new category
        $category = new Category();
        $category->name = $request->name;

        // Handle image upload (if any)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $category->image = $imagePath; // Save the image path
        }

        // Save the category
        $category->save();

        // Redirect back with success message
        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully');
    }

    public function destroyCategory($id)
    {
        $category = Category::find($id); // Find the category by ID

        if ($category) {
            // Delete the category and return a success message
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
        }

        return redirect()->route('admin.categories.index')->with('error', 'Category not found!');
    }
public function tags()
{
    // Fetch all tags from the database
    $tags = Tag::paginate(10); // This returns a Paginator (has links method)


    // Return the view with the tags data
    return view('admin.tags.index', compact('tags'));
}
 // Show Create Tag Form
 public function createTag()
 {
     return view('admin.tags.create');  // Make sure this points to the correct view
 }

 // Store New Tag
 public function storeTag(Request $request)
 {
     $request->validate([
         'name' => 'required|string|max:255',
     ]);

     Tag::create($request->only('name'));
     return redirect()->route('admin.tags.index');
 }

 // Edit Tag
 public function editTag($id)
 {
     // Find the tag by its ID
     $tag = Tag::findOrFail($id);
 
     // Return the edit view with the tag data
     return view('admin.tags.edit', compact('tag'));
 }
 

 public function updateTag(Request $request, $id)
{
    // Validate the incoming data
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    // Find the tag and update its name
    $tag = Tag::findOrFail($id);
    $tag->name = $request->input('name');
    $tag->save();

    // Redirect back with success message
    return redirect()->route('admin.tags.index')->with('success', 'Tag updated successfully!');
}


 // Delete Tag
 public function deleteTag($id)
 {
     $tag = Tag::findOrFail($id);
     $tag->delete();
     return redirect()->route('admin.tags.index');
 }
 public function index(Request $request)
 {
     // Fetch categories with product count
     $categories = Category::withCount('products')->get();
 
     // Fetch distinct sizes, colors, and price ranges (for example)
     $sizes = Product::distinct()->pluck('size');
     $colors = Product::distinct()->pluck('color');
 
     // Optional: set the price range filter (this could be based on product price range)
     $minPrice = Product::min('price');
     $maxPrice = Product::max('price');
 
     // Fetch the filtered products based on query params
     $query = Product::query();
 
     // Price range filter
     if ($request->has('min_price') && $request->has('max_price')) {
         $query->whereBetween('price', [$request->min_price, $request->max_price]);
     }
 
     // Size filter
     if ($request->has('size')) {
         $query->whereIn('size', $request->size);
     }
 
     // Color filter
     if ($request->has('color')) {
         $query->whereIn('color', $request->color);
     }
 
     // Paginate products, show 5 per page
     $products = $query->paginate(6);
 
     // Return view with products, categories, sizes, and colors
     return view('shoping', compact('products', 'categories', 'sizes', 'colors', 'minPrice', 'maxPrice'));
 }

public function show($id)
{
    $featuredProducts = Product::where('is_feature', true)  // Assuming 'is_feature' is a boolean column
    ->take(10)
    ->get();

    $product = Product::findOrFail($id);
    return view('shop-single', compact('product','featuredProducts'));
}
// DashboardController.php
public function profile()
{
    // Fetch the authenticated user
    $user = Auth::user();  // Assuming you are using Laravel's built-in Auth system

    // Pass user data to the view
    return view('dashboard', compact('user'));
}
public function indexuser()
{
    $users = User::latest()->paginate(10);
    return view('admin.users.index', compact('users'));
}

public function create()
{
    return view('admin.users.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
        'role' => 'required|in:user,admin',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'avatar' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['name', 'email', 'role', 'phone', 'address']);
    $data['password'] = Hash::make($request->password);

    if ($request->hasFile('avatar')) {
        $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
    }

    User::create($data);

    return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
}

public function edit(User $user)
{
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:user,admin',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'avatar' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['name', 'email', 'role', 'phone', 'address']);

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    if ($request->hasFile('avatar')) {
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }
        $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
    }

    $user->update($data);

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
}

public function destroy(User $user)
{
    if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
        Storage::disk('public')->delete($user->avatar);
    }

    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
}

 }

