<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ResumeTracker extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [];

    public function getCreatedAtAttribute($value)
    {
        return (new Carbon($value))->timezone(config('app.timezone'))->format('d-m-Y H:i:s');
    }
    public function getUpdatedAtAttribute($value)
    {
        return (new Carbon($value))->timezone(config('app.timezone'))->format('d-m-Y H:i:s');
    }

    public function getResumeLinkAttribute($value)
    {
        if ($value) {
            return Storage::disk('public')->url($value);
        }
    }
}
