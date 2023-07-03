<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\MaritalStatus;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Qualification;
use App\Models\Relationship;
use App\Models\Degree;
use App\Models\Business;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FamilyMemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Family::query();

        // Search by occupation name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('head_first_name', 'like', "%$search%")->orWhere('head_middle_name', 'like', "%$search%")->orWhere('head_last_name', 'like', "%$search%")->orWhere('head_mobile_number', 'like', "%$search%");
        }
        $families = $query->withCount('members')->orderBy('id', 'desc')->paginate(10);
        
        $query1 = FamilyMember::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query1->where('first_name', 'like', "%$search%")->orWhere('middle_name', 'like', "%$search%")->orWhere('last_name', 'like', "%$search%")->orWhere('mobile_number', 'like', "%$search%");
        }
        $fmembers = $query1->orderBy('id', 'desc')->paginate(10);
        // dd($fmembers);
        return view('families.index', compact('families', 'fmembers'));
    }

    public function create()
    {
        $family = Family::all();
        $categories = Category::all();
        $maritals = MaritalStatus::all();
        $subcategories = Subcategory::all();
        $qualifications = Qualification::all();
        $relationships = Relationship::all();
        $degrees = Degree::all();
        return view('members.create', compact('family','categories', 'subcategories', 'qualifications', 'relationships', 'degrees','maritals'));
    }

    public function store(Request $request, Family $family)
    {
        $memberOccupation = $request->input('occupation');
        $memberqualification =  $request->input('qualification');
        $memberdegree = $request->input('degree');

        if(($request->input('head_dob')) == null){
            $headDob = null ;
        }else{
            $headDob = Carbon::createFromFormat('Y-m-d', $request->input('head_dob'));

        }

        if(($request->input('date_of_anniversary')) == null){
            $headAnniversary = null ;
        }else{
            $headAnniversary = Carbon::createFromFormat('Y-m-d', $request->input('date_of_anniversary'));

        }

        $occupation = null;
        if($request->has('occupation') && $request->input('occupation_other') == ''){
            $occupation = $request->input('occupation');
        }

        if($request->has('occupation_other') && $memberOccupation == 'Others'){
            $occupation = $request->input('occupation_other');
        }

        $qualification = null;
        if($request->has('qualification') &&  $request->input('qualification_other') == ''){
            $qualification = $request->input('qualification');
        }
        if($request->has('qualification_other') && $memberqualification == 'Others'){
            $qualification = $request->input('qualification_other');
        }

        $degree = null;
        if($request->has('degree') && $request->input('degree_other') == ''){
            $degree = $request->input('degree');
        }
        if($request->has('degree_other') && $memberdegree == 'Others'){
            $degree = $request->input('degree_other');
        }

        $familyMember = FamilyMember::create([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'family_id' => $request->input('family_id'),
            'occupation' => $occupation,
            'sub_occupation' => $request->input('sub_occupation'),
            'mobile_number' => $request->input('mobile_number'),
            'relationship_with_head' => $request->input('relationship_with_head'),
            'qualification' => $qualification,
            'degree' => $degree,
            'address' => $request->input('address'),
            'marital_status' => $request->input('marital_status'),
            'dob' => $request->input('dob'),
            'date_of_anniversary' => $request->input('date_of_anniversary'),
            'gender' => $request->input('gender'),
        ]);
        $familyMember->save();
        if($request->input('business_name') != '' || $request->input('business_name')!=null){
            $ownerName = $request->input('first_name'). ' ' .$request->input('middle_name'). ' '.$request->input('last_name');
            $business = new Business();
            $business->business_name = $request->input('business_name');
            $business->owner_name = $ownerName;
            $business->owner_id = $family->id;
            $business->file = 'image.jpg';
            $business->category_id = $request->input('category_id');
            $business->subcategory_id = $request->input('subcategory_id'); 
            $business->address = $request->input('address');
            $business->contact_number = $request->input('mobile_number');
            $business->save();
        }

        if ($request->has('continue')) {
            return redirect()->route('members.create')->withInput(['family_id' => $request->input('family_id')]);
        } else {
            return redirect()->route('families.index', $family);
        }
        
    }


    public function edit(Family $family, FamilyMember $member)
    {
       $family = Family::all();
        $categories = Category::all();
        $maritals = MaritalStatus::all();
        $subcategories = Subcategory::all();
        $qualifications = Qualification::all();
        $relationships = Relationship::all();
        $degrees = Degree::all();
        return view('members.edit', compact('family', 'member', 'categories', 'subcategories', 'qualifications', 'relationships', 'degrees', 'maritals'));
    }

    public function update(Request $request, Family $family, FamilyMember $member)
    {
        $memberOccupation = $request->input('occupation');
        $memberqualification =  $request->input('qualification');
        $memberdegree = $request->input('degree');

        if (($request->input('head_dob')) == null) {
            $headDob = null;
        } else {
            $headDob = Carbon::createFromFormat('Y-m-d', $request->input('head_dob'));
        }

        if (($request->input('date_of_anniversary')) == null) {
            $headAnniversary = null;
        } else {
            $headAnniversary = Carbon::createFromFormat('Y-m-d', $request->input('date_of_anniversary'));
        }

        $occupation = null;
        if($request->has('occupation') && $request->input('occupation_other') == ''){
            $occupation = $request->input('occupation');
        }

        if($request->has('occupation_other') && $memberOccupation == 'Others'){
            $occupation = $request->input('occupation_other');
        }

        $qualification = null;
        if($request->has('qualification') &&  $request->input('qualification_other') == ''){
            $qualification = $request->input('qualification');
        }
        if($request->has('qualification_other') && $memberqualification == 'Others'){
            $qualification = $request->input('qualification_other');
        }

        $degree = null;
        if($request->has('degree') && $request->input('degree_other') == ''){
            $degree = $request->input('degree');
        }
        if($request->has('degree_other') && $memberdegree == 'Others'){
            $degree = $request->input('degree_other');
        }

        $member->update([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'family_id' => $request->input('family_id'),
            'occupation' => $occupation,
            'sub_occupation' => $request->input('sub_occupation'),
            'mobile_number' => $request->input('mobile_number'),
            'relationship_with_head' => $request->input('relationship_with_head'),
            'qualification' => $qualification,
            'degree' => $degree,
            'address' => $request->input('address'),
            'marital_status' => $request->input('marital_status'),
            'dob' => $request->input('dob'),
            'date_of_anniversary' => $request->input('date_of_anniversary'),
            'gender' => $request->input('gender'),
        ]);

        return redirect()->route('families.index', ['family' => $family->id]);
    }

    public function destroy(Family $family, FamilyMember $member)
    {
        $member->delete();

        return redirect()->route('families.show', $family);
    }
}
