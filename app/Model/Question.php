<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany('Reply', 'question_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('Category', 'question_id', 'id');
    }
}
