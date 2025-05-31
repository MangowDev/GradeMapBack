<?php

namespace App\Services;

use App\Models\Classroom;
use App\Models\Board;

class ClassroomService
{
    public function getAllClassrooms()
    {
        return Classroom::all();
    }

    public function getAllClassroomsWithRelations()
    {
        return Classroom::with('teacher')->get();
    }

    public function getClassroomWithRelations(int $id): ?Classroom
    {
        return Classroom::with(['boards', 'teacher'])->find($id);
    }

    public function getClassroomById(int $id): ?Classroom
    {
        return Classroom::find($id);
    }


    public function createClassroom(array $data): Classroom
    {
        return Classroom::create($data);
    }

    public function updateClassroom(int $id, array $data): ?Classroom
    {
        $classroom = Classroom::find($id);
        if (!$classroom) return null;

        $classroom->update($data);
        return $classroom;
    }

    public function deleteClassroom(int $id): bool
    {
        $classroom = Classroom::find($id);
        if (!$classroom) return false;

        return $classroom->delete();
    }
}
