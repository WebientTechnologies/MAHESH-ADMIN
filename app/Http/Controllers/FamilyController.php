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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FamilyExport;

class FamilyController extends Controller
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

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Perform the search operation based on the query and retrieve the filtered data
        $filteredFamilies = Family::where('column_name', 'LIKE', '%' . $query . '%')->paginate(10);
    
        // Return the filtered data as a JSON response
        return response()->json(['families' => $filteredFamilies]);
    }

    public function getFamilyMembers($familyId)
    {
        $familyMembers = FamilyMember::where('family_id', $familyId)->get();
        return response()->json(['familyMembers' => $familyMembers]);
    }

    // public function create()
    // {
    //     $members = FamilyMember::all();
    //     $maritals = MaritalStatus::all();
    //     $occupations = Occupation::all();
    //     $qualifications = Qualification::all();
    //     $relationships = Relationship::all();
    //     $degrees = Degree::all();
        
    //     return view('families.create', compact('members', 'maritals', 'occupations', 'qualifications', 'relationships', 'degrees'));
    // }

    // public function store(Request $request)
    // {
       
    //     if(($request->input('head_dob')) == null){
    //         $headDob = null ;
    //     }else{
    //         $headDob = Carbon::createFromFormat('Y-m-d', $request->input('head_dob'));

    //     }

    //     if(($request->input('date_of_anniversary')) == null){
    //         $headAnniversary = null ;
    //     }else{
    //         $headAnniversary = Carbon::createFromFormat('Y-m-d', $request->input('date_of_anniversary'));

    //     }

    //     $family = Family::create([
    //         'head_first_name' => $request->input('head_first_name'),
    //         'head_middle_name' => $request->input('head_middle_name'),
    //         'head_last_name' => $request->input('head_last_name'),
    //         'head_occupation' => $request->input('head_occupation'),
    //         'head_mobile_number' => $request->input('head_mobile_number'),
    //         'relationship_with_head' => $request->input('relationship_with_head'),
    //         'qualification' => $request->input('qualification'),
    //         'degree' => $request->input('degree'),
    //         'address' => $request->input('address'),
    //         'marital_status' => $request->input('marital_status'),
    //         'head_dob' => $headDob,
    //         'date_of_anniversary' => $headAnniversary,
    //         'gender' => $request->input('gender'),
    //     ]);
    //     // dd($family);
    //     $members = collect($request->input('members'))->map(function ($member) {

    //         return new FamilyMember([
    //             'first_name' => $member['first_name'],
    //             'middle_name' => $member['middle_name'],
    //             'last_name' => $member['last_name'],
    //             'occupation' => $member['occupation'],
    //             'dob' => $member['dob'],
    //             'mobile_number' => $member['mobile_number'],
    //             'relationship_with_head' => $member['relationship_with_head'],
    //             'qualification' => $member['qualification'],
    //             'degree' => $member['degree'],
    //             'address' => $member['address'],
    //             'marital_status' => $member['marital_status'],
    //             'date_of_anniversary' => isset($member['date_of_anniversary'])?$member['date_of_anniversary']:null,
    //             'gender' => $member['gender'],
    //         ]);
    //     });

    //     $family->members()->saveMany($members);

    //     return redirect()->route('families.index');
    // }

    public function create()
    {
        $categories = Category::all();
        $maritals = MaritalStatus::all();
        $subcategories = Subcategory::all();
        $qualifications = Qualification::all();
        $relationships = Relationship::all();
        $degrees = Degree::all();

        return view('families.create', compact('categories', 'subcategories', 'qualifications', 'relationships', 'degrees','maritals'));
    }


    public function store(Request $request)
    {
        $headOccupation = $request->input('head_occupation');
        $headqualification =  $request->input('qualification');
        $headdegree = $request->input('degree');
       
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
        if($request->has('head_occupation') && $request->input('head_occupation_other') == ''){
            $occupation = $request->input('head_occupation');
        }

        if($request->has('head_occupation_other') && $headOccupation == 'Others'){
            $occupation = $request->input('head_occupation_other');
        }

        $qualification = null;
        if($request->has('qualification') &&  $request->input('qualification_other') == ''){
            $qualification = $request->input('qualification');
        }
        if($request->has('qualification_other') && $headqualification == 'Others'){
            $qualification = $request->input('qualification_other');
        }

        $degree = null;
        if($request->has('degree') && $request->input('degree_other') == ''){
            $degree = $request->input('degree');
        }
        if($request->has('degree_other') && $headdegree == 'Others'){
            $degree = $request->input('degree_other');
        }

        $family = Family::create([
            'head_first_name' => $request->input('head_first_name'),
            'head_middle_name' => $request->input('head_middle_name'),
            'head_last_name' => $request->input('head_last_name'),
            'head_occupation' => $occupation,
            'sub_occupation' => $request->input('sub_occupation'),
            'head_mobile_number' => $request->input('head_mobile_number'),
            'relationship_with_head' => $request->input('relationship_with_head'),
            'qualification' => $qualification,
            'degree' => $degree,
            'address' => $request->input('address'),
            'marital_status' => $request->input('marital_status'),
            'head_dob' => $headDob,
            'date_of_anniversary' => $headAnniversary,
            'gender' => $request->input('gender'),
        ]);
        $family->save();
        if($request->input('business_name') != '' || $request->input('business_name')!=null){
            $ownerName = $request->input('head_first_name'). ' ' .$request->input('head_middle_name'). ' '.$request->input('head_last_name');
            $business = new Business();
            $business->business_name = $request->input('business_name');
            $business->owner_name = $ownerName;
            $business->owner_id = $family->id;
            $business->file = 'image.jpg';
            $business->category_id = $request->input('category_id');
            $business->subcategory_id = $request->input('subcategory_id'); 
            $business->address = $request->input('address');
            $business->contact_number = $request->input('head_mobile_number');
            $business->save();
        }

        return redirect()->route('families.index');
    }

   
    public function getSubcategories(Request $request, $category)
    {
        $subcategories = Category::where('name', $category)->first()->subcategories ?? [];
    
        return response()->json($subcategories);
    }

    public function getAddress(Request $request)
    {
        $familyId = $request->input('familyId');
        $family = Family::find($familyId);

        if ($family) {
            return response()->json(['address' => $family->address]);
        } else {
            return response()->json(['address' => '']);
        }
    }

    public function show(Family $family)
    {
        $family->load('members');

        return view('families.show', compact('family'));
    }

