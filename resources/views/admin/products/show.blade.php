@extends('layouts.app')
  
@section('title', 'Detail Product')
  
@section('contents')
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $product->product_name }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Price</label>
            <input type="text" name="price" class="form-control" placeholder="Price" value="{{ $product->product_price }}" readonly>
        </div>
    </div>
    <div class="row">
        
        <div class="col mb-3">
            <label for="category_id">From Category </label>
            <select name="category_id" id="category_id" class="form-control" required disabled>
                <option value="" disabled selected>Select Category</option>
                @foreach($categories as $id => $name)
                <option value="{{ $id }}" {{ $product->category_id == $id ? 'selected' : '' }}>
                    {{ $name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="image" class="form-label">Detail Image</label>
            <br>
            <img src='{{asset("storage")}}/{{$product->product_image}}' class="card-img-top" style="width: 100%; height: 200px; object-fit: contain;">
        </div>
    </div>


    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $product->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $product->updated_at }}" readonly>
        </div>
    </div>
@endsection