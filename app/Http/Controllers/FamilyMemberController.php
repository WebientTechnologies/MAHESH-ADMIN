<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Http\Request;

class FamilyMemberController extends Controller
{
    public function create(Family $family)
    {
        $members = FamilyMember::all();
        return view('families.members.create', compact('members'));
    }

    public function store(Request $request, Family $family)
    {
        $member = new FamilyMember([
            'name' => $request->input('name'),
            'occupation' => $request->input('occupation'),
            'age' => $request->input('age'),
            'mobile_number' => $request->input('mobile_number'),
        ]);

        $family->members()->save($member);

        return redirect()->route('families.index',$family);
    }

    public function edit(Family $family, FamilyMember $member)
    {
        return view('family_members.edit', compact('family', 'member'));
    }

    public function update(Request $request, Family $family, FamilyMember $member)
    {
        $member->update([
            'name' => $request->input('name'),
            'occupation' => $request->input('occupation'),
            'age' => $request->input('age'),
            'mobile_number' => $request->input('mobile_number'),
        ]);

        return redirect()->route('families.show', $family);
    }

    public function destroy(Family $family, FamilyMember $member)
    {
        $member->delete();

        return redirect()->route('families.show', $family);
    }
}
