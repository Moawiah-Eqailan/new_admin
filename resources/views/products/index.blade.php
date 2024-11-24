@extends('layouts.app')

@section('title', 'Home Product')

@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">List Product</h1>

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
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif

<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Image</th>
            <th>Category Id</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if($product->count() > 0)
        @foreach($product as $rs)
        <tr>
            <td class="align-middle">{{ $loop->iteration }}</td>
            <td class="align-middle">{{ $rs->product_name }}</td>
            <td class="align-middle">{{ $rs->product_price }}</td>
            <td class="align-middle"><img src="{{ asset('storage/' . $rs->product_image) }}" class="card-img-top" style="width: 200px; height: 200px; object-fit: cover;">
            </td>
            <td class="align-middle">{{ $rs->category_id }}</td>

            <td class="align-middle">{{ $rs->description }}</td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('products.show', $rs->product_id) }}" type="button" class="btn btn-secondary">Detail</a>
                    <a href="{{ route('products.edit', $rs->product_id)}}" type="button" class="btn btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $rs->product_id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger m-0">Delete</button>
                    </form>
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
@endsection