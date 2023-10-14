<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Posts;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostCommented;

class CommentController extends Controller
{
    public function create(Posts $post)
    {
        return view("comments.edit", compact("post"));
    }


    public function store(StoreCommentRequest $request, Posts $post)
    {
        $user = User::find($request->user()->id);

        

        $comment = $user->comments()->create([
            "content" => $request->content,
            "posts_id" => $post->id,
        ]);


        Mail::to($post->user->email)->send(new PostCommented($comment));


        return view("posts.show", compact("post"));
    }
}
