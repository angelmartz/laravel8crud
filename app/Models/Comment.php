<?php

namespace App\Models;

use Crud\Domain\Article\Models\Article;
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
}
