<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('home');

/**
 * Since we weren't asked to really do anything in-between registerations/logins,
 * I decided not to re-invent the wheel but use Laravel's robust already shipped authentication
 * and authorization feature. 
 */
Auth::routes();

Route::controller(TaskController::class)
->prefix('tasks')
->middleware('auth:web')
->group(function () {
    Route::get('create', 'showCreateTaskForm')->name('tasks.create');
    Route::post('create', 'submitCreateTaskForm');
    Route::get('all', 'showAllTasks')->name('tasks.index');
    Route::get('{id}', 'showSingleTask')->name('tasks.single');
    Route::get('{id}/edit', 'showEditTaskForm')->name('tasks.edit');
    Route::put('{id}/edit', 'updateTask');
    Route::get('{id}/complete', 'completeTask')->name('tasks.complete');
    Route::get('{id}/uncomplete', 'uncompleteTask')->name('tasks.uncomplete');
    Route::delete('{id}', 'deleteTask')->name('tasks.delete');
});
