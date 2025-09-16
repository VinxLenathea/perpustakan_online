<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documentModel extends Model
{
    use HasFactory;
    protected $table = 'documents';
    protected $primaryKey = 'document_id';
    protected $fillable = [
        'title',
        'author',
        'year_published',
        'category_id',
        'subcategory_id',
        'abstract',
        'file_url'
    ];
}
