<?php

namespace App\Http\Controllers;

use App\Services\ClassroomService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassroomController extends Controller
{
    protected $classroomService;

    /**
     * Inyección del servicio de aulas.
     */
    public function __construct(ClassroomService $classroomService)
    {
        $this->classroomService = $classroomService;
    }

    /**
     * Devuelve todas las aulas.
     */
    public function getAllClassrooms()
    {
        $classrooms = $this->classroomService->getAllClassrooms();
        return response()->json($classrooms, Response::HTTP_OK);
    }

    /**
     * Devuelve un aula con ID específico.
     */
    public function getClassroomById(int $id)
    {
        $classroom = $this->classroomService->getClassroomById($id);
        if (!$classroom) {
            return response()->json(['message' => 'Aula no encontrada'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($classroom, Response::HTTP_OK);
    }

    /**
     * Crea un nuevo aula.
     */
    public function createClassroom(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'nullable|exists:users,id',
        ]);

        $classroom = $this->classroomService->createClassroom($validated);
        return response()->json($classroom, Response::HTTP_CREATED);
    }

    /**
     * Actualiza los datos de un aula.
     */
    public function updateClassroom(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'teacher_id' => 'sometimes|nullable|exists:users,id',
        ]);

        $classroom = $this->classroomService->updateClassroom($id, $validated);
        if (!$classroom) {
            return response()->json(['message' => 'Aula no encontrada o no se pudo actualizar'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($classroom, Response::HTTP_OK);
    }

    /**
     * Elimina un aula por su ID.
     */
    public function deleteClassroom(int $id)
    {
        $deleted = $this->classroomService->deleteClassroom($id);
        if (!$deleted) {
            return response()->json(['message' => 'Aula no encontrada o no se pudo eliminar'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['message' => 'Aula eliminada con éxito'], Response::HTTP_OK);
    }
}
