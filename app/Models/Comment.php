<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable =[
        'text',
        'status',
        'post_id',
        'author_id',
        'date'
    ];

    public function post()
    {
       return $this->belongsTo(Post::class, 'post_id');
    }
    public function author()
    {
        return$this->belongsTo(User::class, 'author_id');
    }
}
