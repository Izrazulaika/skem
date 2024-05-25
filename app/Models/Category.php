<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the subjects for the category.
     */
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}

