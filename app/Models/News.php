<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $guarded = [];

    protected $appends = ['type_val', 'date_val'];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'is_visible' => 'boolean'
    ];

    const TYPES = [
        'default' => 'Általános',
        'highlighted' => 'Kiemelt',
        'important' => 'Fontos',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeVisible(Builder $query) {
        return $query->where('is_visible', true);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y.m.d H:i');
    }

    public function getDateValAttribute()
    {
        return Carbon::parse($this->date)->format('Y.m.d');
    }

    public function getTypeValAttribute()
    {
        return self::TYPES[$this->type];
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'new_tag', 'news_id', 'tags_id');
    }

}
