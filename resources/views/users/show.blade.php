@extends('layouts.app')

@section('title', 'View User')

@section('content')
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">User Details</h1>
            <p class="text-sm text-gray-600">View user information.</p>
        </div>

        <a href="{{ route('users.index') }}"
           class="rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
            Back
        </a>
    </div>

    <div class="rounded-2xl bg-white/85 backdrop-blur-xl shadow-xl border border-white p-6">
        <div class="flex items-center gap-4">
            <div class="h-14 w-14 rounded-full bg-primary-100 text-primary flex items-center justify-center font-bold text-xl">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <div>
                <div class="text-lg font-bold text-gray-900">{{ $user->name }}</div>
                <div class="text-sm text-gray-600">{{ $user->email }}</div>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                <div class="text-xs font-semibold text-gray-500 uppercase">User ID</div>
                <div class="mt-1 font-semibold text-gray-900">{{ $user->id }}</div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                <div class="text-xs font-semibold text-gray-500 uppercase">Created At</div>
                <div class="mt-1 font-semibold text-gray-900">{{ $user->created_at }}</div>
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-2">
            <a href="{{ route('users.edit', $user->id) }}"
               class="rounded-xl border border-primary-200 bg-primary-50 px-4 py-2 text-sm font-semibold text-primary-800 hover:bg-primary-100 transition">
                Edit
            </a>

            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100 transition">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
