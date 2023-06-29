<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $query = Business::query();

        // Search by occupation name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('business_name', 'like', "%$search%")->orWhere('owner_name', 'like', "%$search%");
        }

        $businesses = $query->with('category')->orderBy('id', 'desc')->paginate(10);

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
        $filename = 'image.png';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            Storage::disk('s3')->put($filename, file_get_contents($image));
            
        }
        $business = new Business();
        $business->business_name = $validatedData['business_name'];
        $business->owner_name = $ownerName;
        $business->owner_id = $ownerId;
        $business->file = $filename;
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
            $business->file = $name;
        }
        
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

