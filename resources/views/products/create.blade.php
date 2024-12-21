@extends('layouts.app')

@section('title', 'Create Product')

@section('contents')
<hr />
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <input type="text" name="product_name" class="form-control" placeholder="Product Name">
        </div>
        <!-- <div class="col">
            <input type="text" name="product_price" class="form-control" placeholder="Product Price">
        </div> -->
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>
    </div>


    <div class="row mb-3">
        <div class="col">
            <div class="form-group">
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="" disabled selected>Select Category</option>
                    @foreach($categories as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- <div class="col">
            <textarea class="form-control" name="description" placeholder="Descriptoin"></textarea>
        </div> -->
    </div>
    <div class="row">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection