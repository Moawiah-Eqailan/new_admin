@extends('layouts.app')

@section('contents')
<div class="messages-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h3 class="page-title">Contact Messages</h3>
        </div>
    </div>

    <!-- Messages Table -->
    <div class="table-container">
        <table class="categories-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Message</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                @if($contactMessages->count() > 0)
                @foreach($contactMessages as $contact)
                <tr class="category-row">
                    <td>
                        <span class="id-badge">{{ $loop->iteration }}</span>
                    </td>
                    <td>
                        <div class="user-name">
                            <i class="fas fa-user message-icon"></i>
                            {{ $contact->user_name }}
                        </div>
                    </td>

                    <td>
                        <div class="user-email">
                            <i class="fas fa-at message-icon"></i>
                            {{ $contact->user_email }}
                        </div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('Contact.show', $contact->id) }}" class="action-btn view-btn" title="View Details">
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
                                        window.location.href = '{{ route("Contact") }}';
                                    }
                                });
                            </script>
                            @endif
                            <form id="delete-form-{{ $contact->id }}" action="{{ route('Contact.destroy', $contact->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="action-btn delete-btn" onclick="confirmDelete('{{ $contact->id }}')" title="Delete">
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
                            <i class="fas fa-inbox empty-icon"></i>
                            <p>No messages found</p>
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<style>
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .delete-btn {
        background: #e74a3b;
    }

    .delete-btn:hover {
        background: #be3827;
        color: white;
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

    .messages-container {
        padding: 1.5rem;
        background-color: #f8f9fc;
        min-height: 100vh;
    }

    .page-header {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .page-title {
        font-size: 1.5rem;
        color: #4e73df;
        margin: 0;
        font-weight: 600;
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
        border-bottom: 1px solid #e3e6f0;
    }

    .id-badge {
        background: #4e73df;
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 6px;
        font-size: 0.9rem;
    }

    .user-name,
    .message-content,
    .user-email {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #5a5c69;
    }

    .message-icon {
        color: #4e73df;
        font-size: 0.9rem;
    }

    .message-content {
        max-width: 400px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .messages-container {
            padding: 1rem;
        }

        .message-content {
            max-width: 200px;
        }

        .categories-table {
            display: block;
            overflow-x: auto;
        }
    }
</style>


<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Delete Messages?',
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
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }
</script>
@endsection