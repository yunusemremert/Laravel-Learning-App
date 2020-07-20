<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryRequest;
use App\Story;
use App\Tag;
use App\Events\StoryCreated;
use App\Events\StoryEdited;
use App\Mail\NewStoryNotification;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

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
        $story = Story::where('user_id', auth()->user()->id)
            ->with('tags')
            ->orderBy('id', 'DESC')
            ->paginate(3);

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
        $tags = Tag::get();

        return view('story.create', [
            'story' => $story,
            'tags' => $tags
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

//        Mail::send(new NewStoryNotification($story->title));
//        Log::info('A story with title '. $story->title.' was added.');

        if($request->hasFile('image')){
            $this->_uploadImage($request, $story);
        }

        $story->tags()->sync($request->tag);

        event(new StoryCreated($story->title));

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

        //dd($story->tags->pluck('id')->toArray());

        $tags = Tag::get();

        return view('story.edit', [
            'story' => $story,
            'tags' => $tags
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

        if($request->hasFile('image')){
            $this->_uploadImage($request, $story);
        }

        $story->tags()->sync($request->tag);

        event(new StoryEdited($story->title));

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

    public function _uploadImage($request, $story){
        if($request->hasFile('image')){
            $image = $request->file('image');
            $file_name = time() . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(225, 100)->save(public_path('storage/'.$file_name));

            $story->image = $file_name;
            $story->save();
        }
    }
}
