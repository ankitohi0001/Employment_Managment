<?php

namespace App\Http\Controllers;

use App\Models\Employes;
use App\Http\Controllers\Controller;
use App\Models\Attendances;
use Illuminate\Http\Request;

class EmployesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userName = auth()->user()->name;
        $attendances = Attendances::where('user_id', auth()->user()->id)->get();
        return view ("employes.index",compact('attendances', 'userName'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Employes $employes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employes $employes)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employes $employes)
    {
      
    }
}
