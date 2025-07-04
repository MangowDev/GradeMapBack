<?php

namespace App\Services;

use App\Models\Board;

class BoardService
{
    public function getAllBoards()
    {
        return Board::all();
    }

    public function getBoardById(int $id): ?Board
    {
        return Board::find($id);
    }

    public function getAllBoardsWithRelations()
    {
        return Board::with(['classroom', 'computers'])->get();
    }

    public function getBoardWithRelations(int $id): ?Board
    {
        return Board::with(['classroom', 'computers'])->find($id);
    }

    public function getBoardsWithRelationsByIds(array $ids)
    {
        return Board::with(['classroom', 'computers'])->whereIn('id', $ids)->get();
    }


    public function createBoard(array $data): Board
    {
        return Board::create($data);
    }

    public function updateBoard(int $id, array $data): ?Board
    {
        $board = Board::find($id);
        if (!$board) return null;

        $board->update($data);
        return $board;
    }

    public function deleteBoard(int $id): bool
    {
        $board = Board::find($id);
        if (!$board) return false;

        return $board->delete();
    }
}
