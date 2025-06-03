<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
public function search(Request $request)
{
    $query = strtolower($request->input('query'));

    $results = Product::query()
        ->where(function ($q) use ($query) {
            // Name or Description - Partial match (but refined)
            $q->whereRaw('LOWER(products.name) = ?', [$query])
              ->orWhereRaw('LOWER(products.name) LIKE ?', ["% {$query} %"])
              ->orWhereRaw('LOWER(products.name) LIKE ?', ["% {$query}%"])
              ->orWhereRaw('LOWER(products.name) LIKE ?', ["%{$query} %"])

              ->orWhereRaw('LOWER(products.description) = ?', [$query])
              ->orWhereRaw('LOWER(products.description) LIKE ?', ["% {$query} %"])
              ->orWhereRaw('LOWER(products.description) LIKE ?', ["% {$query}%"])
              ->orWhereRaw('LOWER(products.description) LIKE ?', ["%{$query} %"])

              // Category match
              ->orWhereHas('category', function ($c) use ($query) {
                  $c->whereRaw('LOWER(name) = ?', [$query]);
              })

              // Tags match (exact match only)
              ->orWhereHas('tags', function ($t) use ($query) {
                  $t->whereRaw('LOWER(name) = ?', [$query]);
              });
        })
        ->distinct()
        ->get();

    return view('search.results', compact('results', 'query'));
}


}
