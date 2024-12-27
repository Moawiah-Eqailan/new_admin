@extends('layouts.app')
  
@section('title', 'Detail Category')
  
@section('contents')
    <!-- <h1 class="mb-0">Detail Category</h1> -->
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="category_name" class="form-control" placeholder="Category Name" value="{{ $category->category_name }}" readonly>
        </div>
       
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="image" class="form-label">Detail Image</label>
            <br>
           
            <img src='{{asset("storage")}}/{{$category->category_image}}' class="card-img-top" style="width: 200px; height: 200px; object-fit: cover; ">
            dd({{asset("storage")}}/{{$category->category_image}}); 
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $category->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $category->updated_at }}" readonly>
        </div>
    </div>
@endsection