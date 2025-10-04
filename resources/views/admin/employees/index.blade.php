@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row mb-4">
        <div class="col">
            <h2 class="mb-0">Employees</h2>
        </div>
        <div class="col text-end">
            <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Employee List</h5>
        </div>
        <div class="card-body">
            @if($employees->count())
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $emp)
                            <tr>
                                <td>{{ $emp->name }}</td>
                                <td>{{ $emp->email }}</td>
                                <td>{{ $emp->position ?? '-' }}</td>
                                <td>{{ $emp->phone ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('employees.edit', $emp->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('employees.destroy', $emp->id) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $employees->links() }} {{-- Pagination --}}
            @else
                <p class="text-center">No employees found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
