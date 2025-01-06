<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BATPARTS')</title>
    <link href="{{ asset('images/BATPARTS.jpg') }}" type="image/x-icon" rel="icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Link to external style.css in public directory -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@700&family=Raleway:wght@400;700&display=swap"

        rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <header id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}"> BAT<span class="text-primary">PARTS</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('home') }}">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
                    @if (Route::has('login'))


                    <ul class="navbar-nav ms-auto">
                        @auth

                        <div class="d-flex align-items-center gap-4">

                            @php($favorites = DB::table('favorites')->where('user_id', '=', Auth::user()->id)->count('id'))
                            <a href="/favorites" class="position-relative d-flex align-items-center" id="favorites-link">
                                <i class="fa-solid fa-heart" style="font-size: 18px; margin: 12px;"></i>
                                <span id="favorites-count" class="position-absolute top-6 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">
                                    {{$favorites}}
                                </span>
                            </a>
                            @php($carts = DB::table('carts')->where('user_id', '=', Auth::user()->id)->count('id'))
                            <a href="/cart" class="position-relative d-flex align-items-center" id="cart-link">
                                <i class="fa-solid fa-cart-shopping" style="font-size: 18px; margin: 12px;"></i>
                                <span id="cart-count" class="position-absolute top-6 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">
                                    {{$carts}}
                                </span>
                            </a>
                        </div>


                        <li class="nav-item dropdown" style="margin-left:39px">
                            <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                                {{ Auth::user()->name }}

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <x-responsive-nav-link :href=" route('UserProfile')"> <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400" style="color: #94CA21;"></i>
                                        {{ __('Profile') }}
                                    </x-responsive-nav-link>


                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-responsive-nav-link :href="route('logout')"> <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400" style="color: #94CA21;"></i>
                                            {{ __('Logout') }}
                                        </x-responsive-nav-link>
                                    </form>
                            </ul>
                        </li>
                        @else
                        <div>
                            <a href="/favorites">
                                <i class="fa-solid fa-heart" style="margin: 12px;"></i>
                            </a>
                            <a href="/cart">
                                <i class="fa-solid fa-cart-shopping" style="margin: 12px;"></i>
                            </a>
                        </div>
                        <li class="nav-item">

                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                        @endif
                        @endauth
                    </ul>
                    @endif
                </div>
        </nav>
    </header>
    <script>
        document.querySelector('.fa-cart-shopping').addEventListener('click', function(event) {
            @auth
            return;
            @else
            event.preventDefault();
            Swal.fire({
                title: 'Please log in first',
                text: 'You must log in to access your cart.',
                icon: 'warning',
                confirmButtonText: 'Log In',
                showCancelButton: true,
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route("login") }}';

                }
            });
            @endauth
        });

        function updateFavoritesCount() {
            fetch('/favorites/count')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('favorites-count').textContent = data.count;
                })
                .catch(error => console.log(error));
        }

        function updateCartCount() {
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('cart-count').textContent = data.count;
                })
                .catch(error => console.log(error));
        }
    </script>