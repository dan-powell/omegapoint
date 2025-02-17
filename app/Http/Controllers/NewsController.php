<?php

namespace App\Http\Controllers;

use App\Models\News\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{

    /**
     * Show the index page
     */
    public function index(): View
    {
        return view('news.index', [
            'lead' => Article::latest(), 
            'archive' => Article::limit(10)->orderBy('date', 'desc')->get()
        ]);
    }
    /**
     * Show an article
     */
    public function articleShow(string $id): View
    {
        $article = Article::with(['subjects', 'districts'])->findOrFail($id);
        return view('news.article.show', [
            'article' => $article,
            'next' => Article::whereNot('id', $id)->whereDate('date', '>', $article->date)->orderBy('date', 'asc')->first()
        ]);
    }
}
