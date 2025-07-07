@extends('layouts.app')

@section('title', 'User Items')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3>My Items</h3>
        </div>
        <div class="card-body">
            @if ($items->isEmpty())
                <div class="alert alert-info text-center">
                    <strong>No items found.</strong> You haven't added any items yet.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price ($)</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>
                                        <a href="{{ route('items.edit', $item->id) }}" class="btn
                                            btn-sm btn-primary">
                                            Edit
                                        </a>
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST
                                            " class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

