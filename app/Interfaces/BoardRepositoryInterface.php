<?php

namespace App\Interfaces;

interface BoardRepositoryInterface
{
    //
    public function createBoard(array $data);
    public function getAllBoards();
    public function getBoardById($id);
    public function updateBoard($id, array $data);
    public function deleteBoard($id);
}
