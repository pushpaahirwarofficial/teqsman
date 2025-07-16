<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'blog_id', 'name', 'email', 'comment', 'parent_id'
    ];

    public function subComments()
    {
        return $this->hasMany(SubComment::class, 'comment_id');
    }
}
