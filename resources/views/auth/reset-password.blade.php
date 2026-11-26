<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Kursusku</title>
</head>
<body>
    <h2>Reset Password</h2>

    @if ($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <label>Email</label>
        <input type="email" name="email"
            value="{{ old('email', $email) }}" required>

        <br><br>

        <label>Password Baru</label>
        <input type="password" name="password" required>

        <br><br>

        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required>

        <br><br>

        <button type="submit">Simpan Password Baru</button>
    </form>
</body>
</html>