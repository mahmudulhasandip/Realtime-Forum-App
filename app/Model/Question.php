<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // protected $fillable = ['title', 'slug', 'body', 'category_id', 'user_id'];
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany('App\Model\Reply', 'question_id', 'id');
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
    }
}
