<?php

namespace App\Interfaces;

interface TaskRepositoryInterface
{
    //
    public function createTask(array $data);
    public function getAllTasks();
    public function getTaskById($id);
    public function updateTask($id, array $data);
    public function deleteTask($id);
}
