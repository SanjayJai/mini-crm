<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Company;

class CompanyController extends Controller
{
    // ----------------------------
    // Admin: List all companies
    // ----------------------------
    public function index()
    {
        $companies = Company::with('user')->paginate(10);
        return view('admin.companies.index', compact('companies'));
    }

    // ----------------------------
    // Admin: Show create form
    // ----------------------------
    public function create()
    {
        return view('admin.companies.create');
    }

    // ----------------------------
    // Admin: Store new company
    // ----------------------------
    public function store(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'user_name'    => 'required|string|max:255|unique:users,user_name',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name'      => $data['company_name'],
            'user_name' => $data['user_name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'role'      => 'company',
        ]);

        Company::create([
            'user_id' => $user->id,
            'name'    => $data['company_name'],
            'email'   => $data['email'],
        ]);

        return redirect()->route('companies.index')->with('success', 'Company created successfully!');
    }

    // ----------------------------
    // Admin: Edit company
    // ----------------------------
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    // ----------------------------
    // Admin: Update company
    // ----------------------------
    public function update(Request $request, Company $company)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'user_name'    => 'required|string|max:255|unique:users,user_name,' . $company->user_id,
            'email'        => 'required|email|unique:users,email,' . $company->user_id,
            'password'     => 'nullable|confirmed|min:6',
            'website'      => 'nullable|url',
            'logo'         => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        $user = $company->user;
        $user->name = $data['company_name'];
        $user->user_name = $data['user_name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        if ($request->hasFile('logo')) {
            if ($company->logo) Storage::disk('public')->delete($company->logo);
            $data['logo'] = $request->file('logo')->store('company-logos', 'public');
        }

        $company->update([
            'name'    => $data['company_name'],
            'email'   => $data['email'],
            'website' => $data['website'] ?? $company->website,
            'logo'    => $data['logo'] ?? $company->logo,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully!');
    }

    // ----------------------------
    // Admin: Delete company
    // ----------------------------
    public function destroy(Company $company)
    {
        $user = $company->user;
        if ($user) $user->delete();
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully!');
    }

    // ----------------------------
    // Company: Edit own profile (logo & website)
    // ----------------------------
public function editProfile()
{
    $company = Auth::user()->company;

    if (!$company) {
        return redirect()->back()->with('error', 'Company profile not found.');
    }

    return view('admin.companies.edit-profile', compact('company'));
}

    // ----------------------------
    // Company: Update own profile
    // ----------------------------
    public function updateProfile(Request $request)
    {
        $company = Auth::user()->company;
        if (!$company) return redirect()->back()->with('error', 'Company profile not found.');

        $data = $request->validate([
            'website' => 'nullable|url',
            'logo'    => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($company->logo) Storage::disk('public')->delete($company->logo);
            $data['logo'] = $request->file('logo')->store('company-logos', 'public');
        }

        $company->update($data);

        return redirect()->route('company.profile.edit')->with('success', 'Profile updated successfully!');
    }
}
