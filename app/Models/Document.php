<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [];

    protected $appends = ['filename'];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y.m.d H:i');
    }

    public function getFileNameAttribute()
    {
        $arr = explode('/', $this->file);
        return array_pop($arr);
    }
}
