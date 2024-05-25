<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_detail';
    protected $fillable = [
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
