@extends('layouts.app')

@section('title', 'Items')

@section('content')
    <div class="container">
        <h1 class="d-flex justify-content-center fw-bold mb-4">All Items</h1>
        @if (Auth::user()->is_admin)
            <a href="{{ route('items.create') }}" class="btn btn-primary mb-4">Create New Item</a>
        @endif


        <div class="row">
            @if (Auth::user()->is_admin)
                <div class="col-12 mb-4">
                    <div class="alert alert-info text-center">
                        <strong>Admin View:</strong> You can manage items for all users.
                    </div>
                </div>
            @endif
            @if ($items->isEmpty() && Auth::user()->is_admin)
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <strong>No items found.</strong> Please create items for users.
                    </div>
                </div>
            @elseif (!Auth::user()->$items && !Auth::user()->is_admin)
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <strong>No items found.</strong> You haven't added any items yet.
                    </div>
                </div>
                {{-- if the user not admin it will get all items depend od user id --}}
            @elseif (!Auth::user()->is_admin)
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <strong>My Items:</strong> You can manage your own items.
                    </div>
                </div>
                <div class="accordion" id="accordionUserItems">
                    @foreach (Auth::user()->items as $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{ $item->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                                    <span class="fw-bold text-warning"> {{ $item->name }}</span>
                                </button>
                            </h2>
                            <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse"
                                aria-labelledby="heading-{{ $item->id }}" data-bs-parent="#accordionUserItems">
                                <div class="accordion-body">
                                    @if ($item->image)
                                        <img src="{{ asset('/images/' . $item->image) }}" class="img-fluid mb-2"
                                            alt="{{ $item->name }}" style="height: 150px;">
                                    @else
                                        <p class="text-muted">No Image Available</p>
                                    @endif
                                    <p><strong>Price:</strong> ${{ $item->price }}</p>
                                    <p><strong>Qty:</strong> {{ $item->quantity }}</p>
                                    <p><strong>Color:</strong> {{ $item->color }}</p>
                                    <p class="text-muted"><strong>Created:</strong>
                                        {{ $item->created_at->format('d M, Y') }}</p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('items.show', $item->id) }}" class="btn btn-info btn-sm">Show</a>
                                        <a href="{{ route('items.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            onclick="setDeleteModal('{{ route('items.destroy', $item->id) }}', '{{ $item->name }}')">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif (Auth::user()->is_admin && !$users->isEmpty())
                @foreach ($users as $user)
                    <div class="col-md-6 col-lg-4 mb-4" style="opacity: 0.7;">
                        <div class="card shadow-lg">
                            <div class="card-header text-center fw-bold" style="background-color: #2b6cb0; color: white;">
                                {{ $user->name }}'s Items
                            </div>
                            <div class="card-body">
                                <div class="accordion" id="accordion-{{ $user->id }}">
                                    @foreach ($user->items as $item)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading-{{ $item->id }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false">
                                                    <span class="fw-bold text-warning"> {{ $item->name }}</span>
                                                </button>
                                            </h2>
                                            <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse"
                                                aria-labelledby="heading-{{ $item->id }}"
                                                data-bs-parent="#accordion-{{ $user->id }}">
                                                <div class="accordion-body">
                                                    @if ($item->image)
                                                        <img src="{{ asset('/images/' . $item->image) }}"
                                                            class="img-fluid mb-2" alt="{{ $item->name }}"
                                                            style="height: 150px;">
                                                    @else
                                                        <p class="text-muted">No Image Available</p>
                                                    @endif
                                                    <p><strong>Price:</strong> ${{ $item->price }}</p>
                                                    <p><strong>Qty:</strong> {{ $item->quantity }}</p>
                                                    <p><strong>Color:</strong> {{ $item->color }}</p>
                                                    <p class="text-muted"><strong>Created:</strong>
                                                        {{ $item->created_at->format('d M, Y') }}</p>
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ route('items.show', $item->id) }}"
                                                            class="btn btn-info btn-sm">Show</a>
                                                        <a href="{{ route('items.edit', $item->id) }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                            onclick="setDeleteModal('{{ route('items.destroy', $item->id) }}', '{{ $item->name }}')">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            @endif




        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <span id="itemName" class="fw-bold bg-danger text-white p-1"></span> ?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setDeleteModal(actionUrl, itemName) {
            // Set the form action dynamically
            document.getElementById('deleteForm').action = actionUrl;
            // Display the item name in the modal
            document.getElementById('itemName').textContent = itemName;
        }
    </script>
@endsection
