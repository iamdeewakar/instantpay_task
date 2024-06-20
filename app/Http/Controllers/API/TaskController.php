<?php

namespace App\Http\Controllers\API;


use App\Helpers\ApiResponse;
use App\Interfaces\TaskRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class TaskController
{

    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index()
    {
        try{
            $message = "Tasks retrieved successfully";
            return ApiResponse::success($this->taskRepository->getAllTasks(), $message);
        }catch(Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'string',
                'status' => 'string',
                'board_id' => 'required|exists:boards,id',
            ]);

            $task = $this->taskRepository->createTask($data);
            $message = "Task created successfully";
            return ApiResponse::success($task, $message, 201);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try{
            $message = "Task retrieved successfully";
            return ApiResponse::success($this->taskRepository->getTaskById($id), $message);
        }catch(Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        }

    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'title' => 'string|max:255',
                'description' => 'string',
                'completed' => 'string',
            ]);

            $task = $this->taskRepository->updateTask($id, $data);
            $message = "Task updated successfully";
            return ApiResponse::success($task, $message);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->taskRepository->deleteTask($id);
            $message = "Task deleted successfully";
            return ApiResponse::success(null, $message, 204);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
}
