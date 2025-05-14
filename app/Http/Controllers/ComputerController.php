<?php

namespace App\Http\Controllers;

use App\Services\ComputerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ComputerController extends Controller
{
    protected $computerService;

    public function __construct(ComputerService $computerService)
    {
        $this->computerService = $computerService;
    }

    /**
     * Devuelve todos los ordenadores.
     */
    public function getAllComputers()
    {
        $computers = $this->computerService->getAllComputers();
        return response()->json($computers, Response::HTTP_OK);
    }

    /**
     * Crea un nuevo ordenador.
     */
    public function createComputer(Request $request)
    {
        $validated = $request->validate([
            'board_id' => 'nullable|exists:boards,id',
        ]);

        $computer = $this->computerService->createComputer($validated);

        return response()->json($computer, Response::HTTP_CREATED);
    }

    /**
     * Devuelve un ordenador con ID específico.
     */
    public function getComputerById(int $id)
    {
        $computer = $this->computerService->getComputerById($id);

        if (!$computer) {
            return response()->json(['message' => 'Ordenador no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($computer, Response::HTTP_OK);
    }

    /**
     * Devuelve un ordenador y sus relaciones con ID específico.
     */
    public function getComputerDetails(int $id)
    {
        $computer = $this->computerService->getComputerWithRelations($id);

        if (!$computer) {
            return response()->json(['message' => 'Ordenador no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($computer, Response::HTTP_OK);
    }

    public function getAllComputersWithRelations()
    {
        $computers = $this->computerService->getAllComputersWithRelations();
        return response()->json($computers, Response::HTTP_OK);
    }



    /**
     * Actualiza los datos de un ordenador.
     */
    public function updateComputer(Request $request, int $id)
    {
        $validated = $request->validate([
            'board_id' => 'sometimes|nullable|exists:boards,id',
        ]);

        $computer = $this->computerService->updateComputer($id, $validated);

        if (!$computer) {
            return response()->json(['message' => 'Ordenador no encontrado o no se pudo actualizar'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($computer, Response::HTTP_OK);
    }

    /**
     * Elimina un ordenador por su ID.
     */
    public function deleteComputer(int $id)
    {
        $deleted = $this->computerService->deleteComputer($id);

        if (!$deleted) {
            return response()->json(['message' => 'Ordenador no encontrado o no se pudo eliminar'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['message' => 'Ordenador eliminado con éxito'], Response::HTTP_OK);
    }
}
