@extends('layouts.app')

@section('title', 'Edit Category')

@section('contents')
<hr />
<form action="{{ route('Categories.update', $category->category_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" name="category_name" class="form-control" placeholder="Category Name" value="{{ old('category_name', $category->category_name) }}" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="category_image" class="form-label">Edit Category Image</label>
            <input type="file" name="image" id="category_image" class="form-control" accept="image/*">
            <br>
            @if($category->category_image)
            <div>
                <img src="{{ asset('storage/' . $category->category_image) }}" alt="Category Image"  class="card-img-top" style="width: 100%; height: 200px; object-fit: contain;">
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="d-grid">
            <button type="submit" class="btn btn-warning">Update</button>
        </div>
    </div>
</form>
@endsection