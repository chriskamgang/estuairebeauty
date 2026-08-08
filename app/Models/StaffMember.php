<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StaffMember extends Model
{
    protected $fillable = ['name', 'role', 'bio', 'photo', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'staff_service');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
