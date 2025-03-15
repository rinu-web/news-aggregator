<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPreference;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="News Aggregator API",
 *      description="API for managing news articles and user preferences",
 * )
 *
 * @OA\Tag(
 *     name="Articles",
 *     description="Operations related to news articles"
 * )
 */
class ArticleController extends Controller
{
    /**
     * Fetch all articles with pagination and filtering.
     *
     * @OA\Get(
     *     path="/api/articles",
     *     tags={"Articles"},
     *     summary="Get all articles",
     *     description="Retrieve a list of articles with optional filtering",
     *     @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         description="Search by keyword",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="category",
     *         in="query",
     *         description="Filter by category",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="source",
     *         in="query",
     *         description="Filter by news source",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Article"))
     *     )
     * )
     */
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->has('keyword')) {
            $query->where('title', 'LIKE', "%{$request->keyword}%")
                  ->orWhere('description', 'LIKE', "%{$request->keyword}%");
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

        return response()->json($query->paginate(30));
    }

    /**
     * Fetch a single article by ID.
     *
     * @OA\Get(
     *     path="/api/articles/{id}",
     *     tags={"Articles"},
     *     summary="Get article details",
     *     description="Retrieve details of a specific article",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Article ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Article")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Article not found"
     *     )
     * )
     */
    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json($article);
    }

    /**
     * Get personalized news based on user preferences.
     *
     * @OA\Get(
     *     path="/api/personalized-news",
     *     tags={"Articles"},
     *     summary="Get personalized news",
     *     description="Retrieve news articles based on user preferences",
     *     security={{ "sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Article"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No preferences found"
     *     )
     * )
     */
    public function personalizedNews()
    {
        $user = Auth::user();
        $preferences = UserPreference::where('user_id', $user->id)->first();

        if (!$preferences) {
            return response()->json(['message' => 'No preferences found.'], 404);
        }

        $query = Article::query();

        if (!empty($preferences->categories)) {
            $query->whereIn('category', $preferences->categories);
        }

        if (!empty($preferences->sources)) {
            $query->whereIn('source', $preferences->sources);
        }

        return response()->json($query->paginate(10));
    }
}
