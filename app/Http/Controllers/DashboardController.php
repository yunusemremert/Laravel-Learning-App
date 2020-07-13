<?php

namespace App\Http\Controllers;

use App\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\NotifyAdmin;
use App\Mail\NewStoryNotification;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //DB::enableQueryLog();

        $query = Story::where('status', 1);

        $type = request()->input('type');

        if(in_array($type, ['short', 'long'])){
            $query->where('type', $type);
        }

        $story = $query
            ->with('user')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('dashboard.index', compact('story'));
    }

    /**
     * Display the specified resource.
     *
     * @param Story $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $activeStory)
    {
        return view('dashboard.show', [
            'story' => $activeStory
        ]);
    }

    public function email(){
//        Mail::raw('This is the Test Email', function ($message){
//            $message->to('admin@localhost.com')
//                ->subject('A new Story was Added');
//        });

        //Mail::send(new NotifyAdmin('Title of the Story'));

        Mail::send(new NewStoryNotification('Title of the Story'));

        dd('here');
    }
}
