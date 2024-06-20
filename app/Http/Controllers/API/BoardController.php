<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Interfaces\BoardRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class BoardController
{
    //

    private $boardRepository;

    public function __construct(BoardRepositoryInterface $boardRepository)
    {
        $this->boardRepository = $boardRepository;
    }

    public function index()
    {
        try{
            $message = "Boards retrieved successfully";
        return ApiResponse::success($this->boardRepository->getAllBoards(), $message);
        }catch(Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        }

    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'user_id' => 'required'
            ]);

            //using repository pattern here
            $board = $this->boardRepository->createBoard($data);
            $message = "Board created successfully";
            return ApiResponse::success($board, $message, 201);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try{
            $message ="Board retrieved successfully";
            return ApiResponse::success($this->boardRepository->getBoardById($id),$message);
        }catch(Exception $e){
            return ApiResponse::error($e->getMessage(), 500);
        }

    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'name' => 'sometimes|string|max:255',
            ]);

            $board = $this->boardRepository->updateBoard($id, $data);
            $message = "Board updated successfully";
            return ApiResponse::success($board, $message);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->boardRepository->deleteBoard($id);
            $message = "Board deleted successfully";
            return ApiResponse::success(null, $message, 204);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
}
