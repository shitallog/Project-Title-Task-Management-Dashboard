<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin'])->name('admin.dashboard');

require __DIR__.'/adminauth.php';

Route::middleware('auth')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index'); // List tasks
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create'); // Show add form
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store'); // Handle create form
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show'); // Show task details
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit'); // Show edit form
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update'); // Handle edit form
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy'); // Delete task
});
