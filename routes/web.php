<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate(10)
    ]);
})-> name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit' , function (Task $task)  {
    return view('edit', [
        'task' => $task
        ]);
})->name('task.edit');

Route::get('/tasks/{task}' , function (Task $task)  {
    return view('show', [
        'task' => $task
        ]);
})->name('task.show');

Route::post('/tasks', function (TaskRequest $request) {

    $task = Task::create($request->validated());

    return redirect()->route('task.show' , ['task' => $task->id])
    ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {

    $task->update($request->validated());

    return redirect()->route('task.show' , ['task' => $task->id])
    ->with('success', 'Task updated successfully!');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
       ->with ('success', 'Task deleted successfully!');
})->name('tasks.destroy');

// Route::get('/xxx', function () {
//     return 'Hello';
// })->name('hello');

// Route::get('/hallo', function () {
//     return redirect()->route('hello');
// });

// Route::get('/greet/{name}', function ($name) {
//    return 'Hello ' . $name . '!';
// });

 Route::fallback(function () {
    return 'Still got somewhere!';
});


// GET
// POST
// PUT
// DELETE
