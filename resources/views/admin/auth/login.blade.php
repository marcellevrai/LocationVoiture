<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #bad6f2;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 900px;
            height: 400px;
            display: flex;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 25px rgba(0,0,0,0.2);
            background-color: #fff;
        }

        .login-image {
            width: 50%;
        }

        .login-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-form {
            width: 50%;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-group {
            position: relative;
        }

        .form-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #999;
        }

        .form-control {
            padding-left: 40px;
            height: 50px;
            font-size: 1rem;
        }

        .btn-lg {
            height: 50px;
            font-size: 1rem;
        }

        .form-title {
            font-size: 24px;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-subtitle {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <!-- Image à gauche -->
    <div class="login-image">
        <img src="{{ asset('storage/image/2024 Jeep® Wrangler - Available Warn Winch & Power Seating.jpg') }}" alt="Voiture">
    </div>

    <!-- Formulaire à droite -->
    <div class="login-form">
        <h4 class="form-title text-center">Connexion Administrateur</h4>
        <p class="form-subtitle text-center">Veuillez entrer vos identifiants</p>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="form-group mb-4">
                <i class="bi bi-envelope-fill"></i>
                <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
            </div>

            <div class="form-group mb-4">
                <i class="bi bi-lock-fill"></i>
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100">Se connecter</button>
        </form>
    </div>
</div>

</body>
</html>
