@extends('layouts.app')

@section('title', 'Create Category')

@section('contents')
<hr />
<form action="{{ route('Categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <input type="text" name="category_name" class="form-control" placeholder="Category Name">
        </div>
        
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>
    </div>



    <div class="row">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection
