<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Word extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'deutsch', 'englisch'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}