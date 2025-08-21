<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Authentification')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .auth-container {
            display: flex;
            min-height: 100vh;
        }
        .auth-image {
            flex: 1;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-image img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }
        .auth-form {
            flex: 1;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
        }
        .auth-form-box {
            width: 100%;
            max-width: 500px;
        }
    </style>
</head>
<body>

<div class="auth-container">
    <!-- Colonne image -->
    <div class="auth-image">
        <img src="{{ asset('storage/image/2024 Jeep® Wrangler - Available Warn Winch & Power Seating.jpg') }}" alt="Image d'authentification">
    </div>

    <!-- Colonne formulaire -->
    <div class="auth-form">
        <div class="auth-form-box">
            @yield('form')
        </div>
    </div>
</div>

</body>
</html>
