<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
    {
        $search = $request->get('search');
        $users = User::whereHas('attendances', function ($query) use ($search) {
            $query->whereHas('user', function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
            });
        })->with('attendances')->get();
        return view('attendance.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('attendance.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Attendance $attendance)
    {
        $request->validate([
            'status' => 'required',
            'check_in_time' => 'required',
        ]);
        $attendance = new Attendance();
        $attendance->user_id = $request->user_id;
        $attendance->status = $request->status;
        $attendance->check_in_time = $request->check_in_time;
        $attendance->check_out_time = $request->check_out_time;
        $attendance->save();

        return redirect()->route('attendances.index')->with('success', 'Attendance created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        return view('attendance.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = User::where('id', $id)->get();
        $attendance = Attendance::find($id);
        if (!$attendance) {
            abort(404, 'Attendance not found.');
        }
        return view('attendance.edit', compact('attendance', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'status' => 'required',
            'check_in_time' => 'required',
            'check_out_time' => 'required'
        ]);
        $attendance->user_id = $request->user_id;
        $attendance->status = $request->status;
        $attendance->check_in_time = $request->check_in_time;
        $attendance->check_out_time = $request->check_out_time;
        $attendance->save();

        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully.');
    }
public function viewAttendance($userId)
{
    $user = User::find($userId);

    // Get all attendance records for this user
    $attendances = $user->attendances()->orderBy('date', 'desc')->get();
    return view('attendance.view', compact('user', 'attendances'));
}
public function markAbsent($userId)
{
    $user = User::find($userId);
    $existingAttendance = $user->attendances()->whereDate('created_at', now())->first();
    if (!$existingAttendance) {
        $user->attendances()->create([
            'user_id' => $userId,
            'date' => now(),
            'status' => 1, 
        ]);
    } else {
        if (!$existingAttendance->check_out_time) {
            $existingAttendance->update([
                'status' => 1,  
            ]);
        }
    }

    return redirect()->back()->with('success', 'Marked as absent successfully.');
}
public function checkIn($userId)
{
    $user = User::find($userId);

    // Check if already checked in today
    $existingAttendance = $user->attendances()->whereDate('created_at', now())->first();

    // If not checked in today, create a new record
    if (!$existingAttendance) {
        $user->attendances()->create([
            'user_id' => $userId,
            'date' => now(),
            'check_in_time' => now(),
            'status' => 0,  // Mark as present
        ]);
        return redirect()->back()->with('success', 'Checked in successfully.');
    }

    // If 12 hours have passed since check-in, allow check-in again
    $checkInTime = \Carbon\Carbon::parse($existingAttendance->check_in_time);
    if (now()->diffInHours($checkInTime) >= 12) {
        $user->attendances()->create([
            'user_id' => $userId,
            'date' => now(),
            'check_in_time' => now(),
            'status' => 0,
        ]);
        return redirect()->back()->with('success', 'Checked in successfully after 12 hours.');
    }

    return redirect()->back()->with('error', 'Already checked in within the last 12 hours.');
}


public function checkOut($userId)
{
    $user = User::find($userId);

    // Get today's attendance record
    $existingAttendance = $user->attendances()->whereDate('created_at', now())->first();

    // If checked in and no checkout recorded, allow checkout
    if ($existingAttendance && !$existingAttendance->check_out_time) {
        $existingAttendance->update([
            'check_out_time' => now(),
        ]);
        return redirect()->back()->with('success', 'Checked out successfully.');
    }

    return redirect()->back()->with('error', 'No check-in record found or already checked out.');
}
// In your AttendanceController or a scheduled task
public function markAllPresentOnSunday()
{
    if (now()->isSunday()) {
        $users = User::all();
        foreach ($users as $user) {
            $attendance = $user->attendances()->whereDate('created_at', now())->first();
            if (!$attendance) {
                $user->attendances()->create([
                    'user_id' => $user->id,
                    'status' => 0,  // Present
                    'check_in_time' => now(),
                ]);
            }
        }
    }
}
}
