@extends('layouts.app')

@section('title', 'View User')

@section('content')
<div class="card text-center">
    <div class="card-header">
        View User
    </div>
    <div class="card-body">
      <h1 class="card-title"></h1>
      <p class="card-text m-2"><strong>Name:</strong> {{ $user->name }}</p>
      <p class="card-text m-2"><strong>Email:</strong> {{ $user->email }}</p>
      <a href="{{ route('users.index') }}" class="btn btn-primary">Back to Users</a>
    </div>
    <div class="card-footer text-body-secondary">
        <p class="card-text m-2"><strong>Created_at :</strong>  {{$user->created_at}}</p>

    </div>
  </div>

@endsection
