<?php

namespace App\Services;

use App\Models\Subject;

class SubjectService
{
    public function getAllSubjects()
    {
        return Subject::with('teacher')->get();
    }

    public function getSubjectById(int $id): ?Subject
    {
        return Subject::with('teacher')->find($id);
    }

    public function getUsersBySubjectId(int $subjectId)
    {
        $subject = Subject::with(['users.classroom'])->find($subjectId);

        if (!$subject) {
            return null;
        }

        return $subject->users;
    }
    public function createSubject(array $data): Subject
    {
        return Subject::create($data);
    }

    public function updateSubject(int $id, array $data): ?Subject
    {
        $subject = Subject::find($id);
        if (!$subject) return null;

        $subject->update($data);
        return $subject;
    }

    public function deleteSubject(int $id): bool
    {
        $subject = Subject::find($id);
        if (!$subject) return false;

        return $subject->delete();
    }
}
