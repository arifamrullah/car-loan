<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'days',
        'total_price',
        'car_id',
        'user_id',
        'rent_car_id'
    ];

    public function car() {
        return $this->belongsTo(Car::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function rentCar() {
        return $this->belongsTo(RentCar::class);
    }
}
