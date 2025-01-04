@extends('layouts.app')

@section('contents')
<div class="create-category-container">
    <div class="form-card">
        <div class="form-header">
            <h2 class="form-title">
                <i class="fas fa-edit me-2"></i>
                Edit Item
            </h2>
            <p class="form-subtitle">Update your item information</p>
        </div>

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

            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-tag me-2" style="margin: 8px;"></i>
                    Item Name
                </label>
                <input type="text" name="item_name" class="form-input" placeholder="Item Name" value="{{ $item->item_name }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-dollar-sign me-2" style="margin: 8px;"></i>
                    Item Price
                </label>
                <input type="text" name="item_price" class="form-input" placeholder="Item Price" value="{{ $item->item_price }}" required>
            </div>

            <div class="form-group">
                <label for="category_id" class="form-label">
                    <i class="fas fa-list me-2" style="margin: 8px;"></i>
                    Category Name
                </label>
                <select name="category_id" id="category_id" class="form-input" required>
                    <option value="" disabled selected>Select Category</option>
                    @foreach($categories as $id => $name)
                    <option value="{{ $id }}" {{ $item->category_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="product_id" class="form-label">
                    <i class="fas fa-box-open me-2" style="margin: 8px;"></i>
                    Product Name
                </label>
                <select name="product_id" id="product_id" class="form-input" required>
                    <option value="" disabled selected>Select Product</option>
                    @foreach($product as $id => $name)
                    <option value="{{ $id }}" {{ $item->product_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-pencil-alt me-2" style="margin: 8px;"></i>
                    Description
                </label>
                <textarea class="form-input" name="description" placeholder="Description">{{ $item->item_description }}</textarea>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">
                    <i class="fas fa-image me-2" style="margin: 8px;"></i>
                    Edit Item Image
                </label>
                <div class="file-upload-wrapper">
                    <div class="file-upload-preview" id="imagePreview">
                        <img src="{{ asset('storage/' . $item->item_image) }}" class="card-img-top" style="max-width: 100%; max-height: 200px; border-radius: 8px; object-fit: contain;">
                    </div>
                    <input type="file" name="image" id="image" class="file-upload-input" accept="image/*">
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('Items') }}" class="cancel-btn">
                    <i class="fas fa-times me-2" style="margin: 8px;"></i>
                    Cancel
                </a>
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save me-2" style="margin: 8px;"></i>
                    Update Item
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .create-category-container {
        padding: 2rem;
        background-color: #f8f9fc;
        min-height: calc(100vh - 100px);
    }

    .form-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        max-width: 800px;
        margin: 0 auto;
    }

    .form-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-title {
        color: #4e73df;
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }

    .form-subtitle {
        color: #858796;
        font-size: 1rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #4e73df;
        font-size: 1rem;
        display: flex;
        align-items: center;
    }

    .form-input {
        padding: 0.8rem 1rem;
        border: 2px solid #e3e6f0;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #4e73df;
        box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
    }

    .file-upload-wrapper {
        position: relative;
    }

    .file-upload-preview {
        border: 2px dashed #e3e6f0;
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-upload-preview:hover {
        border-color: #4e73df;
        background: #f8f9fc;
    }

    .file-upload-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .cancel-btn,
    .submit-btn {
        padding: 0.8rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .cancel-btn {
        background: #e74a3b;
        color: #f8f9fc;
        border: 2px solid #e3e6f0;
        transform: .3s;
    }

    .cancel-btn:hover {
        background: #c11000;
        color: #f8f9fc;
        text-decoration: none;
        transform: translateY(-2px);

    }

    .submit-btn {
        background: linear-gradient(45deg, #f6c23e, #e0a800);
        color: white;
        border: none;
        cursor: pointer;
    }

    .submit-btn:hover {
        background: linear-gradient(45deg, #e0a800, #c69500);
        transform: translateY(-2px);
    }
</style>

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.innerHTML = `
                <img src="${e.target.result}" 
                     style="max-width: 100%; max-height: 200px; border-radius: 8px;" 
                     alt="Preview">
            `;
            }

            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = `
            <i class="fas fa-cloud-upload-alt upload-icon"></i>
            <p class="upload-text">Click or drag image to upload</p>
        `;
        }
    });
</script>

@endsection