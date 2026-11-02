<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    // Mengizinkan kolom-kolom ini untuk diisi melalui form/create
    protected $fillable = [
        'title',
        'isbn',
        'published_year',
        'author_id',
        'price',
        'stock',
    ];

    /**
     * Relasi ke Author (Setiap buku milik satu penulis)
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Relasi ke Category (Satu buku bisa memiliki banyak kategori)
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}