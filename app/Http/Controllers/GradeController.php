<?php

namespace App\Http\Controllers;

use App\Services\GradeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GradeController extends Controller
{
    protected $gradeService;

    public function __construct(GradeService $gradeService)
    {
        $this->gradeService = $gradeService;
    }

    /**
     * Devuelve todas las calificaciones.
     */
    public function getAllGrades()
    {
        $grades = $this->gradeService->getAllGrades();
        return response()->json($grades, Response::HTTP_OK);
    }

    /**
     * Devuelve una calificación por ID.
     */
    public function getGradeById(int $id)
    {
        $grade = $this->gradeService->getGradeById($id);

        if (!$grade) {
            return response()->json(['message' => 'Calificación no encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($grade, Response::HTTP_OK);
    }


    public function getGradeDetails(int $id)
    {
        $grade = $this->gradeService->getGradeWithRelations($id);

        if (!$grade) {
            return response()->json(['message' => 'Nota no encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($grade, Response::HTTP_OK);
    }

    public function getAllGradesWithRelations()
    {
        $grades = $this->gradeService->getAllGradesWithRelations();
        return response()->json($grades, Response::HTTP_OK);
    }

    /**
     * Crea una nueva calificación.
     */
    public function createGrade(Request $request)
    {
        $validated = $request->validate([
            'grade' => 'required|numeric|min:0|max:100',
            'type' => 'required|string|in:examen,trabajo,Examen,Trabajo',
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $grade = $this->gradeService->createGrade($validated);
        return response()->json($grade, Response::HTTP_CREATED);
    }

    /**
     * Actualiza una calificación existente.
     */
    public function updateGrade(Request $request, int $id)
    {
        $validated = $request->validate([
            'grade' => 'sometimes|numeric|min:0|max:100',
            'type' => 'sometimes|string|in:examen,trabajo,Examen,Trabajo',
            'name' => 'sometimes|string|max:40',
            'user_id' => 'sometimes|exists:users,id',
            'subject_id' => 'sometimes|exists:subjects,id',
        ]);

        $grade = $this->gradeService->updateGrade($id, $validated);

        if (!$grade) {
            return response()->json(['message' => 'Calificación no encontrada o no se pudo actualizar'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($grade, Response::HTTP_OK);
    }

    /**
     * Elimina una calificación por ID.
     */
    public function deleteGrade(int $id)
    {
        $deleted = $this->gradeService->deleteGrade($id);

        if (!$deleted) {
            return response()->json(['message' => 'Calificación no encontrada o no se pudo eliminar'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['message' => 'Calificación eliminada con éxito'], Response::HTTP_OK);
    }
}
