<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('isGuest')->group(function(){
    Route::get('/', [PageController::class, 'authPage'])->name('auth');
    Route::post('/login', [PageController::class, 'auth'])->name('login');
    Route::post('/register', [PageController::class, 'register'])->name('register');    
});

Route::middleware('isLogin', 'CekRole:admin,petugas,peminjam')->group(function(){
    Route::get('/dashboard-user', [PageController::class, 'dashboardUser'])->name('dashboarduser');
    Route::get('/book-detail/{id}', [BookController::class, 'detail'])->name('book.detail');
});

Route::middleware('isLogin', 'CekRole:admin,petugas')->group(function(){
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/book', [BookController::class, 'booklist'])->name('booklist');
    Route::get('/book/add', [BookController::class, 'add'])->name('addBook');
    Route::get('/book/edit{id}', [BookController::class, 'edit'])->name('editBook');
    Route::post('/book/create', [BookController::class, 'create'])->name('createBook');
    Route::put('/book/update/{id}', [BookController::class, 'update'])->name('updateBook');
    Route::delete('/book/delete{id}', [BookController::class, 'destroy'])->name('deleteBook');
    Route::post('/book-detail/{id}/rate', [BookController::class, 'rate'])->name('book.rate');
    Route::get('/books/export-pdf', [BookController::class, 'exportBooksPDF'])->name('books.export.pdf');
    Route::get('/book/category', [CategoryController::class, 'category'])->name('category');
    Route::post('/book-category/create', [CategoryController::class, 'create'])->name('createCategory');
    Route::put('/book-category/update/{id}', [CategoryController::class, 'edit'])->name('updateCategory');
    Route::delete('/book-category/delete{id}', [CategoryController::class, 'destroy'])->name('deleteCategory');
    Route::get('/category/export-pdf', [CategoryController::class, 'exportCategoriesPDF'])->name('categories.export.pdf');
});

Route::middleware('isLogin', 'CekRole:admin')->group(function(){
    Route::get('/user-list', [UserController::class, 'userlist'])->name('userlist');
    Route::get('/user/add', [UserController::class, 'addUser'])->name('add');
    Route::get('/user/edit{id}', [UserController::class, 'editUser'])->name('editUser');
    Route::post('/user/create', [UserController::class, 'create'])->name('createUser');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('updateUser');
    Route::delete('/user/delete{id}', [UserController::class, 'destroy'])->name('deleteUser');
    Route::get('/users/export-pdf', [UserController::class, 'exportUsersPDF'])->name('users.export.pdf');
    Route::get('/admin/borrowed', [BorrowController::class, 'borrowedAdmin'])->name('borrowedAdmin');
    Route::get('/borrows/export-pdf', [BorrowController::class, 'exportBorrowsPDF'])->name('borrows.export.pdf');
});

Route::middleware('isLogin', 'CekRole:peminjam')->group(function(){
    Route::get('/my-collection', [CollectionController::class, 'mycollection'])->name('mycollection');
    Route::post('/add-to-collection/{book}', [CollectionController::class, 'store'])->name('addToCollection');
    Route::post('/borrow/{book}', [BorrowController::class, 'borrowBook'])->name('borrow');
    Route::get('/user/borrowed', [BorrowController::class, 'borrowedUser'])->name('borrowedUser');
    Route::post('/return-book/{borrow}', [BorrowController::class, 'returnBook'])->name('return-book');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
    Route::delete('/uncollection/{id}', [CollectionController::class, 'uncollection'])->name('uncollection');
});


Route::get('/logout', [PageController::class, 'logout'])->name('logout');
Route::get('/error', [PageController::class, 'error'])->name('error');

