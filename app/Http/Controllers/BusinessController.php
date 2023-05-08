<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class BusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::with('category')->with('subcategories')->get();

        return view('businesses.index', compact('businesses'));
    }

    public function create()
    {
        
        $categories = Category::all();
        $subcategories = SubCategory::all();

        return view('businesses.create', compact('categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'business_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        $business = new Business();
        $business->business_name = $validatedData['business_name'];
        $business->owner_name = $validatedData['owner_name'];
        $business->category_id = $validatedData['category_id'];
        $business->subcategory_id = json_encode($request->subcategory_id); 
        // $business->created_by = Auth::user()->id;
    
        $business->save();
    
        return redirect()->route('businesses.index')->with('success', 'Business created successfully.');
    }

    public function edit(Business $business)
    {
        
        $categories = Category::all();
        $subcategories = SubCategory::all();

        return view('businesses.edit', compact('business', 'categories', 'subcategories'));
    }

    public function update(Request $request, Business $business)
    {
        $validatedData = $request->validate([
            'business_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        $business->business_name = $validatedData['business_name'];
        $business->owner_name = $validatedData['owner_name'];
        $business->category_id = $validatedData['category_id'];
        $business->subcategory_id = json_encode($validatedData['subcategory_id']); 
        // $business->updated_by = Auth::user()->id;
    
        $business->save();
    
        return redirect()->route('businesses.index')->with('success', 'Business updated successfully.');
    }

    public function destroy(Business $business)
    {
        $business->delete();

        return redirect()->route('businesses.index')->with('success', 'Business deleted successfully.');
    }
}

