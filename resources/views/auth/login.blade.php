<!DOCTYPE html>
<html>
<head>
    <title>Login SIPENA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">Login SIPENA</div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="/login">
                        @csrf

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100">Login</button>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="/auth/google" class="btn btn-danger w-100">
                            Login dengan Google
                        </a>
                        <hr>                        
                    <a href="/register">Belum punya akun?</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
