<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'doc_id', 'type'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function doc(){
        return $this->hasOne(Document::class, 'id', 'doc_id');
    }
}
