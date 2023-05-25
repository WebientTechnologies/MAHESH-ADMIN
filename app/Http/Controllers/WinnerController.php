<?php

namespace App\Http\Controllers;
use App\Models\Winner;
use App\Models\Quiz;
use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function index()
    {
        $winners = Winner::orderBy('id', 'desc')->get();

        return view('winners.index', compact('winners'));
    }

    public function create()
    {
        $quizzes = Quiz::all(); // Fetch all quizzes from the database
        
        $heads = Family::select('id', 'head_first_name', 'head_middle_name', 'head_last_name')->get();
        $members = FamilyMember::select('id', 'first_name', 'middle_name', 'last_name')->get();
        return view('winners.create', compact('quizzes', 'heads', 'members'));
    }

    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'quiz_id' => 'required',
            'first_winner' => 'required',
            'second_winner' => 'nullable',
            'third_winner' => 'nullable',
        ]);

        // Create a new winner record
        Winner::create($validatedData);

        // Redirect back to the index page or show a success message
        return redirect()->route('winners.index')->with('success', 'Winner details created successfully.');
    }

    public function edit(Winner $winner)
    {
        $quizzes = Quiz::all(); // Fetch all quizzes from the database

        return view('winners.edit', compact('winner', 'quizzes'));
    }

    public function update(Request $request, Winner $winner)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'quiz_id' => 'required',
            'first_winner' => 'required',
            'second_winner' => 'nullable',
            'third_winner' => 'nullable',
        ]);

        // Update the winner record
        $winner->update($validatedData);

        // Redirect back to the index page or show a success message
        return redirect()->route('winners.index')->with('success', 'Winner details updated successfully.');
    }

    public function destroy(Winner $winner)
    {
        // Delete the winner record
        $winner->delete();

        // Redirect back to the index page or show a success message
        return redirect()->route('winners.index')->with('success', 'Winner details deleted successfully.');
    }
}
