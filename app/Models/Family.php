<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'head_first_name',
        'head_last_name',
        'head_occupation',
        'head_mobile_number',
        'head_dob',
    ];
    
    public function members()
    {
        return $this->hasMany('App\Models\FamilyMember', 'family_id');
    }
}
