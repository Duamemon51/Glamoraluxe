<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductRatingController extends Controller
{
    use Illuminate\Http\Request;
    use App\Models\Product;
    
    public function rate(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->rating = $request->rating;
        $product->save();
        
    
        return response()->json(['success' => true]);
    }
    
}
