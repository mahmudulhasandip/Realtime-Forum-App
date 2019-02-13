<?php

namespace App\Http\Controllers;

use App\Model\Like;
use Illuminate\Http\Request;
use App\Model\Reply;
use App\Events\LikeEvent;

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
        ]);

        broadcast(new LikeEvent($reply->id, 1))->toOthers();
    }

    public function UnLikeIt(Reply $reply)
    {
        $reply->likes()->where('user_id', auth()->user()->id)->first()->delete();
        broadcast(new LikeEvent($reply->id, 0))->toOthers();
    }
}
