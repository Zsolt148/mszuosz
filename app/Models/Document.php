<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [];

    protected $casts = [
        'files' => 'array',
        'date' => 'date:Y-m-d',
        'is_visible' => 'boolean'
    ];

    protected $appends = ['filename', 'type_val', 'date_val'];

    const TYPES = [
        'default'   => 'Általános',
        'template'  => 'Sablon',
        'rule'      => 'Szabályzat',
        'report'    => 'Jegyzőkönyv',
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y.m.d H:i');
    }

    public function scopeVisible(Builder $query) {
        return $query->where('is_visible', true);
    }

    public function scopeNotVisible(Builder $query) {
        return $query->where('is_visible', false);
    }

    public function getTypeValAttribute()
    {
        return self::TYPES[$this->type];
    }

    public function getDateValAttribute()
    {
        return $this->date->format('Y.m.d');
    }

    public function getFileNameAttribute()
    {
        $arr = explode('/', $this->file);
        return array_pop($arr);
    }
}
