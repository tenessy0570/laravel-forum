<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Handler;
use App\Http\Controllers\Controller;
use App\Models\Subsection;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Topic::all();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::find($id);

        if (!$topic) {
            return Handler::raise404();
        }

        return $topic;
    }

    public function showPosts($id)
    {
        $topic = Topic::find($id);

        if (!$topic) {
            return Handler::raise404();
        }

        return $topic->posts();
    }

    public function create(Request $request)
    {
        $request->validate([
            'subsection_id' => 'required',
            'name' => 'required'
        ]);

        $subsection = Subsection::find($request->subsection_id);
        if (!$subsection) {
            return Handler::raise404_error('subsection with this id doesn\'t exist');
        }

        $topic = new Topic;
        $topic->subsection_id = $request->subsection_id;
        $topic->name = $request->name;
        $topic->user_id = $request->user->id;
        $topic->save();

        return response()->json($topic, 201);
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
    public function delete($id)
    {
        if (!request()->user->is_staff) return Handler::raise403();

        $topic = Topic::find($id);

        if (!$topic) return Handler::raise404();

        $topic->delete();
        return Handler::raise200_ok();
    }
}
