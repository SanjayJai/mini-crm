<header class="bg-dark text-white py-3">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('index') }}">M8</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">

                        {{-- Guest Links --}}
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endguest

                        {{-- Authenticated User Links --}}
                        @auth
                            <li class="nav-item">
                                <span class="nav-link">Welcome, {{ auth()->user()->name }}</span>
                            </li>

                            {{-- Role-based Dashboard Link --}}
                            @if(auth()->user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('companies.index') }}">Admin Dashboard</a>
                                </li>
                            @elseif(auth()->user()->role === 'company')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dashboard') }}">Company Dashboard</a>
                                </li>
                            @elseif(auth()->user()->role === 'employee')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('employee.profile') }}">Employee Dashboard</a>
                                </li>
                            @endif

                            {{-- Logout --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                            </li>
                        @endauth

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
