<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
        'service_id', 'staff_member_id', 'client_name', 'client_phone',
        'client_email', 'reservation_date', 'reservation_time', 'status', 'notes',
    ];

    protected $casts = [
        'reservation_date' => 'date',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function staffMember(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class);
    }
}
