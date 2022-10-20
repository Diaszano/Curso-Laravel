<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use PhpOption\None;

class EventController extends Controller
{
    public function index(){

        $events = Event::all();

        return view('welcome',['events' => $events]);
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

        $event->save();

        return redirect('/')->with('msg','Evento criado com sucesso!');
    }

    public function show($id){

        $event = Event::findOrFail($id);

        return view('events.show', ['event' => $event]);
    }
}
