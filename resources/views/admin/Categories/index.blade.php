@extends('layouts.app')

@section('title', 'Category')

@section('contents')
<div class="categories-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">

            <div class="header-actions">
                <form class="search-form" method="GET" action="{{ route('searchh') }}">
                    <div class="search-wrapper">
                        <input type="text" name="query" class="search-input" placeholder="Search by ID or Name...">
                        <button class="search-button" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <a href="{{ route('Categories.create') }}" class="add-button">
                    <i class="fas fa-plus me-2" style="margin: 8px;"></i>
                    Add Category
                </a>
            </div>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="table-container">
        <table class="categories-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($categories->count() > 0)
                @foreach($categories as $rs)
                <tr class="category-row">
                    <td>
                        <span class="id-badge">{{ $loop->iteration }}</span>
                    </td>
                    <td>
                        <div class="category-name">
                            {{ $rs->category_name }}
                        </div>
                    </td>
                    <td>
                        <div class="image-container">
                            <img src="{{ asset('storage/' . $rs->category_image) }}" class="category-image" alt="{{ $rs->category_name }}" style="object-fit: contain;">
                        </div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('Categories.show', $rs->category_id) }}" class="action-btn view-btn" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(Session::has('success'))
                            <script>
                                Swal.fire({
                                    title: 'Success!',
                                    text: '{{ Session::get("success") }}',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = '{{ route("Categories") }}';
                                    }
                                });
                            </script>
                            @endif
                            @if(session('error'))
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: '{{ session("error") }}'
                                });
                            </script>
                            @endif

                            <a href="{{ route('Categories.edit', $rs->category_id)}}" class="action-btn edit-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="delete-form-{{ $rs->category_id }}" action="{{ route('Categories.destroy', $rs->category_id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="action-btn delete-btn" onclick="confirmDelete('{{ $rs->category_id }}')" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4" class="empty-state">
                        <div class="empty-state-content">
                            <i class="fas fa-folder-open empty-icon"></i>
                            <p>No categories found</p>
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        <!-- Pagination -->
        @if ($categories instanceof \Illuminate\Pagination\LengthAwarePaginator && $categories->lastPage() > 1)
        <div class="pagination-container">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($categories->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $categories->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                @endif

                {{-- Pagination Elements --}}
                @foreach (range(1, $categories->lastPage()) as $i)
                <li class="page-item {{ ($categories->currentPage() == $i) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                </li>
                @endforeach

                {{-- Next Page Link --}}
                @if ($categories->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $categories->nextPageUrl() }}" rel="next">&raquo;</a></li>
                @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                @endif
            </ul>
        </div>
        @endif
    </div>
</div>

<style>
    .pagination-container {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    /* Style for Laravel's pagination links */
    .pagination {
        display: flex;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
    }

    .pagination li {
        display: inline-block;
    }

    .pagination li a,
    .pagination li span {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        background: #f8f9fc;
        color: #4e73df;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .pagination li.active span {
        background: #4e73df;
        color: white;
    }

    .pagination li a:hover {
        background: #e3e6f0;
    }

    .categories-container {
        padding: 1.5rem;
        background-color: #f8f9fc;
    }

    .page-header {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title {
        font-size: 1.5rem;
        color: #2c3e50;
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 20rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-wrapper {
        display: flex;
        align-items: center;
        background: #f8f9fc;
        border-radius: 10px;
        padding: 0.5rem;
        border: 1px solid #e3e6f0;
    }

    .search-input {
        border: none;
        background: transparent;
        padding: 0.5rem;
        width: 250px;
        outline: none;
    }

    .search-button {
        background: #4e73df;
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-button:hover {
        background: #2e59d9;
    }

    .add-button {
        background: linear-gradient(45deg, #4e73df, #2e59d9);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .add-button:hover {
        background: linear-gradient(45deg, #2e59d9, #224abe);
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
        color: white;


    }

    .table-container {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .categories-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 0.5rem;
    }

    .categories-table th {
        background: #f8f9fc;
        color: #4e73df;
        padding: 1rem;
        font-weight: 600;
        text-align: left;
    }

    .category-row {
        transition: all 0.3s ease;
    }

    .category-row:hover {
        background: #f8f9fc;
        transform: translateX(5px);
    }

    .category-row td {
        padding: 1rem;
        vertical-align: middle;
    }

    .id-badge {
        background: #4e73df;
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 6px;
        font-size: 0.9rem;
    }

    .category-name {
        display: flex;
        align-items: center;
        font-weight: 500;
    }

    .image-container {
        width: 100px;
        height: 100px;
        overflow: hidden;
        border-radius: 10px;
        border: 2px solid #e3e6f0;
    }

    .category-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        padding: 0.5rem;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        color: white;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
    }

    .view-btn {
        background: #36b9cc;
    }

    .view-btn:hover {
        background: #2c94a3;
        color: white;
    }

    .edit-btn {
        background: #f6c23e;
    }

    .edit-btn:hover {
        background: #dfa821;
        color: white;
    }

    .delete-btn {
        background: #e74a3b;
    }

    .delete-btn:hover {
        background: #be3827;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
    }

    .empty-state-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        color: #858796;
    }

    .empty-icon {
        font-size: 3rem;
        color: #dddfeb;
    }
</style>

<script>
    function confirmDelete(categoryId) {
        Swal.fire({
            title: 'Delete Category?',
            text: "This action cannot be undone",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74a3b',
            cancelButtonColor: '#858796',
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${categoryId}`).submit();
            }
        });
    }
</script>



@endsection