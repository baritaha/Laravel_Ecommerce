@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px; border: none; border-radius: 12px; background: linear-gradient(135deg, #e8e8e8, #bdb8b8);">
        <h2 class="text-center mb-4" style="color: #2b6cb0;">Edit User</h2>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Starts -->
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label" style="color: #2b6cb0;">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" style="border-color: #6b705c;">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label" style="color: #2b6cb0;">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" style="border-color: #6b705c;">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label" style="color: #2b6cb0;">Password (optional)</label>
                <input type="password" class="form-control" id="password" name="password" style="border-color: #6b705c;">
            </div>

            <button type="submit" class="btn btn-primary w-100" style="background-color: #2b6cb0; border-color: #2b6cb0; border-radius: 8px;">
                Update
            </button>
        </form>
        <!-- Form Ends -->
    </div>
</div>
@endsection
