<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];
    public function question()
    {
        return $this->belongsTo('App\Model\Question', 'question_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany('App\Model\Like');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($reply) {
            $reply->user_id = auth()->id();
        });
    }

}
