<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Models\Posts;
use App\Models\User;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //On récupère tous les Post
        // $posts = Posts::latest()->get();
        $posts = Posts::with('user')->get();

        // On transmet les Post à la vue
        return view("posts.index", compact("posts"));
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
    public function show(Posts $posts)
    {
        return view("posts.show", compact("posts"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posts $posts)
    {
        return view("posts.edit", compact("posts"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Posts $posts)
    {
        $user = User::find($request->user()->id);

        $post = $user->posts()->update([
            "title" => $request->title,
            "link" => $request->link,
            "content" => $request->content,
        ]);
    
        return redirect(route("posts.show", $posts));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $posts)
    {
        $posts->delete();

        return redirect(route('posts.index'));
    }
}