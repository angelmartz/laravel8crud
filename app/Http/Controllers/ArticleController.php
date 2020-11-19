<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
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
        return new ArticleCollection(Article::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author' => 'required|string',
            'body'   => 'required',
            'photo'  => 'required|string'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        $article = Article::create($validator->validate());

        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Crud\Domain\Article\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Crud\Domain\Article\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
            'author' => 'sometimes|string',
            'body'   => 'sometimes',
            'photo'  => 'sometimes|string'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        $article->update($validator->validate());

        return new ArticleResource($article);

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

        return response(['success' => true]);
    }
}
