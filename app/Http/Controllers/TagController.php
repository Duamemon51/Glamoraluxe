<?php

// app/Http/Controllers/TagController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function suggest(Request $request)
    {
        $search = $request->get('search');

        $tags = Tag::where('name', 'like', "%{$search}%")
                    ->pluck('name'); // Return only names

        return response()->json($tags);
    }
}
