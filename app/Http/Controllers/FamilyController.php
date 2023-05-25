<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\MaritalStatus;
use App\Models\Occupation;
use App\Models\Qualification;
use App\Models\Relationship;
use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::withCount('members')->orderBy('id', 'desc')->get();
        //dd( $families);
        return view('families.index', compact('families'));
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

    public function create()
    {
        $members = FamilyMember::all();
        $maritals = MaritalStatus::all();
        $occupations = Occupation::all();
        $qualifications = Qualification::all();
        $relationships = Relationship::all();
        $degrees = Degree::all();
        
        return view('families.create', compact('members', 'maritals', 'occupations', 'qualifications', 'relationships', 'degrees'));
    }

    public function store(Request $request)
    {
       
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

        $family = Family::create([
            'head_first_name' => $request->input('head_first_name'),
            'head_middle_name' => $request->input('head_middle_name'),
            'head_last_name' => $request->input('head_last_name'),
            'head_occupation' => $request->input('head_occupation'),
            'head_mobile_number' => $request->input('head_mobile_number'),
            'relationship_with_head' => $request->input('relationship_with_head'),
            'qualification' => $request->input('qualification'),
            'degree' => $request->input('degree'),
            'address' => $request->input('address'),
            'marital_status' => $request->input('marital_status'),
            'head_dob' => $headDob,
            'date_of_anniversary' => $headAnniversary,
            'gender' => $request->input('gender'),
        ]);
        // dd($family);
        $members = collect($request->input('members'))->map(function ($member) {

            return new FamilyMember([
                'first_name' => $member['first_name'],
                'middle_name' => $member['middle_name'],
                'last_name' => $member['last_name'],
                'occupation' => $member['occupation'],
                'dob' => $member['dob'],
                'mobile_number' => $member['mobile_number'],
                'relationship_with_head' => $member['relationship_with_head'],
                'qualification' => $member['qualification'],
                'degree' => $member['degree'],
                'address' => $member['address'],
                'marital_status' => $member['marital_status'],
                'date_of_anniversary' => $member['date_of_anniversary'],
                'gender' => $member['gender'],
            ]);
        });

        $family->members()->saveMany($members);

        return redirect()->route('families.index');
    }

    public function show(Family $family)
    {
        $family->load('members');

        return view('families.show', compact('family'));
    }

    public function edit(Family $family)
    {
        $maritals = MaritalStatus::all();
        $occupations = Occupation::all();
        $qualifications = Qualification::all();
        $relationships = Relationship::all();
        $degrees = Degree::all();
        return view('families.edit', compact('family', 'maritals', 'occupations', 'qualifications', 'relationships', 'degrees'));
    }

    public function update(Request $request, Family $family)
    {
        $family->update([
            'head_first_name' => $request->input('head_first_name'),
            'head_middle_name' => $request->input('head_middle_name'),
            'head_last_name' => $request->input('head_last_name'),
            'head_occupation' => $request->input('head_occupation'),
            'head_mobile_number' => $request->input('head_mobile_number'),
            'relationship_with_head' => $request->input('relationship_with_head'),
            'qualification' => $request->input('qualification'),
            'degree' => $request->input('degree'),
            'address' => $request->input('address'),
            'marital_status' => $request->input('marital_status'),
            'head_dob' => $request->input('head_dob'),
            'date_of_anniversary' => $request->input('date_of_anniversary'),
            'gender' => $request->input('gender'),
            
        ]);

        $members = collect($request->input('members'))->map(function ($member) use ($request) {
         
            if (isset($member['id'])) {
                return FamilyMember::find($member['id'])->fill([
                    'first_name' => $member['first_name'],
                    'middle_name' => $member['middle_name'],
                    'last_name' => $member['last_name'],
                    'occupation' => $member['occupation'],
                    'dob' => $member['dob'],
                    'mobile_number' => $member['mobile_number'],
                    'relationship_with_head' => $member['relationship_with_head'],
                    'qualification' => $member['qualification'],
                    'degree' => $member['degree'],
                    'address' => $member['address'],
                    'marital_status' => $member['marital_status'],
                    'date_of_anniversary' => $member['date_of_anniversary'],
                    'gender' => $member['gender'],
                ]);
            } else {
                return new FamilyMember([
                    'first_name' => $member['first_name'],
                    'middle_name' => $member['middle_name'],
                    'last_name' => $member['last_name'],
                    'occupation' => $member['occupation'],
                    'dob' => $member['dob'],
                    'mobile_number' => $member['mobile_number'],
                    'relationship_with_head' => $member['relationship_with_head'],
                    'qualification' => $member['qualification'],
                    'degree' => $member['degree'],
                    'address' => $member['address'],
                    'marital_status' => $member['marital_status'],
                    'date_of_anniversary' => $member['date_of_anniversary'],
                    'gender' => $member['gender'],
                ]);
            }
        });

        // $family->members()->delete();
        $family->members()->saveMany($members);

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
}
