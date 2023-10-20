<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Posts;
use App\Models\User;
use App\Models\Comment;
use App\Mail\PostCommented;
use App\Events\CommentEvent;

class CommentController extends Controller
{
    public function create(Posts $post)
    {

        return view("comments.edit", compact("post"));
    }


    public function store(StoreCommentRequest $request, Posts $post)
    {
        $user = $request->user();

        $comment = $user->comments()->create([
            "content" => $request->content,
            "posts_id" => $post->id,
        ]);

        event(new CommentEvent($comment, $post));


        return to_route('posts.show', ['post' => $post->id]);
    }

    public function edit(Posts $post, Comment $comment)
    {
        $this->authorize('update', $comment);
        return view("comments.edit", compact(["post", "comment"]));
    }


    public function update(UpdateCommentRequest $request, Posts $post, Comment $comment)
    {

        $comment->update([
            "content" => $request->content,
        ]);
    
        return to_route('posts.show', ['post' => $post->id]);
    }


    public function destroy(Posts $post, Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return to_route('posts.show', ['post' => $post->id]);
    }


}
