<?php

namespace App\Listeners;

use App\Models\Comment;
use App\Models\Posts;

use App\Mail\PostCommented;
use App\Events\CommentEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;


class CommentListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CommentEvent $event): void
    {
        Mail::to($event->post->user->email)->send(new PostCommented($event->comment));
    }
}
