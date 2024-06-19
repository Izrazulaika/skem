<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BorrowRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref_number', 'student_id', 'borrow_start_date', 'borrow_end_date', 'borrow_status'
    ];

    public static function generateUniqueRefNumber()
    {
        do {
            $refNumber = Str::random(10); // Or any logic to generate your reference number
        } while (self::where('ref_number', $refNumber)->exists());

        return $refNumber;
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function borrowItems()
    {
        return $this->hasMany(BorrowItem::class);
    }
    public function penalties()
    {
        return $this->hasMany(Penalty::class);
    }
}
