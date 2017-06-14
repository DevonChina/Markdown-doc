<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
//Markdown
use Markdown;

class ArticlesController extends Controller
{
    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
            'intro' => 'max:150',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'intro' => $request->intro,
            'content' => $request->content,
        ]);

        session()->flash('success', '创建成功');
        return redirect()->route('home');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        $article->content = Markdown::convertToHtml($article->content);
        return view('article.show', compact('article'));
    }

     //markdown AJAX 
    public function markdown(Request $request)
    {
        return Markdown::convertToHtml($request->content);
    }
}
