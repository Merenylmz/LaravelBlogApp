<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('/categories')->group(function () {
    Route::get("/", [CategoryController::class, "getAllCategories"]);
    Route::get("/{id}", [CategoryController::class, "getByIdCategory"]);
    Route::post("/", [CategoryController::class,"addCategory"]);
    Route::delete("/{id}", [CategoryController::class, "deleteCategory"]);
    Route::post("/edit/{id}", [CategoryController::class, "editCategory"]);
});

Route::prefix("/blogs")->group(function () {
    Route::get("/", [BlogController::class, "getAllBlogs"]);
    Route::get("/{id}", [BlogController::class, "getByIdBlog"]);
    Route::post("/", [BlogController::class, "addBlog"])->middleware("isValidToken");
    Route::post("/edit/{id}", [BlogController::class, "editBlog"])->middleware("isValidToken");
    Route::delete("/{id}", [BlogController::class, "deleteBlog"])->middleware("isValidToken");
});

Route::prefix('/auth')->group(function () {
    Route::post("/register", [AuthController::class, "register"]);
    Route::post("/login", [AuthController::class, "login"]);
});