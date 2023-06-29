<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    public function member()
    {
        return $this->belongsTo(FamilyMember::class, 'member_id');
    }

    public function head()
    {
        return $this->belongsTo(Family::class, 'head_id');
    }
}
