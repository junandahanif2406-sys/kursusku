<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Kursusku</title>
</head>
<body>
    <h2>Lupa Password</h2>

    <p>Masukkan email yang terdaftar untuk memulihkan password akun Anda.</p>

    @if (session('status'))
        <p style="color: green;">{{ session('status') }}</p>
    @endif

    @if ($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
        >

        <button type="submit">Kirim Link Reset Password</button>
    </form>

    <a href="{{ route('login') }}">Kembali ke Login</a>
</body>
</html>