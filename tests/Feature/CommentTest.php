<?php

namespace Tests\Feature;

use Crud\Domain\Article\Models\Article;
use Crud\Domain\Comment\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_create_a_comment() {

        $article = Article::factory()->create();
        $comment = Comment::factory()->make();

        $this->post(route('articles.store'), [
            'author' => $article->author,
            'body' => $article->body,
            'photo' => $article->photo,
        ]);


        $response = $this->post(route('articles.comments.store', [$article]), [
            'author' => $comment->author,
            'text' => $comment->text,
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('comments',[
            'article_id' => $article->id,
            'author' => $comment->author,
            'text' => $comment->text,
        ]);

    }

    public function test_can_get_all_comments()
    {
        $article = Article::factory()->create();

        $article->comments()->saveMany(Comment::factory()->count(5)->make());

        $response = $this->get(route('articles.comments.index', [$article]));

        $response->assertSuccessful();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'propietario',
                    'comentario',
                    'fecha'
                ]
            ]
        ]);
    }

    public function test_can_get_one_comment()
    {
        $article = Article::factory()->create();
        $comment = $article->comments()->save(Comment::factory()->make());

        $response = $this->get(route('articles.comments.show', [$article->id, $comment->id]));

        $response->assertSuccessful();

        $response->assertJsonFragment([
            'id' => $comment->id,
            'propietario' => $comment->author,
            'comentario' => $comment->text,
            'fecha' => $comment->created_at,
        ]);
    }

    public function test_can_update_an_article()
    {
        $article = Article::factory()->create();
        $comment = $article->comments()->save(Comment::factory()->make());

        $response = $this->patch(route('articles.comments.update', [$article->id, $comment->id]), [
            'author' => $author =  $this->faker->name,
            'text' => $text = $this->faker->text,
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'article_id' => $article->id,
            'author' => $author,
            'text' => $text,
        ]);
    }

    public function test_can_delete_an_comment()
    {
        $article = Article::factory()->create();
        $comment = $article->comments()->save(Comment::factory()->make());

        $response = $this->delete(route('articles.comments.destroy', [$article->id, $comment->id]));

        $response->assertSuccessful();

        $this->assertDeleted('comments', [
            'id' => $comment->id,
        ]);
    }
}
