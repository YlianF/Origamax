<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Models\Posts;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use Mail;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Posts::with('user')
                    ->where('isVisible', 1)
                    ->orWhere('user_id', Auth::user()->id)
                    ->paginate();

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

        if ($request->isVisible === "true") {
            $request->isVisible = true;
        } else {
            $request->isVisible = false;
        }

        $post = $user->posts()->create([
            "title" => $request->title,
            "link" => $request->link,
            "content" => $request->content,
            "isVisible" => $request->isVisible,
        ]);

        return to_route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Posts $post)
    {
        $this->authorize('view', $post);
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
    
        return to_route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return to_route('posts.index');
    }
}