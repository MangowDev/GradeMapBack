<?php

namespace App\Http\Controllers;

use App\Services\SubjectService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    protected $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    /**
     * Devuelve todos los subjects.
     */
    public function getAllSubjects()
    {
        $subjects = $this->subjectService->getAllSubjects();
        return response()->json($subjects, Response::HTTP_OK);
    }

    /**
     * Crea un nuevo subject.
     */
    public function createSubject(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:40',
        ]);

        $subject = $this->subjectService->createSubject($validated);

        return response()->json($subject, Response::HTTP_CREATED);
    }

    /**
     * Devuelve un subject con ID específico.
     */
    public function getSubjectById(int $id)
    {
        $subject = $this->subjectService->getSubjectById($id);

        if (!$subject) {
            return response()->json(['message' => 'Asignatura no encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($subject, Response::HTTP_OK);
    }

    /**
     * Actualiza los datos de un subject.
     */
    public function updateSubject(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
        ]);

        $subject = $this->subjectService->updateSubject($id, $validated);

        if (!$subject) {
            return response()->json(['message' => 'Asignatura no encontrada o no se pudo actualizar'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($subject, Response::HTTP_OK);
    }

    /**
     * Elimina un subject por su ID.
     */
    public function deleteSubject(int $id)
    {
        $deleted = $this->subjectService->deleteSubject($id);

        if (!$deleted) {
            return response()->json(['message' => 'Asignatura no encontrada o no se pudo eliminar'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['message' => 'Asignatura eliminada con éxito'], Response::HTTP_OK);
    }
}
