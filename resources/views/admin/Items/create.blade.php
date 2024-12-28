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
      
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="category_id">Category Name</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="" disabled selected>Select Category</option>
                    @foreach($category as $id => $name)
                    <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="product_id">Product Name</label>
                <select name="product_id" id="product_id" class="form-control">
                    <option value="" disabled selected>Select Product</option>
                    @foreach($product as $id => $name)
                    <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
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
<script>
    document.getElementById('category_id').addEventListener('change', function() {
        const categoryId = this.value;

        fetch(`/get-products/${categoryId}`)
            .then(response => response.json())
            .then(data => {
                const productSelect = document.getElementById('product_id');

                productSelect.innerHTML = '<option value="" disabled selected>Select Product</option>';

                data.forEach(product => {
                    const option = document.createElement('option');
                    option.value = product.product_id;
                    option.textContent = product.product_name;
                    productSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching products:', error));
    });


</script>
@endsection