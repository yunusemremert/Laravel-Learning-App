<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;

class StoryController extends Controller
{
    public function index(){
        $story = Story::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(1);

        return view('story.index', compact('story'));
    }

    public function show(Story $story){
        return view('story.show', compact('story'));
    }
}
