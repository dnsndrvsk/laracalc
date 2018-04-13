<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewsImages extends Model
{
    protected $table = 'reviews_images';
    protected $fillable = [
        'path',
        'review_id',
    ];
}
