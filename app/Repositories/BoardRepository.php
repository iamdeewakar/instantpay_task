<?php

namespace App\Repositories;
use App\Interfaces\BoardRepositoryInterface;
use App\Models\Board;
use App\Models\User;

class BoardRepository implements BoardRepositoryInterface
{

    public function createBoard(array $data)
    {
        return Board::create($data);
    }

    public function getAllBoards()
    {
        return Board::all();
    }

    public function getBoardById($id)
    {
        return Board::findOrFail($id);
    }

    public function updateBoard($id, array $data)
    {
        $board = Board::findOrFail($id);
        $board->update($data);
        return $board;
    }

    public function deleteBoard($id)
    {
        return Board::destroy($id);
    }


}
