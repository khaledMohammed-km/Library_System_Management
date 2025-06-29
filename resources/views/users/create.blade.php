<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</head>
<body>
    @extends('layouts.app')

    @section('title', 'Register')

    @section('body')
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }
        .library-card {
            background: rgba(255, 248, 220, 0.97);
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
            border: 1px solid #deb887;
        }
        .library-header {
            color: #6b4f1d;
            font-family: 'Merriweather', serif;
            letter-spacing: 1px;
        }
        .library-icon {
            font-size: 2.5rem;
            color: #b8860b;
        }
        .btn-library {
            background-color: #b8860b;
            border: none;
            color: #fff;
        }
        .btn-library:hover {
            background-color: #a4751e;
            color: #fff;
        }
    </style>

    @if ($errors->any())
        <div id="errorMsg" class="errorMsg alert alert-danger alert-dismissible fade show position-fixed start-50 translate-middle-x mt-2" role="alert" style="z-index: 9999;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card library-card border-0 shadow-lg col-sm-10 col-md-7 col-lg-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <span class="library-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-book-half" viewBox="0 0 16 16">
                            <path d="M8.5 2.5v11l.5.5.5-.5v-11l-.5-.5-.5.5z"/>
                            <path d="M2 2.5A2.5 2.5 0 0 1 4.5 0h7A2.5 2.5 0 0 1 14 2.5v11A2.5 2.5 0 0 1 11.5 16h-7A2.5 2.5 0 0 1 2 13.5v-11zm1 0A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v11a1.5 1.5 0 0 1-1.5 1.5h-7A1.5 1.5 0 0 1 3 13.5v-11z"/>
                        </svg>
                    </span>
                    <h2 class="library-header fw-bold mt-2">Library Registration</h2>
                    <p class="text-muted mb-0" style="font-family: 'Merriweather', serif;">Create your library account</p>
                </div>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
                        <label for="name">Full Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                        <label for="password_confirmation">Confirm Password</label>
                    </div>
                    <input type="hidden" name="role" value="User">
                    <div class="d-grid mb-3">
                        <button class="btn btn-library btn-login text-uppercase fw-bold" type="submit">
                            <i class="bi bi-person-plus"></i> Register
                        </button>
                    </div>
                    <div class="d-grid">
                        <a class="btn btn-outline-secondary text-uppercase fw-bold" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Back to Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>