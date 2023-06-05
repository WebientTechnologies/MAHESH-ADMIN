<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    public function index(Request $request)
    {
        $query = Event::query();

        // Search by occupation name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%$search%")->orWhere('description', 'like', "%$search%");
        }
        $events = $query->orderBy('id', 'desc')->paginate(10);
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
        $event->address = $request->address;
        $event->contact_number = $request->contact_number;
        $event->created_by = auth()->user()->id;
        $event->save();
        
         // upload the file and store the file name in the 'file' column
         if ($request->hasFile('file')) {
            $allowedfileExtension=['APNG','jpg','png','jpeg','avif', 'gif','svg','mp4','mov','avi', 'mkv','wmv' ];
            $files = $request->file('file'); 
            $errors = [];
            $imgnumber = 0;
            foreach ($files as $key => $file) { 
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension,$allowedfileExtension);
                if($check) {
                    $name = 'mpm-'.time().$imgnumber.'.'.$extension;
                    //$file->move(public_path() . '/upload/images/', $name);
                    Storage::disk('s3')->put($name, file_get_contents($file));
                    $imageExtension = ['APNG','jpg','png','jpeg','avif', 'gif','svg'];
                    $videoExtension = ['mp4','mov','avi', 'mkv','wmv'];

                    $checkImg = in_array($extension,$imageExtension);
                    if($checkImg){
                        $fileType = 'image';
                    }
                    $checkImg = in_array($extension,$videoExtension);
                    if($checkImg){
                        $fileType = 'video';
                    }
                    $gallery = new Gallery();
                    $gallery->name = $name; 
                    $gallery->type = $fileType;
                    $gallery->description = $request->description;
                    $gallery->source = 'event';
                    $gallery->event_id = $event->id;        
                    $gallery->album_name = $request->title;
                    $gallery->event_name = $request->title;
                    $gallery->save();
                
                    
                }
                $imgnumber++;
            }
        }
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
        $event->address = $request->address;
        $event->contact_number = $request->contact_number;
        // upload the file and update the 'file' column
        if ($request->hasFile('file')) {
            
            $allowedfileExtension=['APNG','jpg','png','jpeg','avif', 'gif','svg','mp4','mov','avi', 'mkv','wmv' ];
            $files = $request->file('file'); 
            $errors = [];
            $imgnumber = 0;
            foreach ($files as $key => $file) { 
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension,$allowedfileExtension);
                if($check) {
                    $name = 'mpm-'.time().$imgnumber.'.'.$extension;
                    //$file->move(public_path() . '/upload/images/', $name);
                    Storage::disk('s3')->put($name, file_get_contents($file));
                    $imageExtension = ['APNG','jpg','png','jpeg','avif', 'gif','svg'];
                    $videoExtension = ['mp4','mov','avi', 'mkv','wmv'];

                    $checkImg = in_array($extension,$imageExtension);
                    if($checkImg){
                        $fileType = 'image';
                    }
                    $checkImg = in_array($extension,$videoExtension);
                    if($checkImg){
                        $fileType = 'video';
                    }
                    $gallery = new Gallery();
                    $gallery->name = $name; 
                    $gallery->type = $fileType;
                    $gallery->description = $request->description;
                    $gallery->source = 'event';
                    $gallery->event_id = $event->id;        
                    $gallery->album_name = $request->title;
                    $gallery->event_name = $request->title;
                    $gallery->save();
                
                    
                }
                $imgnumber++;
            }
        }
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
