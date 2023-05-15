<?php

namespace App\Http\Controllers;
use App\Models\Winner;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function index()
    {
        $winners = Winner::all();

        return view('winners.index', compact('winners'));
    }

    public function create()
    {
        // Show the form to create a new winner
        return view('winners.create');
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
        // Show the form to edit an existing winner
        return view('winners.edit', compact('winner'));
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
