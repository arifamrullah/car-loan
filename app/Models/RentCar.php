<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'days',
        'est_price',
        'car_id',
        'user_id'
    ];

    public function car() {
        return $this->belongsTo(Car::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function returnCar() {
        return $this->hasOne(ReturnCar::class);
    }
}
