<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'occupation',
        'age',
        'mobile_number',
    ];


    // public function family()
    // {
    //     return $this->belongsTo(Family::class);
    // }

    public function family()
    {
        return $this->belongsTo('App\Models\Family', 'family_id');
    }
}
