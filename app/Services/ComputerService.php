<?php

namespace App\Services;

use App\Models\Computer;

class ComputerService
{
    public function getAllComputers()
    {
        return Computer::all();
    }

    public function getComputerById(int $id): ?Computer
    {
        return Computer::find($id);
    }

    public function getComputerWithRelations(int $id): ?Computer
    {
        return Computer::with(['board.classroom', 'user'])->find($id);
    }

    public function getAllComputersWithRelations()
    {
        return Computer::with(['board.classroom', 'user'])->get();
    }

    public function createComputer(array $data): Computer
    {
        $userId = $data['user_id'] ?? null;
        unset($data['user_id']);

        $computer = Computer::create($data);

        if ($userId) {
            $user = \App\Models\User::findOrFail($userId);
            $user->computer_id = $computer->id;
            $user->save();
        }

        return $computer;
    }


    public function updateComputer(int $id, array $data): ?Computer
    {
        $computer = Computer::find($id);
        if (!$computer) return null;

        $computer->update($data);
        return $computer;
    }

    public function deleteComputer(int $id): bool
    {
        $computer = Computer::find($id);
        if (!$computer) return false;

        return $computer->delete();
    }
}
