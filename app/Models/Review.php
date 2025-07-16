<?php

// Review.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'title_url',
        'meta_desc',
        'meta_key',
        'meta_title',
        'description',
        'body',
        'img_url',
        'category',
        'auth_name',
    ];

    public function reviewComments()
    {
        return $this->hasMany(ReviewComments::class);
    }
}

