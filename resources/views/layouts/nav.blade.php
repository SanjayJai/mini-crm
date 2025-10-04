<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">MiniCRM</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @auth
                    {{-- Admin menus --}}
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
                        <li class="nav-item"><a href="{{ route('companies.index') }}" class="nav-link">Companies</a></li>
                       
                    @endif

                    {{-- Company menus --}}
                    @if(Auth::user()->role === 'company')
                        <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">My Dashboard</a></li>
                        <li class="nav-item"><a href="{{ route('employees.index') }}" class="nav-link">My Employees</a></li>
                    @endif

                    {{-- Employee menus --}}
                    @if(Auth::user()->role === 'employee')
                        <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">My Profile</a></li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item"><span class="nav-link">{{ Auth::user()->name }}</span></li>
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link text-danger">Logout</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
