<?php

namespace App\Exports;

use App\Models\Family;
use App\Models\FamilyMember;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FamilyExport implements FromCollection, WithHeadings
{
    protected $families;

    public function __construct($families)
    {
        $this->families = $families;
    }

    public function collection()
    {
        $data = [];
    
        foreach ($this->families as $family) {
            $row = [
                'First Name' => $family->head_first_name,
                'Middle Name' => $family->head_middle_name,
                'Last Name' => $family->head_last_name,
                'Relationship With Head' => 'Self',
                'Qualification' => $family->head_qualification,
                'Degree' => $family->head_degree,
                'Occupation' => $family->head_occupation,
                'Mobile Number' => $family->head_mobile_number,
                'Address' => $family->head_address,
            ];
    
            $data[] = $row;
    
            $familyMembers = $family->members;
            foreach ($familyMembers as $familyMember) {
                $memberRow = [
                    'First Name' => $familyMember->first_name,
                    'Middle Name' => $familyMember->middle_name,
                    'Last Name' => $familyMember->last_name,
                    'Relationship With Head' => $familyMember->relationship_with_head,
                    'Qualification' => $familyMember->qualification,
                    'Degree' => $familyMember->degree,
                    'Occupation' => $familyMember->occupation,
                    'Mobile Number' => $familyMember->mobile_number,
                    'Address' => $familyMember->address,
                ];
    
                $data[] = $memberRow;
            }
        }
    
        return collect($data);
    }
    
    public function headings(): array
    {
        return [
            'First Name',
            'Middle Name',
            'Last Name',
            'Relationship With Head',
            'Qualification',
            'Degree',
            'Occupation',
            'Mobile Number',
            'Address',
        ];
    }
    
}
