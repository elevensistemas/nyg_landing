<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Ingresar — Administración NYG Transporte</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body class="admin-login-body">
    <main class="admin-login-card">
        <h1>NYG <span>Admin</span></h1>
        <p class="text-muted">Ingresá con tu usuario administrador.</p>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.attempt') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">
                <label class="form-check-label" for="remember">Recordarme</label>
            </div>
            <button type="submit" class="btn btn-cta w-100">Ingresar</button>
        </form>
    </main>
</body>
</html>
