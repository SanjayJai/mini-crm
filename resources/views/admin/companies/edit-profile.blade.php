@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Company Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('company.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Website --}}
        <div class="mb-3">
            <label>Website</label>
            <input type="url" name="website" class="form-control" value="{{ old('website', $company->website ?? '') }}">
        </div>

        {{-- Logo --}}
        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">
            @if(!empty($company->logo))
                <small class="text-muted d-block mt-1">
                    Current logo: <a href="{{ asset('storage/'.$company->logo) }}" target="_blank">View</a>
                </small>
            @endif
        </div>

        <button class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
