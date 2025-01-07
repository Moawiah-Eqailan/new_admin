<head>

    <title>BATPARTS</title>
    <link href="{{ asset('images/BATPARTS.jpg') }}" type="image/x-icon" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-slideIn {
            animation: slideIn 0.5s ease-out forwards;
        }

        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .login-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94CA21;
        }

        .custom-shape {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #94CA21 0%, #7ba91b 100%);
            clip-path: polygon(0 0, 100% 0, 100% 80%, 0% 100%);
            z-index: -1;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-100 relative">
    <div class="custom-shape"></div>

    <header class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center animate-slideIn">
            <div class="flex items-center">
                <i class="fas fa-cog text-white text-4xl animate-spin" style="margin: 5px;"></i>
                <h class="navbar-brand" style="font-weight: bold;">BAT<span class="text-primary" style="color: #fff; font-weight: bold;">PARTS</span></h>
            </div>

        </div>
    </header>

    <main class="container mx-auto px-4 py-12 relative">
        <div class="max-w-md mx-auto login-card rounded-2xl shadow-2xl overflow-hidden animate-fadeIn">
            <div class="text-center py-8 relative overflow-hidden">
                <div class="relative z-10">
                    <i class="fas fa-user-circle text-[#94CA21] text-6xl mb-4"></i>
                    <h2 class="text-2xl font-bold text-gray-800">Login</h2>
                    <p class="text-gray-600 mt-2">Welcome To BAT<span class="text-primary" style="color: #94CA21; font-weight: bold;">PARTS</span></p>
                </div>
            </div>

            <form method="POST" action="{{ route('login') }}" class="px-8 py-6">
                @csrf
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li style="color: red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="mb-6 relative">
                    <input id="email" type="email" name="email" required placeholder="Email Address"
                        class="w-full px-4 py-3 pl-12 rounded-lg border border-gray-300 focus:border-[#94CA21] focus:ring-2 focus:ring-[#94CA21] focus:ring-opacity-50 transition-all duration-300">
                    <i class="fas fa-envelope input-icon"></i>
                </div>

                <div class="mb-6 relative">
                    <input id="password" type="password" name="password" required placeholder="Password"
                        class="w-full px-4 py-3 pl-12 rounded-lg border border-gray-300 focus:border-[#94CA21] focus:ring-2 focus:ring-[#94CA21] focus:ring-opacity-50 transition-all duration-300">
                    <i class="fas fa-lock input-icon"></i>

                </div>

                <div class="mb-6">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#94CA21] focus:ring-[#94CA21]">
                        <span class="ml-2 text-gray-600">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-[#94CA21] text-white px-8 py-3 rounded-lg font-bold hover:bg-opacity-90 transition-all duration-300 transform hover:scale-105" style="color: #94CA21;">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>


                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Don't have an account?
                        <a href="/register" class="text-[#94CA21] hover:underline font-bold transition-colors duration-300">
                            Create New Account
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </main>
</body>