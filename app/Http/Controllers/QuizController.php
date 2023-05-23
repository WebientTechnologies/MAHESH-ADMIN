<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuizCreated;

class QuizController extends Controller
{
    public function index()
    {
        $media = Quiz::orderByDesc('created_at')->orderBy('id', 'desc')->get();;
        $quizes = [];
        for($i = 0; $i < sizeof($media); $i++){
            $temporarySignedUrl = Storage::disk('s3')->temporaryUrl($media[$i]['file'], now()->addMinutes(10));

            $quizes[] = ["id" => $media[$i]['id'],"file" => $temporarySignedUrl, "start_time" => $media[$i]['start_time'], "end_time" => $media[$i]['end_time'], "title" => $media[$i]['title'], "link" => $media[$i]['link'], "description" => $media[$i]['description']];                        
        }

        $quizes = collect($quizes);
        return view('quizzes.index', compact('quizes', 'media'));
    }

    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {

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
        
        $quiz = new Quiz;
        $quiz->title = $request->input('title');
        $quiz->description = $request->input('description');
        $quiz->file = $name;
        $quiz->start_time = $request->input('start_time');
        $quiz->end_time = $request->input('end_time');
        $quiz->link = $request->input('link');
        $quiz->created_by = auth()->id();
        $quiz->save();

        return redirect()->route('quizzes.index')->with('success', 'Quize created successfully.');
    }

    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {

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

        $quiz->title = $request->input('title');
        $quiz->description = $request->input('description');
        $quiz->file = $name;
        $quiz->start_time = $request->input('start_time');
        $quiz->end_time = $request->input('end_time');
        $quiz->link = $request->input('link');
        $quiz->created_by = auth()->id();
        $quiz->save();

        return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Quiz $quiz)
    {
        Storage::delete('public/promotions/' . $quiz->file);
        $quiz->delete();

        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
    }
}
