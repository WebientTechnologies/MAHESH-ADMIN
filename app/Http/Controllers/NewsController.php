<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index()
    {
        $newses = News::orderBy('id', 'desc')->get();
        return view('newses.index', compact('newses'));
    }

    public function saveToken(Request $request)
    {
        $affectedRows = Family::where('deleted_at', null)
            ->update(['device_token' => $request->token]);
        return response()->json(['token saved successfully.']);
    }

    public function create()
    {
        
        $heads = Family::select('id', 'head_first_name', 'head_middle_name', 'head_last_name')->get();
        $members = FamilyMember::select('id', 'first_name', 'middle_name', 'last_name')->get();
        return view('newses.create', compact('heads', 'members'));
    }

    public function store(Request $request)  
    {

        
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
        ];

        // validate the form data
        $validatedData = $request->validate($rules);

        // create a new News object
        $news = new News;
        $news->title = $validatedData['title'];
        $news->description = $validatedData['description'];
        $news->created_by = auth()->user()->id;
        $news->save();

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
                    $gallery->description =  $validatedData['description'];
                    $gallery->source = 'news'; 
                    $gallery->news_id = $news->id;       
                    $gallery->album_name = $validatedData['title'];
                    $gallery->event_name = $validatedData['title'];
                    $gallery->save();
                
                    
                }
                $imgnumber++;
            }
        }

        $galleries = Gallery::where('deleted_at',null)
                                ->where('news_id', $news->id)
                                ->get(['id', 'name']);
        
        $temporarySignedUrl = Storage::disk('s3')->temporaryUrl($galleries[0]['name'], now()->addMinutes(10));

        $selectedUsers = $request->input('users');

        if (in_array('all', $selectedUsers)) {
            // If 'all' option is selected, retrieve mobile numbers from both tables
            $mobileNumbers = array_merge(
                Family::pluck('head_mobile_number')->toArray(),
                FamilyMember::pluck('mobile_number')->toArray()
            );
        } else {
            // Retrieve mobile numbers for the selected users
            $mobileNumbers = array_merge(
                Family::whereIn('id', $selectedUsers)->pluck('head_mobile_number')->toArray(),
                FamilyMember::whereIn('id', $selectedUsers)->pluck('mobile_number')->toArray()
            );
        }
        
       foreach ($mobileNumbers as $mobileNumber) {
        //dd($mobileNumber);
        $response = Http::post('https://nkybahfpvbf3tlxe5tdzwxnns40tfghu.lambda-url.ap-south-1.on.aws/send-notification', [
            'title' => $request->title,
            'body' => $request->description,
            'type' => 'news',
            'image_url' => $temporarySignedUrl,
            'mobile_number' => $mobileNumber,
        ]);

    }

        
        return redirect()->route('newses.index')->with('success', 'News created successfully.');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('newses.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        // validation rules for the form data
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
        ];

        // validate the form data
        $validatedData = $request->validate($rules);

        // find the News object by its ID
        $news = News::findOrFail($id);
        $news->title = $validatedData['title'];
        $news->description = $validatedData['description'];

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
                    $gallery->description =  $validatedData['description'];
                    $gallery->source = 'news'; 
                    $gallery->news_id = $news->id;       
                    $gallery->album_name = $validatedData['title'];
                    $gallery->event_name = $validatedData['title'];
                    $gallery->save();
                
                    
                }
                $imgnumber++;
            }
        }

        // set the updated_by column
        $news->updated_by = auth()->user()->id;

        // save the News object to the database
        $news->save();

        // redirect to the index page with a success message
        return redirect()->route('newses.index')->with('success', 'News updated successfully.');
    }

    public function destroy($id)
    {
        // find the News object by its ID and delete it
        $news = News::findOrFail($id);
        $news->delete();

        // redirect to the index page with a success message
        return redirect()->route('newses.index')->with('success', 'News deleted successfully.');
    }
}

