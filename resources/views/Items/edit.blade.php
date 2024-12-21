@extends('layouts.app')

@section('title', 'Edit Items')

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

<form action="{{ route('Items.update', $item->id) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Item Name</label>
            <input type="text" name="item_name" class="form-control" placeholder="Item Name" value="{{ $item->item_name }}">
        </div>
        <div class="col mb-3">
            <label class="form-label">Item Price</label>
            <input type="text" name="item_price" class="form-control" placeholder="Item Price" value="{{ $item->item_price }}">
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="category_id">Category Name</label>
                <select name="category_id" id="category_id" class="form-control"  >
                    <option value="" disabled selected>Select Category</option>
                    @foreach($categories as $id => $name)
                    <option value="{{ $id }}" {{ $item->category_id == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="product_id">Product Name</label>
                <select name="product_id" id="product_id" class="form-control" >
                    <option value="" disabled selected>Select product</option>
                    @foreach($product as $id => $name)
                    <option value="{{ $id }}" {{ $item->product_id == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>
    
    <div class="row">
        <div class="col">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" placeholder="Description">{{ $item->item_description }}</textarea>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col">
            <label for="image" class="form-label">Edit Item Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            <br>
            <img src="{{ asset('storage/' . $item->item_image) }}" class="card-img-top" style="width: 200px; height: 200px; object-fit: cover;">
        </div>
    </div>

    <div class="row">
        <div class="d-grid">
            <button class="btn btn-warning">Update</button>
        </div>
    </div>
</form>
@endsection