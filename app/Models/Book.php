<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject', 'isbn', 'title', 'record_date', 'status', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrowItems()
    {
        return $this->hasMany(BorrowItem::class);
    }
}
