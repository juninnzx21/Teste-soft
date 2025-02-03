<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTasksController;

Route::get('/', function () {
    return view('auth.login');
});

// Grupo de rotas autenticadas para gerenciamento de tarefas
Route::middleware('auth')->group(function () {
    // Rota para gerenciar tarefas
    Route::resource('tasks', UserTasksController::class);

    // Rota para criar nova categoria
    Route::post('category/store', [UserTasksController::class, 'storeCategory'])->name('category.store');
});

// Redirecionamento pós-login para a página de tarefas
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Remove ou modifica a rota para dashboard e redireciona para tasks
    Route::get('/dashboard', function () {
        return redirect()->route('tasks.index');
    })->name('dashboard');
});
