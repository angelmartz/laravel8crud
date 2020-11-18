<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Article;

class ArticleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_create_article() {
        
        $article = Article::factory()->make();

        $response = $this->post(route('articles.store'), [
            'author' => $article->author,
            'body' => $article->body,
            'photo' => $article->photo,
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('articles',[
            'author' => $article->author,
            'body' => $article->body,
            'photo' => $article->photo,
        ]);


    }

    public function test_can_get_all_articles()
    {
        Article::factory()->count(15)->create();

        $response = $this->get(route('articles.index'));
        $response->assertSuccessful();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'propietario',
                    'articulo',
                    'foto',
                    'fecha'
                ]
            ]
        ]);
    }

    public function test_can_get_one_article()
    {
        $article = Article::factory()->create();

        $response = $this->get(route('articles.show', $article->id));

        $response->assertSuccessful();

        $response->assertJsonFragment([
            'id' => $article->id,
            'propietario' => $article->author,
            'articulo' => $article->body,
            'foto' => $article->photo,
            'fecha' => $article->created_at,
        ]);
    }

    public function test_can_update_an_article()  
    {  
        $article = Article::factory()->create();  

        $response = $this->patch(route('articles.update', $article->id), [  
            'author' => $author =  $this->faker->name,
            'body' => $body = $this->faker->paragraphs(2, true),
            'photo' => $photo = $this->faker->image('storage/app/public', 700, 700, 'article', true)  
        ]);  

        $response->assertSuccessful();  

        $this->assertDatabaseHas('articles', [  
            'id' => $article->id,
            'author' => $author,
            'body' => $body,
            'photo' => $photo
        ]);  
    }

    public function test_can_delete_an_article()  
    {  
        $article = Article::factory()->create();  
        
        $response = $this->delete(route('articles.destroy', $article->id));  
        
        $response->assertSuccessful();  
        
        $this->assertDeleted('articles', [  
            'id' => $article->id,  
        ]);  
    }
}
