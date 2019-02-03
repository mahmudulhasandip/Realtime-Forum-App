<?php

namespace App\Model;

use App\Model\Question;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function questions()
    {
        return $this->hasMany('Question');
    }
}
