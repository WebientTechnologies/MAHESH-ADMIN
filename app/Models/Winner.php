<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $fillable = [
        'quiz_id',
        'first_winner',
        'second_winner',
        'third_winner',
    ];
    use HasFactory;
}
