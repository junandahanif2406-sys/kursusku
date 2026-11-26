<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KursusKu UIN</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: white;
            width: 100%;
            max-width: 400px;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        }

        h2 {
            text-align: center;
            color: #2563eb;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            margin-bottom: 28px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            margin-bottom: 18px;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 65px;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 10px;
            border: none;
            background: none;
            color: #2563eb;
            cursor: pointer;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .remember input {
            width: auto;
            margin: 0;
        }

        button[type="submit"] {
            width: 100%;
            padding: 13px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;
        }

        button[type="submit"]:hover {
            background: #1d4ed8;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .success {
            color: #15803d;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .forgot {
            text-align: center;
            margin-top: 20px;
        }

        .forgot a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="login-container">

    <h2>KursusKu UIN</h2>
    <p class="subtitle">Silakan login ke akun Anda</p>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

   <form action="{{ route('login.authenticate') }}" method="POST">
        @csrf

        <label>Username</label>
        <input
            type="text"
            name="username"
            value="{{ old('username') }}"
            placeholder="Masukkan username"
            required
            autofocus
        >

        @error('username')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Password</label>

        <div class="password-wrapper">
            <input
                type="password"
                name="password"
                id="password"
                placeholder="Masukkan password"
                required
            >

            <button
                type="button"
                class="toggle-password"
                onclick="togglePassword()">
                Lihat
            </button>
        </div>

        <div class="remember">
            <input
                type="checkbox"
                name="remember"
                value="1"
                id="remember"
            >
            <label for="remember">Remember Me</label>
        </div>

        <button type="submit">Login</button>

    </form>

    <div class="forgot">
        <a href="#">Lupa Password?</a>
    </div>

</div>

<script>
    function togglePassword() {
        const password = document.getElementById('password');

        password.type = password.type === 'password'
            ? 'text'
            : 'password';
    }
</script>

</body>
</html>