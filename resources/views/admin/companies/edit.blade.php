@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Company</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Company Name</label>
            <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $company->name) }}" required>
        </div>

        <div class="mb-3">
            <label>User Name</label>
            <input type="text" name="user_name" class="form-control" value="{{ old('user_name', $company->user->user_name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $company->email) }}" required>
        </div>

        <div class="mb-3">
            <label>Password <small class="text-muted">(leave blank if no change)</small></label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label>Website</label>
            <input type="url" name="website" class="form-control" value="{{ old('website', $company->website) }}">
        </div>

        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">
            @if($company->logo)
                <small class="text-muted d-block mt-1">Current logo: <a href="{{ asset('storage/'.$company->logo) }}" target="_blank">View</a></small>
            @endif
        </div>

        <button class="btn btn-primary">Update Company</button>
    </form>
</div>
@endsection
