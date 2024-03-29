<?php

namespace App\Models;

use App\Models\Player;
use App\Models\Tournement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable =['name','Sport_type'];
    protected $table ='Teams';

    public function Players()
    {
        return $this->belongsToMany(Player::class);
    }
    public function Tournements()
    {
        return $this->belongsToMany(Tournement::class);
    }
    public function sportTypes()
    {
        return $this->belongsTo(SportType::class);
    }
}
