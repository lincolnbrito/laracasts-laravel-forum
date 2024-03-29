<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;

class RepliesController extends Controller
{
    /**
     * RepliesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Persist a new reply
     * @param $channnelId
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($channnelId, Thread $thread)
    {
        $this->validate(request(), ['body'=>'required']);

        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return back()->with('flash','Your reply has been left');
    }
}
