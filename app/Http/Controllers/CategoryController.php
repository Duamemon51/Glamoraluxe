<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Category; // Make sure you have a Category model


class CategoryController extends Controller
{
   
    public function home()
    {
        $categories = Category::all();  // Get all categories
        return view('admin.categories.home', compact('categories'));  // Pass data to the view
    }
    public function showCategories()
{
    $categories = Category::all(); // Fetch categories from the database
    return view('categories', compact('categories')); // Passing categories to the view
}

public function showCollections()
{
    $categories = Category::take(3)->get(); // Adjust the limit as needed
    return view('collections', compact('categories'));
}

}

