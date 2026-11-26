<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('courses', CourseController::class);

Route::resource('enrollments', EnrollmentController::class)
    ->only(['index', 'create', 'store']);

Route::get('/courses/{course}/availability', function (int $course) {
    $availability = [
        1 => ['course' => 'Web Dasar', 'remaining' => 12],
        2 => ['course' => 'PHP Dasar', 'remaining' => 8],
        3 => ['course' => 'Laravel Dasar', 'remaining' => 4],
    ];

    abort_unless(isset($availability[$course]), 404);

    return response()->json($availability[$course]);
})->name('courses.availability');

// Authentication
Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.authenticate');

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Forgot Password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate([
        'email' => ['required', 'email'],
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', 'Link reset password berhasil dikirim.')
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

// Form Reset Password
Route::get('/reset-password/{token}', function (
    string $token,
    Request $request
) {
    return view('auth.reset-password', [
        'token' => $token,
        'email' => $request->email,
    ]);
})->middleware('guest')->name('password.reset');

// Proses Reset Password
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => ['required'],
        'email' => ['required', 'email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => $password,
                'remember_token' => Str::random(60),
            ])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('success', 'Password berhasil diperbarui. Silakan login.')
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.update');

// Profile
Route::get('/profile', function () {
    return view('profile');
})->middleware('auth')->name('profile');