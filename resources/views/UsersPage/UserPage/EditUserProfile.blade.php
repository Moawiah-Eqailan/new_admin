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
            gap: 0.5rem;
            font-family: 'Kalam', cursive;

        }

        .password-link {
            color: #f5f5f5;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            font-family: 'Kalam', cursive;
        }

        .password-link:hover {
            color: #94CA21;
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

<div class="container" style="margin-top:80px">
    <div class="edit-header">
        <h1 class="edit-title">
            <i class="fas fa-edit"></i> Edit<span class="text-primary">Profile</span>
        </h1>
        <h1 class="edit-title">

            <a href="{{ route('ChangePassword') }}" class="password-link">
                <i class="fa-solid fa-lock"></i>Change <span class="text-primary">Password</span>
            </a>
        </h1>

    </div>

    <form method="POST" action="{{ route('profile.update') }}" class="edit-form">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <i class="fas fa-user form-icon"></i>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ Auth::user()->name }}">
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <i class="fas fa-envelope form-icon"></i>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ Auth::user()->email }}">
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <i class="fas fa-phone form-icon"></i>
                <input type="text" name="phone" class="form-control" placeholder="Enter your phone number" value="{{ Auth::user()->phone }}">
            </div>

            <div class="form-group">
                <label class="form-label">Address</label>
                <i class="fas fa-home form-icon"></i>
                <input type="text" name="address" class="form-control" placeholder="Enter your address" value="{{ Auth::user()->address }}">
            </div>

            <div class="form-group">
                <label class="form-label">Postal Code</label>
                <i class="fas fa-map-pin form-icon"></i>
                <input type="text" name="postcode" class="form-control" placeholder="Enter your postal code" value="{{ Auth::user()->postcode }}">
            </div>

            <div class="form-group">
                <label class="form-label">Province</label>
                <i class="fas fa-flag form-icon"></i>
                <input type="text" name="state" class="form-control" placeholder="Enter your province" value="{{ Auth::user()->state }}">
            </div>

            <div class="form-group">
                <label class="form-label">Country</label>
                <i class="fas fa-globe form-icon"></i>
                <input type="text" class="form-control" value="Jordan" readonly disabled>
            </div>

            <div class="form-group">
                <label class="form-label">City</label>
                <i class="fas fa-city form-icon"></i>
                <select class="form-control" name="city">
                    <option value="" disabled selected>{{ Auth::user()->city }}</option>
                    <option value="Amman">Amman</option>
                    <option value="Zarqa">Zarqa</option>
                    <option value="Irbid">Irbid</option>
                    <option value="Aqaba">Aqaba</option>
                    <option value="Madaba">Madaba</option>
                    <option value="Jerash">Jerash</option>
                    <option value="Ajloun">Ajloun</option>
                    <option value="Karak">Karak</option>
                    <option value="Tafilah">Tafilah</option>
                    <option value="Maan">Maan</option>
                    <option value="Balqa">Balqa</option>
                    <option value="Mafraq">Mafraq</option>
                </select>
            </div>
        </div>

        <button type="submit" class="submit-btn">
            <i class="fas fa-save"></i>
            Save Changes
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