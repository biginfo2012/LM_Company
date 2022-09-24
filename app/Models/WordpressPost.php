<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordpressPost extends Model
{
    use HasFactory;
    protected $table = 'wp60cc94posts';
    protected $fillable = [
        'post_date', 'post_content', 'post_title', 'post_type', 'guid'
    ];
}
