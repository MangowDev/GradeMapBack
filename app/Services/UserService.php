<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Devuelve todos los usuarios.
     */
    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * Crea un nuevo usuario.
     */
    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    /**
     * Devuelve un usuario con id especifico.
     */
    public function getUserById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Devuelve todos los usuarios con un rol específico.
     */
    public function getUsersByRole(string $role)
    {
        return User::where('role', $role)->get();
    }

    public function getUsersByCreationDate()
    {
        return User::orderBy('created_at', 'desc')->get();
    }

    public function getUserWithClassroom(int $id): ?array
    {
        $user = User::with('computer.board.classroom')->find($id);

        if (!$user || !$user->computer || !$user->computer->board || !$user->computer->board->classroom) {
            return null;
        }

        return [
            'classroom' => $user->computer->board->classroom,
        ];
    }


    public function getUserGrades(int $userId)
    {
        $user = User::with('grades.subject')->find($userId);

        if (!$user) {
            return null;
        }

        return $user->grades;
    }



    /**
     * Actualiza los datos de un usuario.
     */
    public function updateUser(int $id, array $data): ?User
    {
        $user = User::find($id);
        if (!$user) return null;

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        return $user;
    }

    /**
     * Elimina un usuario por su ID.
     */
    public function deleteUser(int $id): bool
    {
        return User::destroy($id) > 0;
    }
}
