<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - KursusKu UIN</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 650px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h2 {
            color: #2563eb;
        }

        .info {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .logout {
            margin-top: 25px;
            background: #dc2626;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 7px;
            cursor: pointer;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Profil Pengguna</h2>

    <p>Selamat datang di KursusKu UIN!</p>

    <div class="info">
        <strong>Nama:</strong>
        {{ auth()->user()->name }}
    </div>

    <div class="info">
        <strong>Username:</strong>
        {{ auth()->user()->username }}
    </div>

    <div class="info">
        <strong>Email:</strong>
        {{ auth()->user()->email }}
    </div>

    <div class="info">
        <strong>Role:</strong>
        {{ auth()->user()->role }}
    </div>

    <p>
        <a href="{{ route('home') }}">Kembali ke Beranda</a>
    </p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout">
            Logout
        </button>
    </form>

</div>

</body>
</html>