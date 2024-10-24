<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) 
    {
        $date = $request->input('date', date('Y-m-d'));
        $search = $request->input('search', '');

        $absentEmployees = Attendances::where('status', '1')->where('date', $date)->count();
        $presentEmployees = Attendances::where('status', '0')->where('date', $date)->count();
        $totalemployees = User::count();
        $employes = User::where('position_id', '2')->count();

        $attendances = Attendances::with(['user' => function($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }])->where('date', $date)->get();

        return view('dashboard.index', compact('presentEmployees', 'absentEmployees', 'totalemployees', 'employes', 'attendances', 'date', 'search'));
    }
}
