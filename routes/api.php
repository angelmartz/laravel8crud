<?php

use Crud\App\Api\Article\Controllers\ArticleController;
use Crud\App\Api\Comment\Controllers\CommentController;
use Crud\Domain\Comment\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('articles', ArticleController::class);

Route::apiResource('articles.comments', CommentController::class);

Route::bind('comment', function ($comment, $route) {
    return Comment::where('article_id', $route->parameter('article'))->findOrFail($comment);
});

Route::fallback(function () {
    return response()->json(['error' => 'Not Found!'], 404);
});
