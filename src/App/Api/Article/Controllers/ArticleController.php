<?php

namespace Crud\App\Api\Article\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Crud\App\Api\Article\Requests\CreateArticleRequest;
use Crud\App\Api\Article\Requests\UpdateArticleRequest;
use Crud\App\Api\Article\Resources\ArticleCollection;
use Crud\App\Api\Article\Resources\ArticleResource;
use Crud\Domain\Article\Models\Article;
use Illuminate\Http\Request;
use Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(new ArticleCollection(Article::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticleRequest $request)
    {
        $article = Article::create($request->validated());

        return response()->json(new ArticleResource($article));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Crud\Domain\Article\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return response()->json(new ArticleResource($article));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Crud\Domain\Article\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->update($request->validated());

        return response()->json(new ArticleResource($article));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Crud\Domain\Article\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json(['success' => true]);
    }
}
