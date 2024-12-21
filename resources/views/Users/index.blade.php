@extends('layouts.app')

@section('title', 'Users')

@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <form class="form-inline" method="GET" action="{{ route('ssearchh') }}">
        <div class="input-group">
            <input style="width: 250px;" type="text" name="query" class="form-control bg-light border-0 small" placeholder="Search by Name" aria-label="Search" aria-describedby="basic-addon2">
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


<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $rs)
        <tr>
            <td class="align-middle">{{ $loop->iteration }}</td>
            <!-- <td class="align-middle">{{ $rs->id }}</td> -->
            <td class="align-middle">{{ $rs->name }}</td>
            <td class="align-middle">{{ $rs->email }}</td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('Users.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                    @if(Session::has('success'))
                    <script>
                        Swal.fire({
                            title: 'Success!',
                            text: '{{ Session::get("success") }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route("Users") }}';
                            }
                        });
                    </script>
                    @endif
                    <!-- <a href="{{ route('Users.edit', $rs->id)}}" type="button" class="btn btn-warning">Edit</a> -->
                    <form id="delete-form-{{ $rs->id }}" action="{{ route('Users.destroy', $rs->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $rs->id }}')">Delete</button>
                </div>
            </td>
        </tr>
        @endforeach
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