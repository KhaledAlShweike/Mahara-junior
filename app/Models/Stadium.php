<?php

namespace App\Models;

use App\Models\Club;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    use HasFactory;

    protected $fillable = ['Stadium_type','Price','Discount'];
    protected $table ='Stadiums';



    public function Reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }
    public function Clubs()
    {
        return $this->belongsToMany(Club::class);
    }

    public function Images()
    {
        return $this->belongsToMany(Image::class,'id','price');
    }
}
