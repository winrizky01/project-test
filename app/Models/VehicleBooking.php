<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleBooking extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }

    public function driver()
    {
        return $this->hasOne(Driver::class, 'id', 'driver_id');
    }
}
