<?php

namespace App\Http\Controllers;

use App\Mail\NewStoryNotification;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Story;
use App\Http\Requests\StoryRequest;
use Illuminate\Support\Facades\Mail;

class StoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Story::class, 'story');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $story = Story::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(3);

        return view('story.index', compact('story'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create');

        $story = new Story;

        return view('story.create', [
            'story' => $story
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {
        $story = auth()->user()->stories()->create($request->all());

        Mail::send(new NewStoryNotification($story->title));

        return redirect()->route('story.index')->with('status', 'Story Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param Story $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        return view('story.show', compact('story'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Story $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //Gate::authorize('edit-story', $story);

        //$this->authorize('update', $story);

        return view('story.edit', [
            'story' => $story
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Story $story
     * @return void
     */
    public function update(StoryRequest $request, Story $story)
    {
        $story->update($request->all());

        return redirect()->route('story.index')->with('status', 'Story Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Story $story
     * @return void
     */
    public function destroy(Story $story)
    {
        $story->delete();

        return redirect()->route('story.index')->with('status', 'Story Deleted Successfully!');
    }
}
