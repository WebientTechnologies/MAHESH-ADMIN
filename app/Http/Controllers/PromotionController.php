<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PromotionController extends Controller
{
    public function index()
    {
        $media = Promotion::orderByDesc('created_at')->paginate(10);
        $promotions = [];
        for($i = 0; $i < sizeof($media); $i++){
            $temporarySignedUrl = Storage::disk('s3')->temporaryUrl($media[$i]['file'], now()->addMinutes(10));

            $promotions[] = ["id" => $media[$i]['id'],"file" => $temporarySignedUrl, "start_date" => $media[$i]['start_date'], "end_date" => $media[$i]['end_date'], "created_at" => $media[$i]['created_at'], "link" => $media[$i]['link']];                        
        }

        $promotions = collect($promotions);
        return view('promotions.index', compact('promotions', 'media'));
    }

    public function create()
    {
        return view('promotions.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|file|',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $count = Promotion::whereDate('start_date', $request->start_date)->count();
        

        if ($count >= 3) {
            return back()->with('error', 'You cannot have more than 3 promotions in one day.');
        }

        if($request->hasFile('file')) {
            $allowedfileExtension=['jpg','png','jpeg', 'avif'];
            $file = $request->file('file'); 
            $errors = [];

            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension,$allowedfileExtension);
            if($check) {
                $name = 'community-'.time().'.'.$extension;
                    Storage::disk('s3')->put($name, file_get_contents($file));

                
            }
            
        }
        
        $promotion = new Promotion;
        $promotion->file = $name;
        $promotion->start_date = $validatedData['start_date'];
        $promotion->end_date = $validatedData['end_date'];
        $promotion->link = $request->input('link');
        $promotion->created_by = auth()->id();
        $promotion->save();

        return redirect()->route('promotions.index')->with('success', 'Promotion created successfully.');
    }

    public function edit(Promotion $promotion)
    {
        return view('promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($request->hasFile('file')) {
            Storage::delete('public/promotions/' . $promotion->file);

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/promotions', $filename);

            $promotion->file = $filename;
        }

        $promotion->start_date = $validatedData['start_date'];
        $promotion->end_date = $validatedData['end_date'];
        $promotion->link = $request->input('link');
        $promotion->updated_by = auth()->id();
        $promotion->save();

        return redirect()->route('promotions.index')->with('success', 'Promotion updated successfully.');
    }

    public function destroy(Promotion $promotion)
    {
        Storage::delete('public/promotions/' . $promotion->file);
        $promotion->delete();

        return redirect()->route('promotions.index')->with('success', 'Promotion deleted successfully.');
    }
}