//     public function edit($id)
//     {
//         $family = Family::all();
//         $categories = Category::all();
//         $maritals = MaritalStatus::all();
//         $subcategories = Subcategory::all();
//         $qualifications = Qualification::all();
//         $relationships = Relationship::all();
//         $degrees = Degree::all();
        
//         return view('families.edit', compact('family','categories', 'subcategories', 'qualifications', 'relationships', 'degrees','maritals'));
//     }

// public function update(Request $request, $id)
// {
//     $family = Family::findOrFail($id);
    
//     if(($request->input('head_dob')) == null){
//         $headDob = null;
//     } else {
//         $headDob = Carbon::createFromFormat('Y-m-d', $request->input('head_dob'));
//     }
    
//     if(($request->input('date_of_anniversary')) == null){
//         $headAnniversary = null;
//     } else {
//         $headAnniversary = Carbon::createFromFormat('Y-m-d', $request->input('date_of_anniversary'));
//     }
    
//     $family->update([
//         'head_first_name' => $request->input('head_first_name'),
//         'head_middle_name' => $request->input('head_middle_name'),
//         'head_last_name' => $request->input('head_last_name'),
//         'head_occupation' => $request->input('head_occupation'),
//         'head_mobile_number' => $request->input('head_mobile_number'),
//         'relationship_with_head' => $request->input('relationship_with_head'),
//         'qualification' => $request->input('qualification'),
//         'degree' => $request->input('degree'),
//         'address' => $request->input('address'),
//         'marital_status' => $request->input('marital_status'),
//         'head_dob' => $headDob,
//         'date_of_anniversary' => $headAnniversary,
//         'gender' => $request->input('gender'),
//     ]);
    
//     // Update members
//     $memberIds = collect($request->input('members'))->pluck('id')->filter(); // Retrieve existing member IDs
    
//     FamilyMember::whereIn('id', $memberIds)->update(['deleted_at' => null]); // Restore deleted members
    
