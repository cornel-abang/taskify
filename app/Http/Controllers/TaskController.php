<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService)
    {
    }

    public function showCreateTaskForm(): View
    {
        return view('task.create');
    }

    public function submitCreateTaskForm(CreateTaskRequest $request): RedirectResponse
    {
        $this->taskService->create($request->validated());

        return $this->successfulRedirectToIndex('Task succesfully created');
    }

    public function showAllTasks(): View
    {
        /**
         * I'm using the global 'request()' variable because:
         * 1. We won't always get the status parameter (Until tasks are filtered)
         * 2: But we can always have the 'request()' (since it's global), for whenever
         * we get the status param passed.
         */
        $status = request('status');

        list($tasks, $selectedStatus) = $this->taskService->fetchAll($status);

        return view('task.index', compact('tasks', 'selectedStatus'));
    }

    public function showSingleTask(int $id)
    {
        $task = $this->taskService->fetchSingle($id);

        if (is_null($task)) {
            return $this->errorRedirectBack('Task not found');
        }

        return view('task.single', compact('task'));
    }

    public function showEditTaskForm(int $id): RedirectResponse | View
    {
        $task = $this->taskService->fetchSingle($id);

        if (is_null($task)) {
            return $this->errorRedirectBack('Task not found');
        }

        return view('task.edit', compact('task'));
    }

    public function updateTask(int $id, UpdateTaskRequest $request): RedirectResponse
    {
        $updated = $this->taskService->update($id, $request->validated());

        if (! $updated) {
            return $this->errorRedirectBack('Unable to update task');
        }

        return $this->successfulRedirectToIndex('Task successfully updated');
    }

    public function completeTask(int $id)
    {
        $completed = $this->taskService->complete($id);

        if (! $completed) {
            return $this->errorRedirectBack('Task could not be completed');
        }

        return $this->successfulRedirectToIndex('Task successfully completed');
    }

    public function uncompleteTask(int $id)
    {
        $uncompleted = $this->taskService->uncomplete($id);

        if (! $uncompleted) {
            return $this->errorRedirectBack('Task could not be marked as pending');
        }

        return $this->successfulRedirectToIndex('Task successfully marked as pending');
    }

    public function deleteTask(int $id)
    {
        $deleted = $this->taskService->delete($id);

        if (! $deleted) {
            return $this->errorRedirectBack('Task could not be deleted');
        }

        return $this->successfulRedirectToIndex('Task successfully deleted');
    }

    private function successfulRedirectToIndex(string $message): RedirectResponse
    {
        return redirect()->route('tasks.index')
            ->with('success', $message);
    }

    private function errorRedirectBack(string $message): RedirectResponse
    {
        return redirect()->back()->with('error', $message);
    }
}
