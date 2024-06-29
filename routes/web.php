<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\PenaltyController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::patch('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::patch('/students/{student}', [StudentController::class, 'update'])->name('students.update');

    Route::get('/books', [BookController::class, 'index'])->name('book.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/books/store', [BookController::class, 'store'])->name('book.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::patch('books/{book}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('book.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    Route::get('/borrows', [BorrowController::class, 'index'])->name('borrow.index');
    Route::get('/reports', [BorrowController::class, 'reportIndex'])->name('report.index');
    Route::post('/report/export', [BorrowController::class, 'export'])->name('report.export');
    Route::get('/borrows/create', [BorrowController::class, 'create'])->name('borrow.create');
    Route::post('/borrows/store', [BorrowController::class, 'store'])->name('borrow.store');
    Route::post('/borrows/search-student', [BorrowController::class, 'searchStudent'])->name('borrow.searchStudent');
    Route::post('/borrows/books-list', [BorrowController::class, 'listBooks'])->name('borrow.bookList');
    Route::delete('/borrows/{borrow}', [BorrowController::class, 'destroy'])->name('borrow.destroy');
    Route::get('/borrows/{borrow}/edit', [BorrowController::class, 'edit'])->name('borrow.edit');
    Route::put('/borrows/{borrow}', [BorrowController::class, 'update'])->name('borrow.update');

    Route::get('/children', [ChildrenController::class, 'index'])->name('children.index');
    Route::get('/children/borrows', [ChildrenController::class, 'parentRecord'])->name('children.parentBorrows');
    Route::get('/children/borrows/{borrow}/details', [ChildrenController::class, 'edit'])->name('children.recordDetail');

    Route::get('/penalties', [PenaltyController::class, 'index'])->name('penalties.index');
    Route::get('/penalties/parent', [PenaltyController::class, 'parentIndex'])->name('penalties-parent.index');
    Route::get('/penalties/create', [PenaltyController::class, 'create'])->name('penalties.create');
    Route::post('/penalties', [PenaltyController::class, 'store'])->name('penalties.store');
    Route::get('/penalties/{penalty}/edit', [PenaltyController::class, 'edit'])->name('penalties.edit');
    Route::put('/penalties/{penalty}', [PenaltyController::class, 'update'])->name('penalties.update');
    Route::delete('/penalties/{penalty}', [PenaltyController::class, 'destroy'])->name('penalties.destroy');

});

require __DIR__.'/auth.php';
