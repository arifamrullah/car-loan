<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table = 'cars';
    protected $fillable = [
        'brand',
        'type',
        'plate_number',
        'rent_price',
        'is_available'
    ];

    public function rent(){
        return $this->hasMany(Rent::class);
    }
}
