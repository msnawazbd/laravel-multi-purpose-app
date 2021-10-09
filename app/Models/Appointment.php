<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime',
        'time' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function getStatusBadgeAttribute()
    {
        $badge = [
            'SCHEDULE' => 'primary',
            'CLOSED' => 'success',
        ];

        return $badge[$this->status];
    }
}
