<?php

namespace App\Services;

use App\Models\Grade;

class GradeService
{
    public function getAllGrades()
    {
        return Grade::all();
    }

    public function getGradeById(int $id): ?Grade
    {
        return Grade::find($id);
    }

    public function getGradeWithRelations(int $id): ?Grade
    {
        return Grade::with(['user', 'subject'])->find($id);
    }

    public function getAllGradesWithRelations()
    {
        return Grade::with(['user', 'subject'])->get();
    }

    public function createGrade(array $data): Grade
    {
        return Grade::create($data);
    }

    public function updateGrade(int $id, array $data): ?Grade
    {
        $grade = Grade::find($id);
        if (!$grade) return null;

        $grade->update($data);
        return $grade;
    }

    public function deleteGrade(int $id): bool
    {
        $grade = Grade::find($id);
        if (!$grade) return false;

        return $grade->delete();
    }
}
