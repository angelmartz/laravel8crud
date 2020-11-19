<?php

namespace Crud\Domain\Comment\Models;

use Crud\Domain\Article\Models\Article;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'text'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    protected static function newFactory()
    {
        return CommentFactory::new();
    }
}
