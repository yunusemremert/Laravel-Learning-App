<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Story;

class StoryController extends Controller
{
    public function index()
    {
        $story = Story::onlyTrashed()
            ->with('user')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('admin.story.index', compact('story'));
    }

    public function restore($id){
        $story = Story::withTrashed()->findOrFail($id);
        $story->restore();

        return redirect()->route('admin.story.index')->with('status', 'Story Restored Successfully!');
    }

    public function delete($id){
        $story = Story::withTrashed()->findOrFail($id);
        $story->forceDelete();

        return redirect()->route('admin.story.index')->with('status', 'Story Deleted Successfully!');
    }
}
