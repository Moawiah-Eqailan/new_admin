@extends('layouts.app')

@section('title', 'Home Users')

@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">List Users</h1>
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{ route('ssearchh') }}">
        <div class="input-group">
            <input style="width: 250px;" type="text" name="query" class="form-control bg-light border-0 small" placeholder="Search by Id or Name" aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    <a href="{{ route('Users.create') }}" class="btn btn-primary">Add Users</a>
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
            <th>#</th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        @if($users->count() > 0)
        @foreach($users as $rs)
        <tr>
            <td class="align-middle">{{ $loop->iteration }}</td>
            <td class="align-middle">{{ $rs->id }}</td>
            <td class="align-middle">{{ $rs->name }}</td>
            <td class="align-middle">{{ $rs->email }}</td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('Users.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                    <!-- <a href="{{ route('Users.edit', $rs->id)}}" type="button" class="btn btn-warning">Edit</a> -->
                    <form action="{{ route('Users.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
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
            <td class="text-center" colspan="6">User not found</td>
        </tr>
        @endif
    </tbody>
</table>
@endsection