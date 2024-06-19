<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'borrow_record_id', 'book_id'
    ];

    public function borrowRecord()
    {
        return $this->belongsTo(BorrowRecord::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
