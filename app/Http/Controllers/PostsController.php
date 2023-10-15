<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Models\Posts;
use App\Models\User;
use App\Models\Comment;

use Mail;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Posts::with('user')->paginate();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("posts.edit");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostsRequest $request)
    {
        $user = User::find($request->user()->id);

        $post = $user->posts()->create([
            "title" => $request->title,
            "link" => $request->link,
            "content" => $request->content,
        ]);

        return redirect(route("posts.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Posts $post)
    {
        return view("posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posts $post)
    {
        $this->authorize('update', $post);
        return view("posts.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostsRequest $request, Posts $post)
    {

        $post->update([
            "title" => $request->title,
            "link" => $request->link,
            "content" => $request->content,
        ]);
    
        return redirect(route("posts.show", $post));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect(route('posts.index'));
    }
}