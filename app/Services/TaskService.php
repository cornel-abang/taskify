<?php

namespace App\Services;

use App\Models\Task;
use App\Enums\TaskStatusEnum;

class TaskService
{
    public function create(array $details): void
    {
        Task::create(
            array_merge(
                ['user_id' => auth()->user()->id], 
                $details 
            )
        );
    }

    public function fetchAll(?string $status): array
    {
        $tasks = Task::paginate(5);

        /**
         * I'm passing the status here to make sure we're querying the
         * db with the right value.
         * This prevents any database/sql injection attacks that
         * might be passed to the global 'request()'.
         * 
         * So everything defaults to 'all'
         */
        $selectedStatus = in_array($status, array_column(TaskStatusEnum::cases(), 'value'))
                        ? $status
                        : 'all';

        /**
         * Filter tasks based on status selected
         */
        if ($selectedStatus !== 'all') {
            $tasks = Task::where('status', $selectedStatus)->paginate(5);
        }

        return array($tasks, $selectedStatus);
    }

    public function fetchSingle(int $id): ?Task
    {
        return Task::find($id);
    }

    public function update(int $id, array $details): bool
    {
        $task = $this->fetchSingle($id);

        if (is_null($task)) {
            return false;
        }

        return $task->update($details);
    }

    public function complete(int $id): bool
    {
        $task = $this->fetchSingle($id);

        if (is_null($task)) {
            return false;
        }

        return $task->markAsCompleted();
    }

    public function uncomplete(int $id): bool
    {
        $task = $this->fetchSingle($id);

        if (is_null($task)) {
            return false;
        }

        return $task->markAsPending();
    }

    public function delete(int $id): bool
    {
        $task = $this->fetchSingle($id);

        if (is_null($task)) {
            return false;
        }

        return $task->delete();
    }
}