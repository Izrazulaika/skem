<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    /**
     * Get the category that owns the subject.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
