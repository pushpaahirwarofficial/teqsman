<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'title_url', 'meta_desc', 'meta_title', 'meta_key', 'description', 'body', 'img_url', 'img_url_100_80', 'post_code', 'created_at', 'category', 'auth_name'
    ];
}
