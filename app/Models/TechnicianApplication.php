<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicianApplication extends Model
{
    protected $fillable = [

        'service_id',
        'user_id',
        'specialist',
        'experience',
        'description',
        'status'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}