<?php

namespace App\Http\Controllers;

use App\Model\Like;
use Illuminate\Http\Request;
use App\Model\Reply;
use auth;

class LikeController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt');
    }


    public function likeIt(Reply $reply)
    {
        $reply->likes()->create([
            'user_id' => auth()->user()->id,
            // 'user_id' => '1'
        ]);
    }

    public function UnLikeIt(Reply $reply)
    {
        $reply->likes()->where('user_id', auth()->user()->id)->first()->delete();
        // $reply->likes()->where('user_id', 1)->first()->delete();
    }
}
