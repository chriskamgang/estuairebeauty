<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessHour extends Model
{
    protected $fillable = ['day_of_week', 'open_time', 'close_time', 'is_closed'];

    protected $casts = [
        'is_closed' => 'boolean',
    ];

    public function getDayNameAttribute(): string
    {
        $days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        return $days[$this->day_of_week] ?? '';
    }
}
