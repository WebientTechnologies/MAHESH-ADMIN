<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $event = new Event;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->event_start_at = $request->event_start_at;
        $event->event_end_at = $request->event_end_at;
        $event->created_by = auth()->user()->id;
        $event->save();
        return redirect()->route('events.index')->with('success','Event added successfully.');
    }

    public function show(Event $event)
    {
        return view('events.show',compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit',compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $event->title = $request->title;
        $event->description = $request->description;
        $event->event_start_at = $request->event_start_at;
        $event->event_end_at = $request->event_end_at;
        $event->updated_by = auth()->user()->id;
        $event->save();
        return redirect()->route('events.index')->with('success','Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->deleted_by = auth()->user()->id;
        $event->delete();
        return redirect()->route('events.index')->with('success','Event deleted successfully.');
    }
}
