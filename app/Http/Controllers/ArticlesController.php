<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use Validator, Session, Redirect;

class ArticlesController extends Controller {
  function index() {
    $articles = Article::all();
    return view('articles.index')
      ->with('articles', $articles);
  }

  public function create() {
    return view('articles.create');
  }

  public function store(Request $request) {
    $validate = Validator::make($request->all(), Article::valid());
    if ($validate->fails()) {
      return back()->withErrors($validate)->withInput();
    } else {
      Article::create($request->all());
      Session::flash('notice', 'Success add article');
      return Redirect::to('articles');
    }
  }

  public function show($id) {
    $article = Article::find($id);
     $comments = Article::find($id)->comments->sortBy('Comment.created_at');
    return view('articles.show')
      ->with('article', $article)
      ->with('comments', $comments);
  }

  public function edit($id) {
    $article = Article::find($id);
    return view('articles.edit')->with('article', $article);
  }

  public function update(Request $request, $id) {
    $validate = Validator::make($request->all(), Article::valid($id));
    if ($validate->fails()) {
      return back()->withErrors($validate)->withInput();
    } else {
      $article = Article::find($id);
      $article->update($request->all());
      Session::flash('notice', 'Success update article');
      return Redirect::to('articles');
    }
  }

  public function destroy($id) {
    $article = Article::find($id);
    if ($article->delete()) {
      Session::flash('notice', 'Article success delete');
      return Redirect::to('articles');
    } else {
      Session::flash('error', 'Article fails delete');
      return Redirect::to('articles');
    }
  }
}
