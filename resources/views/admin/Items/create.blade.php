@extends('layouts.app')

@section('title', 'Create Items')

@section('contents')
<hr />
<form action="{{ route('Items.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <label class="form-label">Items Name</label>
            <input type="text" name="item_name" class="form-control" placeholder="Items Name" value="{{ old('item_name') }}">
        </div>
        <div class="col">
            <label class="form-label">Item Price</label>
            <div class="form-group">
                <div class="form-group">
                    <input type="text" name="item_price" class="form-control" placeholder="Item Price" value="{{ old('item_price') }}">
                </div>

            </div>
        </div>
    </div>


    <div class="row">

        <div class="col">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="item_description" placeholder="Description">{{ old('item_description') }}</textarea>
        </div>
        <div class="col">
            <label class="form-label">Select Product</label>
            <div class="form-group">
                <select name="product_id" id="product_id" class="form-control" required>
                    <option value="" disabled selected>Select Product</option>
                    @foreach($product as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


    <div class="row mb-3">
        <div class="col">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" name="item_image" id="image" class="form-control" accept="image/*">
        </div>
    </div>

    <div class="row">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

@endsection