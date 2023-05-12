<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'occupation',
        'dob',
        'mobile_number',
        'marital_status',
        'address',
        'relationship_with_head',
        'qualification',
        'degree'
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
