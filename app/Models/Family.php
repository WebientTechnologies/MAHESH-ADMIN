<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'head_first_name',
        'head_middle_name',
        'head_last_name',
        'head_occupation',
        'sub_occupation',
        'head_mobile_number',
        'head_dob',
        'marital_status',
        'address',
        'relationship_with_head',
        'qualification',
        'degree',
        'date_of_anniversary',
        'gender',
        'image'

    ];
    
    public function members()
    {
        return $this->hasMany('App\Models\FamilyMember', 'family_id');
    }

    public function marital()
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }
    public function relationship()
    {
        return $this->belongsTo(Relationship::class);
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }
    
}
