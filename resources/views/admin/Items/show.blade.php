@extends('layouts.app')

@section('title', 'Detail Items')

@section('contents')
<hr />
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="item_name" class="form-control" placeholder="Item Name" value="{{ $item->item_name }}" readonly disabled>
    </div>


</div>
<div class="row">
<div class="col">
        <div class="form-group">
            <label for="category_id">From Category </label>
            <select name="category_id" id="category_id" class="form-control" required disabled>
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
            <label for="product_id">Product Name </label>
            <select name="product_id" id="product_id" class="form-control" readonly disabled>
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
<div class="row mb-3">
    <div class="col">
        <label for="image" class="form-label">Detail Image</label>
        <br>

        <img src='{{asset("storage")}}/{{$item->item_image}}' class="card-img-top" style="width: 200px; height: 200px; object-fit: contain; ">
    </div>
</div>
<div class="row">

    <div class="col">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" placeholder="Description" readonly disabled>{{ $item->item_description }}</textarea>
    </div>
</div>
<br>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Created At</label>
        <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $item->created_at }}" readonly disabled>
    </div>
    <div class="col mb-3">
        <label class="form-label">Updated At</label>
        <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $item->updated_at }}" readonly disabled>
    </div>
</div>
@endsection