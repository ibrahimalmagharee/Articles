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
        $articles = Article::active()->orderBy('id', 'DESC')->get();
        return view('site.index', compact('articles'));
    }

    public function articleDetails ($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return view('site.article', compact('article'));
    }

    public function articleTags ($slug)
    {
        $articles = Article::when($slug, function ($query) use ($slug) {
            return $query->whereHas('tags', function ($query) use ($slug) {
                $query->where('slug', $slug);
            });
            })->orderBy('id', 'DESC')->get();

        $tag = Tag::where('slug', $slug)->first();

        return view('site.articleTag', compact('articles', 'tag'));
    }
}
