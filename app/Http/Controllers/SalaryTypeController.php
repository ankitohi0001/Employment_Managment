<?php

namespace App\Http\Controllers;

use App\Models\Salary_Type;
use Illuminate\Http\Request;

class SalaryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $salary_types = Salary_Type::when($search, function ($query) use ($search) {
            return $query->where('salary_type', 'like', '%' . $search . '%');
        })->get();

        return view('salary_types.index', compact('salary_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('salary_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $salaryTypes = new Salary_Type;
        $salaryTypes->salary_type = $request->salary_type;
        $salaryTypes->save();

        return redirect()->route('salary_types.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salary_Type $salary_Type)
    {
        return view('salary_types.show', compact('salary_Type')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $salary_Type = Salary_Type::where('id',$id)->first();
        return view('salary_types.edit', compact('salary_Type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $salary_Type = Salary_Type::findOrFail($id);
        $salary_Type->salary_type = $request->salary_type;
        $salary_Type->save();
        return redirect()->route('salary_types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary_Type $salary_Type)
    {
        $salary_Type->delete();
        return redirect()->route('salary_types.index');
    }
}
