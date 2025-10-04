@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between mb-3">
        <h2>Companies</h2>
        <a href="{{ route('companies.create') }}" class="btn btn-primary">Add Company</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            @if($companies->count())
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Name</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->user->user_name ?? '-' }}</td>
                                <td>{{ $company->user->role ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $companies->links() }} {{-- Pagination --}}
            @else
                <p class="text-center">No companies found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
