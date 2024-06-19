<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;

    protected $fillable = ['borrow_record_id', 'amount', 'remark', 'status'];

    public function borrowRecord()
    {
        return $this->belongsTo(BorrowRecord::class);
    }
}
