<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewComments extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'review_id', 'name', 'email', 'comment', 'ratings'
    ];
    
   public function review()
    {
        return $this->belongsTo(Review::class);
    }
}