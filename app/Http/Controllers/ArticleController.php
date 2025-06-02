<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\GeminiService; // Assuming your manual service is still named this
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function index(Request $request) // For home page
    {
        $query = Article::with('category')->orderBy('published_at', 'desc');

        if ($request->filled('category')) {
            $categoryIdentifier = $request->input('category');
            $category = Category::where('slug', $categoryIdentifier)->orWhere('id', $categoryIdentifier)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }
        if ($request->filled('source')) {
            $query->where('source', $request->input('source'));
        }
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                  ->orWhere('content', 'like', '%' . $keyword . '%');
            });
        }

        $articles = $query->paginate(9); // 9 articles for a 3-col grid
        $categories = Category::orderBy('name')->get();
        // Get unique sources for filter dropdown
        $sources = Article::select('source')->distinct()->orderBy('source')->pluck('source');


        return view('home', compact('articles', 'categories', 'sources'));
    }

    // For displaying AI summary on a separate view or in a modal section
    public function showSummary(Article $article)
    {
        $summary = $this->geminiService->summarizeText($article->content);
        // You could have a dedicated view for this or pass to the article detail view
        return view('articles.summary', compact('article', 'summary'));
        // Or redirect back with session data if you want to show it on the same page
        // return back()->with('summary_for_'.$article->id, $summary);
    }


    public function saveForLater(Request $request, Article $article)
    {
        $user = Auth::user();
        if (!$user->savedArticles()->where('article_id', $article->id)->exists()) {
            $user->savedArticles()->attach($article->id);
            return back()->with('status', 'Article saved!');
        }
        return back()->with('error', 'Article already saved or error occurred.');
    }

    public function unsaveArticle(Request $request, Article $article)
    {
        $user = Auth::user();
        if ($user->savedArticles()->detach($article->id)) {
            return back()->with('status', 'Article unsaved.');
        }
        return back()->with('error', 'Article not found in saved list or error occurred.');
    }

    public function listSaved(Request $request)
    {
        $user = Auth::user();
        $savedArticles = $user->savedArticles()
                              ->with('category') // Eager load category
                              ->orderBy('pivot_created_at', 'desc')
                              ->paginate(9);
        $categories = Category::orderBy('name')->get(); // For filters if you add them
        $sources = $user->savedArticles()->select('source')->distinct()->orderBy('source')->pluck('source');


        return view('articles.saved', compact('savedArticles', 'categories', 'sources'));
    }
}