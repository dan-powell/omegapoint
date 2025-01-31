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
            'lead' => Article::latest()
        ]);
    }
    /**
     * Show an article
     */
    public function articleShow(string $id): View
    {
        return view('news.article.show', [
            'article' => Article::findOrFail($id)
        ]);
    }
}