//     collect($request->input('members'))->each(function ($member) use ($family) {
//         if (isset($member['id'])) {
//             $existingMember = FamilyMember::findOrFail($member['id']);
//             $existingMember->update([
//                 'first_name' => $member['first_name'],
//                 'middle_name' => $member['middle_name'],
//                 'last_name' => $member['last_name'],
//                 'occupation' => $member['occupation'],
//                 'dob' => $member['dob'],
//                 'mobile_number' => $member['mobile_number'],
//                 'relationship_with_head' => $member['relationship_with_head'],
//                 'qualification' => $member['qualification'],
//                 'degree' => $member['degree'],
//                 'address' => $member['address'],
//                 'marital_status' => $member['marital_status'],
//                 'date_of_anniversary' => isset($member['date_of_anniversary']) ? $member['date_of_anniversary'] : null,
//                 'gender' => $member['gender'],
//             ]);
//         } else {
//             $family->members()->create($member);
//         }
//     });
    
//     return redirect()->route('families.index');
// }


public function edit($id)
{
    $family = Family::findOrFail($id);
    $categories = Category::all();
    $maritals = MaritalStatus::all();
    $subcategories = Subcategory::all();
    $qualifications = Qualification::all();
    $relationships = Relationship::all();
    $degrees = Degree::all();

    return view('families.edit', compact('family', 'categories', 'subcategories', 'qualifications', 'relationships', 'degrees', 'maritals'));
}

public function update(Request $request, $id)
{
    $family = Family::findOrFail($id);

    $headOccupation = $request->input('head_occupation');
    $headqualification = $request->input('qualification');
    $headdegree = $request->input('degree');

    if ($request->input('head_dob') == null) {
        $headDob = null;
    } else {
        $headDob = Carbon::createFromFormat('Y-m-d', $request->input('head_dob'));
    }

    if ($request->input('date_of_anniversary') == null) {
        $headAnniversary = null;
    } else {
        $headAnniversary = Carbon::createFromFormat('Y-m-d', $request->input('date_of_anniversary'));
    }

    $occupation = null;
    if ($request->has('head_occupation') && $request->input('head_occupation_other') == '') {
        $occupation = $request->input('head_occupation');
    }

    if ($request->has('head_occupation_other') && $headOccupation == 'Others') {
        $occupation = $request->input('head_occupation_other');
    }

    $qualification = null;
    if ($request->has('qualification') && $request->input('qualification_other') == '') {
        $qualification = $request->input('qualification');
    }
    if ($request->has('qualification_other') && $headqualification == 'Others') {
        $qualification = $request->input('qualification_other');
    }

    $degree = null;
    if ($request->has('degree') && $request->input('degree_other') == '') {
        $degree = $request->input('degree');
    }
    if ($request->has('degree_other') && $headdegree == 'Others') {
        $degree = $request->input('degree_other');
    }

    $family->head_first_name = $request->input('head_first_name');
    $family->head_middle_name = $request->input('head_middle_name');
    $family->head_last_name = $request->input('head_last_name');
    $family->head_occupation = $occupation;
    $family->sub_occupation = $request->input('sub_occupation');
    $family->head_mobile_number = $request->input('head_mobile_number');
    $family->relationship_with_head = $request->input('relationship_with_head');
    $family->qualification = $qualification;
    $family->degree = $degree;
    $family->address = $request->input('address');
    $family->marital_status = $request->input('marital_status');
    $family->head_dob = $headDob;
    $family->date_of_anniversary = $headAnniversary;
    $family->gender = $request->input('gender');
    $family->save();


    return redirect()->route('families.index');
}


    public function destroy(Family $family)
    {
        $memberId = $family->id;
        $familyMembers = FamilyMember::where('family_id', $memberId)->get();
        FamilyMember::where('family_id', $memberId)->delete(); // delete all family members associated with the family
        $family->delete();

        return redirect()->route('families.index');
    }

    public function deleteMember($id)
    {
        $member = FamilyMember::findOrFail($id);
        $member->delete();

        return redirect()->route('families.index');
    }

    public function exportExcel()
    {
        $families = Family::with('members')->get();
        // dd($families);
        return Excel::download(new FamilyExport($families), 'families_with_members.xlsx');
    }
}
