<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubManager extends Model
{
    use HasFactory;

    public function ActorPersonalInfos()
    {
        return $this->belongsTo(ActorPersonalInfo::class);
    }
}
