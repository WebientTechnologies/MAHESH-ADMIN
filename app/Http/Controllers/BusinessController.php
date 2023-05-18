<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class BusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::with('category')->with('subcategories')->get();
        //dd($businesses);
        return view('businesses.index', compact('businesses'));
    }

    public function create()
    {
        
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $heads = Family::select('id', 'head_first_name', 'head_middle_name', 'head_last_name')->get();
        $members = FamilyMember::select('id', 'first_name', 'middle_name', 'last_name')->get();

        return view('businesses.create', compact('categories', 'subcategories', 'heads', 'members'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'business_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
        $ownerId = $request->input('owner_id');
        $ownerName = $request->input('owner_name');

        $business = new Business();
        $business->business_name = $validatedData['business_name'];
        $business->owner_name = $ownerName;
        $business->owner_id = $ownerId;
        $business->category_id = $validatedData['category_id'];
        $business->subcategory_id = $request->subcategory_id; 
        $business->address = $request->address;
        $business->contact_number = $request->contact_number;
        // $business->created_by = Auth::user()->id;
    
        $business->save();
    
        return redirect()->route('businesses.index')->with('success', 'Business created successfully.');
    }

    public function edit(Business $business)
    {
        
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $heads = Family::select('id', 'head_first_name', 'head_middle_name', 'head_last_name')->get();
        $members = FamilyMember::select('id', 'first_name', 'middle_name', 'last_name')->get();

        return view('businesses.edit', compact('business', 'categories', 'subcategories' , 'heads', 'members'));
    }

    public function update(Request $request, Business $business)
    {
        $validatedData = $request->validate([
            'business_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        $ownerId = $request->input('owner_id');
        $ownerName = $request->input('owner_name');
        
        $business->business_name = $validatedData['business_name'];
        $business->owner_name = $ownerName;
        $business->owner_id = $ownerId;
        $business->category_id = $validatedData['category_id'];
        $business->subcategory_id = $request->subcategory_id; 
        $business->address = $request->address;
        $business->contact_number = $request->contact_number;
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

