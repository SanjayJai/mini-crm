<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - M8 Software Company</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
        }
        .feature-card {
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

    {{-- Header --}}
    @include('layouts.header')

    {{-- Main Content --}}
    <main>
        <section class="hero-section text-center">
            <div class="container">
                <h1 class="display-4 fw-bold mb-4">Welcome to M8</h1>
                <p class="lead mb-4">Your trusted partner for innovative software solutions</p>

                {{-- Guest: Show Login & Register --}}
                @guest
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg me-2">Get Started</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Login</a>
                @endguest

                {{-- Authenticated: Show Dashboards --}}
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('companies.index') }}" class="btn btn-light btn-lg me-2">Admin Dashboard</a>
                    @elseif(auth()->user()->role === 'company')
                        <a href="{{ route('company.edit') }}" class="btn btn-light btn-lg me-2">Company Dashboard</a>
                    @elseif(auth()->user()->role === 'employee')
                        <a href="{{ route('employee.profile') }}" class="btn btn-light btn-lg me-2">Employee Dashboard</a>
                    @endif

                    <a href="{{ route('logout') }}" class="btn btn-outline-light btn-lg">Logout</a>
                @endauth
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4">
                        <h2 class="mb-4">About Our Software</h2>
                        <p>SoftTech provides cutting-edge software solutions designed to help businesses streamline operations and achieve digital transformation. Our platform offers tools for project management, collaboration, and data analytics.</p>
                        <p>With over 10 years of experience, we've helped thousands of companies improve their productivity and efficiency through our innovative technology solutions.</p>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <img src="https://via.placeholder.com/500x300" alt="Software" class="img-fluid rounded shadow">
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2025 M8 Software. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
