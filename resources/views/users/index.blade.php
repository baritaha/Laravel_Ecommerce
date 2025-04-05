@extends('layouts.app')

@section('title', 'Users List')

@section('content')
<div class="container">
    <h1 class="mb-4 d-flex justify-content-center fw-bold">All Users</h1>

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">create Users</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped table-hover" style="opacity: 0.7;">
        <thead style="background-color: chocolate; color: white; text-align: center;">
            <tr class="text-uppercase fw-bold text-dark text-center text-decoration-underline table-primary table-striped">
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr style="text-align: center;">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td style="display:flex;justify-content:space-between;">
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
