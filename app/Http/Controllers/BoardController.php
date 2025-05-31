<?php

namespace App\Http\Controllers;

use App\Services\BoardService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BoardController extends Controller
{
    protected $boardService;

    /**
     * Inyecta el servicio de Board.
     */
    public function __construct(BoardService $boardService)
    {
        $this->boardService = $boardService;
    }

    /**
     * Devuelve todos los boards.
     */
    public function getAllBoards()
    {
        $boards = $this->boardService->getAllBoards();
        return response()->json($boards, Response::HTTP_OK);
    }

    /**
     * Devuelve un board con ID específico.
     */
    public function getBoardById(int $id)
    {
        $board = $this->boardService->getBoardById($id);
        if (!$board) {
            return response()->json(['message' => 'Mesa no encontrada'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($board, Response::HTTP_OK);
    }

    public function getBoardsBatchDetails(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:boards,id',
        ]);

        $boards = $this->boardService->getBoardsWithRelationsByIds($validated['ids']);

        return response()->json($boards, Response::HTTP_OK);
    }


    /**
     * Crea una nueva board.
     */
    public function createBoard(Request $request)
    {
        $validated = $request->validate([
            'classroom_id' => 'nullable|exists:classrooms,id',
            'size' => 'integer|between:1,5',
        ]);

        $board = $this->boardService->createBoard($validated);
        return response()->json($board, Response::HTTP_CREATED);
    }

    /**
     * Actualiza los datos de un board.
     */
    public function updateBoard(Request $request, int $id)
    {
        $validated = $request->validate([
            'classroom_id' => 'sometimes|nullable|exists:classrooms,id',
            'size' => 'sometimes|integer|between:1,5',
        ]);

        $board = $this->boardService->updateBoard($id, $validated);
        if (!$board) {
            return response()->json(['message' => 'Mesa no encontrada o no se pudo actualizar'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($board, Response::HTTP_OK);
    }

    /**
     * Elimina un board por su ID.
     */
    public function deleteBoard(int $id)
    {
        $deleted = $this->boardService->deleteBoard($id);
        if (!$deleted) {
            return response()->json(['message' => 'Mesa no encontrada o no se pudo eliminar'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['message' => 'Mesa eliminada con éxito'], Response::HTTP_OK);
    }



    public function getBoardDetails(int $id)
    {
        $board = $this->boardService->getBoardWithRelations($id);

        if (!$board) {
            return response()->json(['message' => 'Mesa no encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($board, Response::HTTP_OK);
    }

    public function getAllBoardsWithRelations()
    {
        $boards = $this->boardService->getAllBoardsWithRelations();
        return response()->json($boards, Response::HTTP_OK);
    }
}
