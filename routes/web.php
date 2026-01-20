<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::post('/login', [AuthController::class, 'userLogin'])->name('login.store');
Route::post('/logout', [AuthController::class, 'userLogout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $books = \App\Models\Book::orderByDesc('created_at')->paginate(12);
        $borrows = \App\Models\Borrow::with('book')
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('dashboard', compact('books', 'borrows'));
    })->name('dashboard');
    Route::post('/books/{book}/borrow', [\App\Http\Controllers\BorrowController::class, 'store'])->name('books.borrow');
});

Route::get('/admin/login', function () {
    return redirect()->route('login');
})->name('admin.login');
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/users', function () {
        $users = \App\Models\User::orderByDesc('created_at')->paginate(10);

        return view('admin.users', compact('users'));
    })->name('admin.users');
    Route::get('/admin/books', [\App\Http\Controllers\Admin\BookController::class, 'index'])->name('admin.books');
    Route::post('/admin/books', [\App\Http\Controllers\Admin\BookController::class, 'store'])->name('admin.books.store');
    Route::put('/admin/books/{book}', [\App\Http\Controllers\Admin\BookController::class, 'update'])->name('admin.books.update');
    Route::delete('/admin/books/{book}', [\App\Http\Controllers\Admin\BookController::class, 'destroy'])->name('admin.books.destroy');
    Route::get('/admin/borrows', function () {
        $borrows = \App\Models\Borrow::with(['book', 'user'])->orderByDesc('created_at')->paginate(10);

        return view('admin.borrows', compact('borrows'));
    })->name('admin.borrows');
    Route::post('/borrows/{borrow}/return', [\App\Http\Controllers\BorrowController::class, 'processReturn'])->name('borrows.return');
});
