@include('UsersPage.layouts.header')

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');

        body {
            background: #f5f5f5;
        }

        .header {
            background: #1a1a1a;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #94CA21;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin-right: 2rem;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #94CA21;
        }

        .profile-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .profile-header {
            background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
            border-radius: 20px;
            padding: 3rem;
            position: relative;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/api/placeholder/1200/400') center/cover;
            opacity: 0.1;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid #94CA21;
            position: relative;
            margin: 0 auto;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(148, 202, 33, 0.3);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name {
            text-align: center;
            color: white;
            margin-top: 1rem;
            font-size: 2rem;
        }

        .profile-stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 1rem;
        }

        .stat-item {
            text-align: center;
            color: #94CA21;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .stat-label {
            color: #fff;
            font-size: 0.9rem;
        }

        .profile-actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .action-button {
            background: #94CA21;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .action-button:hover {
            background: #7ab01a;
            color: white;

            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(148, 202, 33, 0.2);
        }

        .info-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            color: #1a1a1a;
        }

        .card-header i {
            font-size: 1.5rem;
            color: #94CA21;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .form-group {
            position: relative;
            opacity: 0;
            transform: translateY(20px);
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #666;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #f8f8f8;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-input:focus {
            border-color: #94CA21;
            box-shadow: 0 0 0 3px rgba(148, 202, 33, 0.1);
            outline: none;
        }

        .form-group i {
            position: absolute;
            left: 1rem;
            top: 51px;
            color: #94CA21;
        }

        .car-decoration {
            position: absolute;
            bottom: -50px;
            right: -50px;
            font-size: 8rem;
            color: rgba(148, 202, 33, 0.1);
            transform: rotate(-15deg);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated {
            animation: slideIn 0.5s ease forwards;
        }
    </style>
</head>

<div class="profile-container">
    <div class="profile-header">

        <h1 class="profile-name">{{ Auth::user()->name }}</h1>

        <div class="profile-actions">
            <a href="{{ route('EditUserProfile') }}" class="action-button">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
            <a href="{{ route('AllProduct') }}" class="action-button">
                <i class="fas fa-car-alt"></i> Browse Parts
            </a>
        </div>
        <i class="fas fa-car car-decoration"></i>
    </div>

    <div class="info-card">
        <div class="card-header">
            <h2>Personal Information</h2>
        </div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <i class="fas fa-user"></i>
                <input type="text" class="form-input" value="{{ Auth::user()->name }}" readonly disabled>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <i class="fas fa-envelope"></i>
                <input type="email" class="form-input" value="{{ Auth::user()->email }}" readonly disabled>
            </div>
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <i class="fas fa-phone"></i>
                <input type="text" class="form-input" value="{{ Auth::user()->phone }}" readonly disabled>
            </div>
        </div>
    </div>

    <div class="info-card">
        <div class="card-header">
            <h2>Address Information</h2>
        </div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Address</label>
                <i class="fas fa-home"></i>
                <input type="text" class="form-input" value="{{ Auth::user()->address }}" readonly disabled>
            </div>
            <div class="form-group">
                <label class="form-label">Postal Code</label>
                <i class="fas fa-map-pin"></i>
                <input type="text" class="form-input" value="{{ Auth::user()->postcode }}" readonly disabled>
            </div>
            <div class="form-group">
                <label class="form-label">City</label>
                <i class="fas fa-city"></i>
                <input type="text" class="form-input" value="{{ Auth::user()->city }}" readonly disabled>
            </div>
            <div class="form-group">
                <label class="form-label">Street</label>
                <i class="fas fa-flag"></i>
                <input type="text" class="form-input" value="{{ Auth::user()->state }}" readonly disabled>
            </div>
            <div class="form-group">
                <label class="form-label">Country</label>
                <i class="fas fa-globe"></i>
                <input type="text" class="form-input" value="Jordan" readonly disabled>
            </div>
        </div>
    </div>
    <div class="d-flex mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-primary me-2">Back</a>
    </div>
</div>
<footer id="footer" class="bg-dark text-white py-4">
    <div class="container text-center">
    <p>&copy; 2025 BAT<span class="text-primary">PARTS</span> </p>
    <div class="d-flex justify-content-center">
            <a href="https://www.facebook.com" class="text-white mx-2">Facebook</a>
            <a href="https://www.x.com" class="text-white mx-2">𝕏</a>
            <a href="https://www.instagram.com" class="text-white mx-2">Instagram</a>

        </div>
    </div>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const formGroups = document.querySelectorAll('.form-group');
        formGroups.forEach((group, index) => {
            setTimeout(() => {
                group.classList.add('animated');
            }, index * 100);
        });

        gsap.from('.profile-avatar', {
            duration: 1,
            y: 50,
            opacity: 0,
            ease: 'power3.out'
        });

        gsap.from('.profile-name', {
            duration: 1,
            y: 30,
            opacity: 0,
            delay: 0.3,
            ease: 'power3.out'
        });

        gsap.from('.stat-item', {
            duration: 0.8,
            y: 20,
            opacity: 0,
            stagger: 0.2,
            delay: 0.5,
            ease: 'power3.out'
        });

        gsap.from('.action-button', {
            duration: 0.8,
            y: 20,
            opacity: 0,
            stagger: 0.2,
            delay: 0.8,
            ease: 'power3.out'
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
<script src="{{ asset('js/plugins.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>