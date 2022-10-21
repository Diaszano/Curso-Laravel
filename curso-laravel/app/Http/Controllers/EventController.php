<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use PhpOption\None;

use App\Models\User;

class EventController extends Controller
{
    public function index(){

        $search = request('search');

        if($search){
            $events = Event::where([
                // [Event::raw('lower(title)'),'like', '%'.strtolower($search).'%']
                ['title','like', '%'.$search.'%']
            ])->get();
        }else{
            $events = Event::all();
        }


        return view('welcome',['events' => $events, 'search' => $search]);
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){
        $event = new Event;

        $event->title = $request->title;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;
        $event->date = $request->date;

        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage =$request->image;

            $extensionImage = $requestImage->extension();
            $nameImage = md5(
                $requestImage->getClientOriginalName() . strtotime('now')
            ) . '.' . $extensionImage;

            $requestImage->move(public_path('img/events'),$nameImage);

            $event->image = $nameImage;
        }else{
            $event->image = '';
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg','Evento criado com sucesso!');
    }

    public function show($id){

        $event = Event::findOrFail($id);

        $eventOwner = User::where('id',$event->user_id)->first()->toArray();

        return view(
            'events.show', ['event' => $event, 'eventOwner' => $eventOwner]
        );
    }

    public function dashboard(){

        $user = auth()->user();

        $events = $user->events;

        return view('events.dashboard',['events' => $events]);
    }
}
