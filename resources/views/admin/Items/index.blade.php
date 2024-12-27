@extends('layouts.app')

@section('title', 'Items')

@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{ route('searrchh') }}">
        <div class="input-group">
            <input style="width: 250px;" type="text" name="query" class="form-control bg-light border-0 small" placeholder="Search by Id or Name" aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    <a href="{{ route('Items.create') }}" class="btn btn-primary">Add Item</a>
</div>
<hr />

<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Item Name</th>
            <th>Item Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if($items->count() > 0)
        @foreach($items as $rs)
        <tr>
            <td class="align-middle">{{ $loop->iteration }}</td>
            <td class="align-middle">{{ $rs->item_name }}</td>
            <td class="align-middle">
                <img src="{{ asset('storage/' . $rs->item_image) }}" class="card-img-top" style="width: 200px; height: 200px; object-fit: cover;">
            </td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('Items.show', $rs->id) }}" class="btn btn-secondary">Detail</a>

                    @if(Session::has('success'))
                    <script>
                        Swal.fire({
                            title: 'Success!',
                            text: '{{ Session::get("success") }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route("Items") }}';
                            }
                        });
                    </script>

                    @endif

                    <!-- زر التعديل -->
                    <a href="{{ route('Items.edit', $rs->id) }}" class="btn btn-warning">Edit</a>

                    <!-- زر الحذف -->
                    <form id="delete-form-{{ $rs->id }}" action="{{ route('Items.destroy', $rs->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $rs->id }}')">Delete</button>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="4">No Items Found</td>
        </tr>
        @endif
    </tbody>
</table>

<script>
function confirmDelete(itemId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`delete-form-${itemId}`).submit(); // Submit the form to delete the item
        }
    });
}

</script>
@endsection