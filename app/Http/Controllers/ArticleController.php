<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Article;

class ArticleController extends Controller
{
    //fetch all articles with pagination and filtering
    public function index(Request $request)
    {
        $query = Article::query();

        // Apply search filters
        if ($request->has('keyword')) {
            $query->where('title', 'LIKE', "%{$request->keyword}%")
                  ->orWhere('decription', 'LIKE', "%{$request->keyword}%");
        }

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('source')) {
            $query->where('source', $request->source);
        }

        if ($request->has('date')) {
            $query->whereDate('published_at', $request->date);
        }

        // Paginate results (10 articles per page)
        return response()->json($query->paginate(30));
    }

    // Fetch a single article by ID
    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json($article);
    }

      //get personalized news
      public function personalizedNews()
      {
            $user = Auth::user();
            $preferences = UserPreference::where('user_id', $user->id)->first();

            if (!$preferences) {
                return response()->json(['message' => 'No preferences found.'], 404);
            }

            $query = Article::query();

            // Filter by preferred categories
            if (!empty($preferences->categories)) {
                $query->whereIn('category', $preferences->categories);
            }

            // Filter by preferred sources
            if (!empty($preferences->sources)) {
                $query->whereIn('source', $preferences->sources);
            }

            $articles = $query->paginate(10);

            return response()->json($articles);
      }

}
