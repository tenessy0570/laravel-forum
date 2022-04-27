<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Handler;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Topic;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'topic_id' => 'required',
            'name' => 'required',
            'content' => 'required'
        ]);

        $topic = Topic::find($request->topic_id);
        if (!$topic) {
            return Handler::raise404_error('topic with this id doesn\'t exist');
        }


        $post = new Post;
        $post->topic_id = $request->topic_id;
        $post->name = $request->name;
        $post->content = $request->content;
        $post->user_id = $request->user->id;
        $post->save();

        return response()->json($post, 201);
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $post = Post::find($id);

        if (!$post) {
            return Handler::raise404();
        }

        if ($post->user_id !== $request->user->id) {
            return Handler::raise403();
        }

        $post->content = $request->content;
        $post->save();

        return response()->json($post, 200);
    }

    public function delete($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return Handler::raise404();
        }

        if (request()->user->is_staff) {
            $post->delete();
            return Handler::raise200_ok();
        }

        if ($post->user_id !== request()->user->id) {
            return Handler::raise403();
        }
        
        $post->delete();
        return Handler::raise200_ok();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id); 

        if (!$post) {
            return Handler::raise404();
        }

        return $post;
    }

    public function showUser($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return Handler::raise404();
        }

        return $post->user();
    }


    public function showTopic($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return Handler::raise404();
        }

        return $post->topic();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
