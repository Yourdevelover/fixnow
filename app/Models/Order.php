<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'user_id',
        'technician_id',
        'service_id',
        'address',
        'problem_description',
        'price',
        'status',
        'payment_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}