@extends('layouts.app')

@section('title', 'Edit Product')

@section('contents')
<hr />
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@elseif(session('info'))
<div class="alert alert-info">
    {{ session('info') }}
</div>
@endif

<form action="{{ route('products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="title" class="form-control" placeholder="Product Name" value="{{ $product->product_name }}">
        </div>
        <!-- <div class="col mb-3">
            <label class="form-label">Product Price</label>
            <input type="text" name="price" class="form-control" placeholder="Product Price" value="{{ $product->product_price }}">
        </div> -->
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="" disabled selected>Select Category</option>
                    @foreach($categories as $id => $name)
                    <option value="{{ $id }}" {{ $product->category_id == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- <div class="col">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" placeholder="Description">{{ $product->description }}</textarea>
        </div> -->
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="image" class="form-label">Edit Product Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            <br>
            <img src='{{asset("storage")}}/{{$product->product_image}}' class="card-img-top" style="width: 100%; height: 200px; object-fit: contain;">
        </div>
    </div>
   
    <div class="row">
        <div class="d-grid">
            <button class="btn btn-warning">Update</button>
        </div>
    </div>
</form>
@endsection