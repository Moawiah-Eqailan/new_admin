@extends('layouts.app')

@section('title', 'Category')

@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <!-- <h1 class="mb-0">List Category</h1> -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{ route('searchh') }}">
        <div class="input-group">
            <input style="width: 250px;" type="text" name="query" class="form-control bg-light border-0 small" placeholder="Search by Id or Name" aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    <a href="{{ route('Categories.create') }}" class="btn btn-primary">Add Category</a>
</div>
<hr />

<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <!-- <th>Price</th> -->
            <th>Category Image</th>
            <!-- <th>Category Code</th>
                <th>Description</th> -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if($categories->count() > 0)
        @foreach($categories as $rs)
        <tr>
            <td class="align-middle">{{ $loop->iteration }}</td>
            <td class="align-middle">{{ $rs->category_name }}</td>
            <!-- <td class="align-middle">{{ $rs->price }}</td> -->
            <td class="align-middle"><img src="{{ asset('storage/' . $rs->category_image) }}" class="card-img-top" style="width: 200px; height: 200px; object-fit:contain;">
            </td>
            <!-- <td class="align-middle">{{ $rs->category_code }}</td>
                        <td class="align-middle">{{ $rs->description }}</td>   -->
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('Categories.show', $rs->category_id) }}" type="button" class="btn btn-secondary">Detail</a>

                    @if(Session::has('success'))
                    <script>
                        Swal.fire({
                            title: 'Success!',
                            text: '{{ Session::get("success") }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route("Categories") }}';
                            }
                        });
                    </script>
                    @endif
                    <a href="{{ route('Categories.edit', $rs->category_id)}}" type="button" class="btn btn-warning">Edit</a>
                    <form id="delete-form-{{ $rs->category_id }}" action="{{ route('Categories.destroy', $rs->category_id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $rs->category_id }}')">Delete</button>
                </div>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="5">Category not found</td>
        </tr>
        @endif
    </tbody>
</table>
<script>
    function confirmDelete(userId) {
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
                document.getElementById(`delete-form-${userId}`).submit();
            }
        });
    }
</script>
@endsection