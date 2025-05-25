<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $userService;

    // Inyectamos el servicio de usuarios
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Devuelve todos los usuarios.
     */
    public function getAllUsers()
    {
        $users = $this->userService->getAllUsers();
        return response()->json($users, Response::HTTP_OK);
    }

    /**
     * Crea un nuevo usuario.
     */
    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:30|unique:users',
            'password' => 'required|string|min:6',
            'email' => 'required|string|email|max:50|unique:users',
            'dni' => 'required|string|max:9|unique:users',
            'name' => 'required|string|max:20',
            'surnames' => 'required|string|max:30',
            'role' => 'sometimes|string',
            'computer_id' => 'nullable|numeric'
        ]);

        $user = $this->userService->createUser($validated);

        return response()->json($user, Response::HTTP_CREATED);
    }

    /**
     * Devuelve un usuario con ID específico.
     */
    public function getUserById(int $id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * Devuelve todos los usuarios con un rol específico.
     */
    public function getUsersByRole(string $role)
    {
        $users = $this->userService->getUsersByRole($role);
        return response()->json($users, Response::HTTP_OK);
    }

    public function getUsersByCreationDate()
    {
        $users = $this->userService->getUsersByCreationDate();
        return response()->json($users, Response::HTTP_OK);
    }

    public function getUserClassroom(int $id)
    {
        $data = $this->userService->getUserWithClassroom($id);

        if (!$data) {
            return response()->json(['message' => 'Usuario o clase no encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($data, Response::HTTP_OK);
    }

    public function getUserGrades(int $id)
    {
        $grades = $this->userService->getUserGrades($id);

        if ($grades === null) {
            return response()->json(['message' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($grades, Response::HTTP_OK);
    }



    /**
     * Actualiza los datos de un usuario.
     */
    public function updateUser(Request $request, int $id)
    {
        $validated = $request->validate([
            'username' => 'sometimes|string|max:30|unique:users',
            'password' => 'sometimes|string|min:6',
            'email' => 'sometimes|string|email|max:50|unique:users',
            'dni' => 'sometimes|string|max:9|unique:users',
            'name' => 'sometimes|string|max:20',
            'surnames' => 'sometimes|string|max:30',
            'role' => 'sometimes|string',
            'computer_id' => 'sometimes|numeric'
        ]);

        $user = $this->userService->updateUser($id, $validated);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado o no se pudo actualizar'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * Elimina un usuario por su ID.
     */
    public function deleteUser(int $id)
    {
        $deleted = $this->userService->deleteUser($id);

        if (!$deleted) {
            return response()->json(['message' => 'Usuario no encontrado o no se pudo eliminar'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['message' => 'Usuario eliminado con éxito'], Response::HTTP_OK);
    }
}
