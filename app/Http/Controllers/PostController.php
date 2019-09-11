<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostImage;
use Auth;
use Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPost()
    {
        $posts = Post::with('post_images')->orderBy('id', 'DESC')->get();
        return response()->json(['error' => false, 'data' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPost(Request $request)
    {
        $user = Auth::user();
        $title = $request->title;
        $body = $request->body;
        $images = $request->images;

        $posts = Post::create([
            'title'    => $title,
            'body'      => $body,
            'user_id'   => $user->id,
        ]);
        
        //store each image

        foreach($images as $image){
            $imagePath = Storage::disk('uploads')
            ->put($user->email . '/post/' . $posts->id, $image);
            PostImage::create([
                'post_id'               => $title,
                'post_image_path'       =>'/uploads/' . $imagePath,
                'post_image_caption'    => $title
            ]);
        }

        return response()->json(['error' => false, 'data' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
