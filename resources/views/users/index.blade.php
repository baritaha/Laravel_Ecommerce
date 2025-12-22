@extends('layouts.app')

@section('title', 'Users List')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Users</h1>
            <p class="text-sm text-gray-600">Manage all registered users in your system.</p>
        </div>

        <a href="{{ route('users.create') }}"
           class="inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary/25 transition">
            + Create User
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Card -->
    <div class="rounded-2xl bg-white/85 backdrop-blur-xl shadow-xl border border-white overflow-hidden">
        <div class="p-4 sm:p-6">
            <div class="flex items-center justify-between gap-3">
                <h2 class="text-lg font-semibold text-gray-900">All Users</h2>
                <div class="text-sm text-gray-500">
                    Total: <span class="font-semibold text-gray-700">{{ $users->count() }}</span>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 border-y border-gray-200">
                    <tr class="text-left text-gray-600">
                        <th class="px-6 py-3 font-semibold">ID</th>
                        <th class="px-6 py-3 font-semibold">Name</th>
                        <th class="px-6 py-3 font-semibold">Email</th>
                        <th class="px-6 py-3 font-semibold text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @foreach ($users as $user)
                        <tr class="hover:bg-primary-50/60 transition">
                            <td class="px-6 py-4 text-gray-700 font-medium">{{ $user->id }}</td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-9 w-9 rounded-full bg-primary-100 text-primary flex items-center justify-center font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $user->name }}</div>
                                        @if($user->is_admin ?? false)
                                            <span class="inline-flex items-center rounded-full bg-primary-100 px-2 py-0.5 text-xs font-semibold text-primary-800">
                                                Admin
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-gray-700">{{ $user->email }}</td>

                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('users.show', $user->id) }}"
                                       class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-gray-700 hover:border-primary-200 hover:bg-primary-50 transition">
                                        View
                                    </a>

                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="rounded-lg border border-primary-200 bg-primary-50 px-3 py-1.5 text-primary-800 hover:bg-primary-100 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-red-700 hover:bg-red-100 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
