@extends('layouts.app')
  
@section('title', 'Home Category')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Category</h1>
        <a href="{{ route('Categories.create') }}" class="btn btn-primary">Add Category</a>
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
                        <td class="align-middle"><img src="{{ asset('storage/' . $rs->category_image) }}" class="card-img-top" style="width: 200px; height: 200px; object-fit: cover;">
                        </td>
                        <!-- <td class="align-middle">{{ $rs->category_code }}</td>
                        <td class="align-middle">{{ $rs->description }}</td>   -->
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('Categories.show', $rs->category_id) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('Categories.edit', $rs->category_id)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('Categories.destroy', $rs->category_id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
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
                    <td class="text-center" colspan="5">Category not found</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection