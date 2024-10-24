<?php

namespace App\Http\Controllers;

use App\Models\TotalSalary;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Position;
use App\Models\Salary;
use App\Models\Salary_Type;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TotalSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::with('salaries')
                     ->when($search, function ($query) use ($search) {
                         return $query->where('name', 'like', '%' . $search . '%');
                     })
                     ->get();

        foreach ($users as $user) {
            $totalSalary = $user->salaries->sum('amount');
            $singleDaySalary = $totalSalary / 30;
            $user->totalSalary = $totalSalary;
            $user->singleDaySalary = round($singleDaySalary);
            $totalabsents = Attendance::where('user_id', $user->id)
                                      ->where('status', '1')
                                      ->whereMonth('created_at', Carbon::now()->month)
                                      ->count();
            $user->thismonthsalary = round($totalSalary - ($totalabsents * $singleDaySalary));
        }
        return view('totalsalary.index', compact('users'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TotalSalary $totalSalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TotalSalary $totalSalary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TotalSalary $totalSalary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TotalSalary $totalSalary)
    {
        //
    }
}
