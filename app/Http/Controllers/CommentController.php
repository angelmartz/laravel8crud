<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use Crud\Domain\Article\Models\Article;
use Crud\Domain\Comment\Models\Comment;
use Illuminate\Http\Request;
use Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article)
    {
        return new CommentCollection($article->comments->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Article $article, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author' => 'required|string',
            'text'   => 'required|string',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        $comment = $article->comments()->create($validator->validate());

        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Crud\Domain\Comment\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article, Comment $comment)
    {
        return new CommentResource($comment);
    }


    public function update(Request $request, Article $article, Comment  $comment)
    {
        $validator = Validator::make($request->all(), [
            'author' => 'sometimes|string',
            'text'   => 'sometimes|string',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->toArray(), 422);
        }

        $comment->update($validator->validate());

        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Crud\Domain\Comment\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article, Comment $comment)
    {
        $comment->delete();

        return response(['success' => true]);
    }
}
