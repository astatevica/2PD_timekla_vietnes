<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PerformerController;
use App\Http\Controllers\CategoriesController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;

Route::get('/', [HomeController::class, 'index']);


// Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

//Authors
Route::get('/authors', [AuthorController::class, 'list']);
Route::get('/authors/create', [AuthorController::class, 'create']);
Route::post('/authors/put', [AuthorController::class, 'put']);
Route::get('/authors/update/{author}', [AuthorController::class, 'update']);
Route::post('/authors/patch/{author}', [AuthorController::class, 'patch']);
Route::post('/authors/delete/{author}',[AuthorController::class, 'delete']);

//Books
Route::get('/books', [BookController::class, 'list']);
Route::get('/books/create', [BookController::class, 'create']);
Route::post('/books/put', [BookController::class, 'put']);
Route::get('/books/update/{book}', [BookController::class, 'update']);
Route::post('/books/patch/{book}', [BookController::class, 'patch']);
Route::post('/books/delete/{book}',[BookController::class, 'delete']);

//Categories
Route::get('/categories', [CategoriesController::class, 'list']);
Route::get('/categories/create', [CategoriesController::class, 'create']);
Route::post('/categories/put', [CategoriesController::class, 'put']);
Route::get('/categories/update/{categorie}', [CategoriesController::class, 'update']);
Route::post('/categories/patch/{categorie}', [CategoriesController::class, 'patch']);
Route::post('/categories/delete/{categorie}',[CategoriesController::class, 'delete']);

//Performers
Route::get('/performers', [PerformerController::class, 'list']);
Route::get('/performers/create', [PerformerController::class, 'create']);
Route::post('/performers/put', [PerformerController::class, 'put']);
Route::get('/performers/update/{performer}', [PerformerController::class, 'update']);
Route::post('/performers/patch/{performer}', [PerformerController::class, 'patch']);
Route::post('/performers/delete/{performer}',[PerformerController::class, 'delete']);