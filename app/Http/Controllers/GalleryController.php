<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use File;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;


class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('deleted_at',null)->get(['id', 'name', 'event_name', 'album_name', 'type', 'source']);
        // $media = Gallery::where('deleted_at',null)->get(['id', 'name', 'event_name', 'album_name', 'type', 'source']);
        $media = [];
        for($i = 0; $i < sizeof($galleries); $i++){
            $temporarySignedUrl = Storage::disk('s3')->temporaryUrl($galleries[$i]['name'], now()->addMinutes(10));
            //print($temporarySignedUrl);

            $media[] = ["id" => $galleries[$i]['id'],"name" => $temporarySignedUrl, "type" => $galleries[$i]['type'], "source" => $galleries[$i]['source'], "album_name" => $galleries[$i]['album_name'], "event_name" => $galleries[$i]['event_name'],];                        
        }
       
        $media = collect($media);
        return view('galleries.index', compact('media'));
    }

    public function create()
    {
        $galleries = Gallery::all();
        return view('galleries.create', compact('galleries'));
    }

    public function store(Request $request)
    {
        $allowedfileExtension=['APNG','jpg','png','jpeg','avif', 'gif','svg','mp4','mov','avi', 'mkv','wmv' ];
        $files = $request->file('file'); 
        $errors = [];
        $imgnumber = 0;
        foreach ($files as $key => $file) { 
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension,$allowedfileExtension);
            if($check) {
                $name = 'community-'.time().$imgnumber.'.'.$extension;
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
                $gallery->source = 'media';       
                $gallery->album_name = $request->album_name;
                $gallery->event_name = $request->event_name;
                $gallery->save();
            }
            $imgnumber++;
        }

        return redirect()->route('galleries.index');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('galleries.index');
    }
}
