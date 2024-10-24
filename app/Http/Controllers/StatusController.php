<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendances;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('present') == '0') {
            $status = 0;
        }elseif ($request->input('absent') == '1') {
            $status = 1;
        }else{
            $status = $request->input('status', 0);
        }
        $date = $request->input('date', date('Y-m-d'));
        $attendances = Attendances::with('user')->where('date', $date)->where('status', $status)->get();
        return view('status.index', compact('attendances'));
    }
}
