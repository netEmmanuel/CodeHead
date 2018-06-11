<?php

namespace CodeHead\Http\Controllers;

use Illuminate\Http\Request;
use CodeHead\Http\Requests;
use CodeHead\Blogpost;
use CodeHead\Http\Resources\blogpost as BlogpostResource;

class BlogpostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get blogpost
        $posts = blogpost::orderBy('created_at', 'desc')->paginate(5);

        //return blog post as resource

        return BlogpostResource::collection($posts);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->isMethod('put')? blogpost::findOrFail
        ($request->post_id): new blogpost;

        $post->id = $request->input('post_id');
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->tag = $request->input('tag');

        if ($post->save()) {
            return new BlogpostResource($post);
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //single blogpost
        $post = blogpost::findOrFail($id);

        //return single blog post as a resource
        return new BlogpostResource($post);
    }

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //single blogpost
       $post = blogpost::findOrFail($id);
       
     if($post->delete()){
    return new BlogpostResource($post);
     }
    }
}
