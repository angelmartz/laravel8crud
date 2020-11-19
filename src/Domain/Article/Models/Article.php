<?php

namespace Crud\Domain\Article\Models;

use App\Models\Comment;
use Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'body',
        'photo',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected static function newFactory()
    {
        return ArticleFactory::new();
    }
}
