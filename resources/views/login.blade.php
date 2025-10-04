<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - SoftTech</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body { min-height:100vh; display:flex; flex-direction:column; }
        main { flex:1; display:flex; align-items:center; justify-content:center; background:#f8f9fa; padding:2rem; }
        .auth-card { max-width:420px; width:100%; }
    </style>
</head>
<body>
    @include('layouts.header')

    <main>
        <div class="auth-card">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-3 text-center">Sign in</h4>

                    @if(session('loginError'))
                        <div class="alert alert-danger">{{ session('loginError') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                   class="form-control" placeholder="you@example.com" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" name="password"
                                   class="form-control" placeholder="Enter your password" required>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>

                        <div class="d-grid mb-2">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>

                        <div class="text-center">
                            <small class="text-muted">Don't have an account? <a href="{{ route('register') }}">Register</a></small>
                        </div>
                    </form>
                </div>
            </div>

            <footer class="text-center mt-3">
                <small class="text-muted">&copy; 2025 SoftTech</small>
            </footer>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>