<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function createTask(array $data)
    {
        return Task::create($data);
    }

    public function getAllTasks()
    {
        return Task::all();
    }

    public function getTaskById($id)
    {
        return Task::findOrFail($id);
    }

    public function updateTask($id, array $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function deleteTask($id)
    {
        return Task::destroy($id);
    }
}
