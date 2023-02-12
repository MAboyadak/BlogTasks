<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];

    public function getCreatedAtAttribute()
    {
        // dd($this->attributes['title']);
        $carb = new Carbon($this->attributes['created_at']);
        // dd($carb);
        return $carb->toFormattedDateString('Y-m-d');
        // return $this->attributes['created_at']->format('Y-m-d');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
