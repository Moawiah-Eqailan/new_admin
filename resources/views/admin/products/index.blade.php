@extends('layouts.app')

@section('title', 'Product')

@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{ route('search') }}">
        <div class="input-group">
            <input style="width: 250px;" type="text" name="query" class="form-control bg-light border-0 small" placeholder="Search by Name or Category" aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
        
    </form>
   
    <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
</div>
<hr />


<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th> Name</th>
            <th>Product Image</th>
            <th>Category </th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if($product->count() > 0)
        @foreach($product as $rs)
        <tr>
            <td class="align-middle">{{ $loop->iteration }}</td>
            <td class="align-middle">{{ $rs->product_name }}</td>
            <td class="align-middle"><img src="{{ asset('storage/' . $rs->product_image) }}" class="card-img-top" style="width: 100%; height: 200px; object-fit: contain;">

            </td>
            <td class="align-middle">{{ $rs->category_id }}</td>

            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('products.show', $rs->product_id) }}" type="button"  class="btn btn-secondary">Detail</a>
                    @if(Session::has('success'))
                    <script>
                        Swal.fire({
                            title: 'Success!',
                            text: '{{ Session::get("success") }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route("products") }}';
                            }
                        });
                    </script>
                    @endif
                    <a href="{{ route('products.edit', $rs->product_id)}}" type="button" class="btn btn-warning">Edit</a>
                    <form id="delete-form-{{ $rs->product_id }}" action="{{ route('products.destroy', $rs->product_id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $rs->product_id }}')">Delete</button>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="5">Product not found</td>
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