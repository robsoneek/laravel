<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh">
    <div class="card shadow" style="width:380px">
        <div class="card-body p-4">
            <h4 class="card-title text-center mb-4">Přihlášení</h4>

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Uživatelské jméno</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Heslo</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Přihlásit se</button>
            </form>

            <div class="mt-3 text-center">
                <a href="{{ route('home') }}" class="text-muted small">Zpět na katalog</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
