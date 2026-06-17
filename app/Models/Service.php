<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service_name',
        'slug',
        'description',
        'base_price',
    ];

    public function technicians()
    {
        return $this->hasMany(Technician::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}