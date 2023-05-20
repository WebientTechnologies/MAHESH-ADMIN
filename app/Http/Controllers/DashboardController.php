<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalFamilies = $this->getTotalFamilies();
        $familiesIn7Days = $this->getFamiliesInDays(7);
        $familiesIn30Days = $this->getFamiliesInDays(30);

        return view('home', compact('totalFamilies', 'familiesIn7Days', 'familiesIn30Days'));
    }

    private function getTotalFamilies()
    {
        return DB::table('families')
        ->leftJoin('family_members', 'families.id', '=', 'family_members.family_id')
        ->select(DB::raw('COUNT(DISTINCT families.id) + COUNT(DISTINCT family_members.id) AS totalCount'))
        ->first()
        ->totalCount;
    }

    private function getFamiliesInDays($days)
    {
        $startDate = Carbon::now()->subDays($days);
        $endDate = Carbon::now();

        return DB::table('families')
        ->leftJoin('family_members', 'families.id', '=', 'family_members.family_id')
        ->whereBetween('families.created_at', [$startDate, $endDate])
        ->select(DB::raw('COUNT(DISTINCT families.id) + COUNT(DISTINCT family_members.id) AS totalCount'))
        ->first()
        ->totalCount;
    }
}
