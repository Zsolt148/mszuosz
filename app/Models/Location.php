<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = [];

    public function events()
    {
        return $this->hasMany(Event::class, 'location_id');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y.m.d H:i');
    }
}
