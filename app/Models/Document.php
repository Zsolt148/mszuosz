<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [];

    protected $casts = [
        'files' => 'array',
        'date' => 'date:Y-m-d',
        'is_visible' => 'boolean'
    ];

    protected $appends = ['filename', 'date_val'];

    public function type()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }

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
