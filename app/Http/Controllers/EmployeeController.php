<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees for the company.
     */
    public function index()
    {
        $company = Auth::user()->company;

        $employees = Employee::where('company_id', $company->id)->paginate(10);

        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|unique:employees,email',
            'position' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:6|confirmed',
        ]);

        $company = Auth::user()->company;

        // Create User
        $user = User::create([
            'name' => $data['name'],
            'user_name' => $data['email'], // optional username
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'employee',
        ]);

        // Create Employee linked to User
        Employee::create([
            'company_id' => $company->id,
            'user_id' => $user->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'position' => $data['position'] ?? null,
            'phone' => $data['phone'] ?? null,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified employee.
     */
    public function show($id)
    {
        $company = Auth::user()->company;

        $employee = Employee::where('company_id', $company->id)->findOrFail($id);

        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit($id)
    {
        $company = Auth::user()->company;

        $employee = Employee::where('company_id', $company->id)->findOrFail($id);

        return view('admin.employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, $id)
    {
        $company = Auth::user()->company;

        $employee = Employee::where('company_id', $company->id)->findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$employee->user_id}|unique:employees,email,{$employee->id}",
            'position' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update linked User
        $user = User::findOrFail($employee->user_id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        // Update Employee
        $employee->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'position' => $data['position'] ?? null,
            'phone' => $data['phone'] ?? null,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy($id)
    {
        $company = Auth::user()->company;

        $employee = Employee::where('company_id', $company->id)->findOrFail($id);

        // Delete linked user first
        $user = User::find($employee->user_id);
        if ($user) {
            $user->delete();
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
