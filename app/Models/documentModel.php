<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'documents';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'title',
        'author',
        'year_published',
        'category_id',
        'subcategory_id',
        'abstract',
        'file_url'
    ];

    /**
     * Relasi ke tabel Category
     * Satu dokumen hanya punya satu kategori
     */
    public function category()
    {
        return $this->belongsTo(categoryModel::class, 'category_id', 'id');
    }

    /**
     * Relasi ke tabel Subcategory
     * Satu dokumen bisa punya satu subkategori
     */
    public function subcategory()
    {
        return $this->belongsTo(subcategoryModel::class, 'subcategory_id', 'id');
    }
}
