<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $guarded = [];

    protected $appends = ['period'];

    protected $casts = [
        'start_at' => 'date:Y-m-d',
        'end_at' => 'date:Y-m-d',
        'is_visible' => 'boolean',
        'files' => 'array',
    ];

    const CATS = [
      'OB' => 'Országos Bajnokság',
      'VB' => 'Világbajnokság',
      'EB' => 'Európa-bajnokság',
      'RV' => 'Ranglistába számító verseny',
      'HV' => 'Harminchármas medencés verseny',
      'FV' => 'Felkészülési verseny',
      'SZV' => 'Szabadidős verseny',
    ];

    const POOLS = [
        '25',
        '33',
        '50',
        'Nyíltvizi',
    ];

    const TIMINGS = [
        'Kézi',
        'Gépi',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function scopeVisible(Builder $query) {
        return $query->where('is_visible', true);
    }

    public function scopeNotVisible(Builder $query) {
        return $query->where('is_visible', false);
    }

    public function isVisible()
    {
        return $this->is_visible;
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y.m.d H:i');
    }

    public function getPeriodAttribute()
    {
        $start = Carbon::parse($this->start_at)->format('Y.m.d');
        $end = Carbon::parse($this->end_at)->format('d');

        if($this->start_at == $this->end_at) {
            return $start;
        }else {
            return $start . ' - ' . $end;
        }

    }
}
