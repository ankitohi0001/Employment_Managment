<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\Salary;
use App\Models\Salary_Type;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = User::with('position')
                    ->whereHas('position', function ($query) use ($search) {
                        $query->where('position_type', 'like', '%' . $search . '%');
                    })
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('role', 'like', '%' . $search . '%')
                    ->get();
        $positions = Position::with('users')->get();
        return view ("users.index", compact('users', 'positions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();
         $salary_types = Salary_Type::all();
        return view ("users.create",compact('positions','salary_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|digits:10',
            'password' => 'required|min:8',
            'aadhar_no' => 'required|digits:12',
            'role' => 'required',
            'pan_no' => 'nullable|alpha_num|size:10',
            'date' => 'required',
            'payment_mode' => 'required',
            'account_no' => 'required|digits:16',
            'bank_branch' => 'required',
            'bank_ifsc' => 'required',
            'account_holder_name' => 'required',
            'salary_type_id' => 'required',

        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone = $request->phone;
        $user->aadhar_no = $request->aadhar_no;
        $user->pan_no = $request->pan_no;
        $user->position_id = $request->position_id;
        $user->date = $request->date;
        $user->payment_mode = $request->payment_mode;
        $user->account_no = $request->account_no;
        $user->bank_branch = $request->bank_branch;
        $user->bank_ifsc = $request->bank_ifsc;
        $user->account_holder_name = $request->account_holder_name;
        $user->role = $request->role;
        $user->save();
        foreach($request->salary_type_id as $key => $salary_type)
        {
         $salary = new Salary(); 
        $salary->user_id = $user->id;
        $salary->salary_type_id = $key;
        $salary->amount = $salary_type;
        $salary->save();
        }
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id',$id)->first();
        $salary_types = Salary_Type::all();
        $salary = Salary::where('user_id',$id)->get();
        $positions=Position::with('users')->get();
        return view ('users.edit',compact('user','positions','salary_types','salary')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'phone' => 'required|digits:10',
            'aadhar_no' => 'required|digits:12',
            'role' => 'required',
            'pan_no' => 'nullable|alpha_num|size:10',
            'date' => 'required',
            'payment_mode' => 'required',
            'account_no' => 'required|digits:16',
            'bank_branch' => 'required',
            'bank_ifsc' => 'required',
            'account_holder_name' => 'required',
            'salary_type_id' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = $request->password;
        }
        $user->phone = $request->phone;
        $user->aadhar_no = $request->aadhar_no;
        $user->pan_no = $request->pan_no;
        $user->position_id = $request->position_id;
        $user->role = $request->role;
        $user->date = $request->date;
        $user->payment_mode = $request->payment_mode;
        $user->account_no = $request->account_no;
        $user->bank_branch = $request->bank_branch;
        $user->bank_ifsc = $request->bank_ifsc;
        $user->account_holder_name = $request->account_holder_name;
        foreach($request->salary_type_id as $key => $salary_type)
        {
         $salary = Salary::where('user_id',$id)->where('salary_type_id',$key)->first();
         if($salary) {
             $salary->amount = $salary_type;
             $salary->save();
         }
        }
        $user->save();
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
