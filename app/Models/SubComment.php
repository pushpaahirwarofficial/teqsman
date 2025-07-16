<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubComment extends Model
{
    protected $fillable = [
        'comment_id', 'name', 'email', 'comment'
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
