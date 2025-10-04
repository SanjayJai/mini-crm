@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Welcome, {{ $user->name }}</h2>
    <p class="text-muted">Role: <strong>{{ ucfirst($user->role) }}</strong></p>

    @if($user->role === 'admin')
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Total Companies</h5>
                        <h3>{{ $companies }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Total Employees</h5>
                        <h3>{{ $employees }}</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($user->role === 'company')
        <div class="row mt-4">
            {{-- Company Info --}}
            <div class="col-lg-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5>Your Company Details</h5>
                        <p><strong>Name:</strong> {{ $company->name ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $company->email ?? 'N/A' }}</p>
                        <p><strong>Website:</strong> {{ $company->website ?? 'N/A' }}</p>
                        <p><strong>Total Employees:</strong> {{ $employees }}</p>
                        @if($company->logo)
                            <img src="{{ asset('storage/'.$company->logo) }}" alt="Logo" class="img-fluid mt-2" style="max-width: 150px;">
                        @endif
                    </div>
                </div>
            </div>

            {{-- Edit Form --}}
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Edit Company Details</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('company.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Website --}}
                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" name="website" id="website" class="form-control @error('website') is-invalid @enderror"
                                       value="{{ old('website', $company->website) }}">
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Logo --}}
                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo</label>
                                <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($company->logo)
                                    <small class="text-muted">Current logo: <a href="{{ asset('storage/'.$company->logo) }}" target="_blank">View</a></small>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Update Details</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($user->role === 'employee')
        <div class="card mt-4 shadow-sm">
            <div class="card-body">
                <h5>Your Profile</h5>
                <p>Name: {{ $employee->first_name ?? $user->name }} {{ $employee->last_name ?? '' }}</p>
                <p>Email: {{ $user->email }}</p>
                <p>Company: {{ $employee->company->name ?? 'N/A' }}</p>
            </div>
        </div>
    @endif
</div>
@endsection
