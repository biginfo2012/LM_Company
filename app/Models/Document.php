<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'doc_code', 'name', 'url', 'company_id', 'file_name'
    ];
}
