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
        'family_id',
        'occupation',
        'sub_occupation',
        'dob',
        'mobile_number',
        'marital_status',
        'address',
        'relationship_with_head',
        'qualification',
        'degree',
        'date_of_anniversary',
        'gender',
        'image'
    ];


    public function family()
    {
        return $this->belongsTo('App\Models\Family', 'family_id');
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
