@include('UsersPage.layouts.header')

<head>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');


        body {
            background: #f5f5f5;
        }


        .edit-header {
            background: #1a1a1a;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .edit-title {
            color: white;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .password-link {
            color: #94CA21;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .password-link:hover {
            color: #7ab01a;
        }

        .edit-form {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #666;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 2.5rem;
            border: 2px solid #eee;
            border-radius: 8px;
            transition: all 0.3s ease;
            background-color: #f8f8f8;
        }

        .form-control:focus {
            border-color: #94CA21;
            outline: none;
            box-shadow: 0 0 0 3px rgba(148, 202, 33, 0.1);
        }

        .form-icon {
            position: absolute;
            right: 1rem;
            top: 3.2rem;
            color: #94CA21;
        }

        .submit-btn {
            background: #94CA21;
            color: white;
            border: none;
            padding: 1rem 3rem;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: block;
            margin: 0 auto;
            font-weight: 500;
        }

        .submit-btn:hover {
            background: #7ab01a;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(148, 202, 33, 0.2);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%2394CA21'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 1rem center;
            background-size: 1.5em;
        }
    </style>
</head>

<br><br>
<div class="container">
    <div class="edit-header">
        <h1 class="edit-title">
        <i class="fa-solid fa-lock-open"></i>Change<span class="text-primary">Password</span>
        </h1>
    </div>

    <form method="POST" action="{{ route('password.update') }}" class="edit-form">
        @csrf
        <div class="form-grid">
            <!-- Old Password -->
            <div class="form-group">
                <label class="form-label">Old Password</label>
                <i class="fas fa-lock form-icon"></i>
                <input type="password" name="old_password" class="form-control" placeholder="Enter your old password">
                @error('old_password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-grid">

            <!-- New Password -->
            <div class="form-group">
                <label class="form-label">New Password</label>
                <i class="fas fa-lock form-icon"></i>
                <input type="password" name="password" class="form-control" placeholder="Enter your new password">
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm New Password -->
            <div class="form-group">
                <label class="form-label">Confirm New Password</label>
                <i class="fas fa-lock form-icon"></i>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your new password">
                @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button type="submit" class="submit-btn">
            <i class="fas fa-save"></i> Save Password
        </button>
    </form>
</div>

@if(session('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session("success") }}',
        icon: 'success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#94CA21'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '{{ route("UserProfile") }}';
        }
    });
</script>
@endif

@include('UsersPage.layouts.footer')