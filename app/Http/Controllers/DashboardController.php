<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Company;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Admin: show summary of all companies & employees
        if ($user->role === 'admin') {
            $companies = Company::count();
            $employees = Employee::count();
            return view('dashboard', compact('user', 'companies','employees' ));
        }

        // Company: show company details & its employees
        if ($user->role === 'company') {
            $company = Company::where('email', $user->email)->first();
            $employees = $company ? $company->employees()->count() : 0;
            return view('dashboard', compact('user', 'company', 'employees'));
        }

        // Employee: show profile & related company
        if ($user->role === 'employee') {
            $employee = Employee::where('user_id', $user->id)->with('company')->first();
            return view('dashboard', compact('user', 'employee'));
        }

        abort(403, 'Unauthorized access');
    }
}
