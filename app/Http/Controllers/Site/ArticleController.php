<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index ()
    {
       return view('site.index');
    }

    public function getArticles ()
    {
        $articles = Article::with(['images', 'tags'])->active()->orderBy('id', 'DESC')->get();
        return response()->json([
            'status' => true,
            'data' => $articles
        ]);
    }

    public function articleDetails ($slug)
    {
        $article = Article::with(['images', 'tags'])->where('slug', $slug)->first();
        return response()->json([
            'status' => true,
            'data' => $article
        ]);
    }

    public function articleTags ($slug)
    {
        $articles = Article::with(['images', 'tags'])->when($slug, function ($query) use ($slug) {
            return $query->whereHas('tags', function ($query) use ($slug) {
                $query->where('slug', $slug);
            });
            })->orderBy('id', 'DESC')->get();

        $tag = Tag::where('slug', $slug)->first();

        return response()->json([
            'status' => true,
            'data' => $articles,
            'tag' => $tag,
        ]);
    }
}
