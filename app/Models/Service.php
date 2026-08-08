<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = ['category_id', 'sub_category', 'name', 'slug', 'description', 'price', 'duration', 'image', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'integer',
        'duration' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function staffMembers(): BelongsToMany
    {
        return $this->belongsToMany(StaffMember::class, 'staff_service');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
