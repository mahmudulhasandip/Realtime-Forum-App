<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'slug', 'body', 'user_id', 'category_id'];
    // protected $guarded = ['created_at'];

    protected $with = ['replies'];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany('App\Model\Reply', 'question_id', 'id')->latest();
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'question_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function getPathAttribute()
    {
        return "/question/$this->slug";
    }

    // boot

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($question) {
            $question->slug = str_slug($question->title);
        });

        static::updating(function ($question) {
            $question->slug = str_slug($question->title);
        });
    }
}
