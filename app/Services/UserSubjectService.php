<?php

namespace App\Services;

use App\Models\User;
use App\Models\Subject;

class UserSubjectService
{
    public function attachSubjectToUser($userId, $subjectId)
    {
        $user = User::findOrFail($userId);
        $user->subjects()->attach($subjectId);
        return $user->subjects;
    }

    public function detachSubjectFromUser($userId, $subjectId)
    {
        $user = User::findOrFail($userId);
        $user->subjects()->detach($subjectId);
        return $user->subjects;
    }

    public function syncSubjectsForUser($userId, array $subjectIds)
    {
        $user = User::findOrFail($userId);
        $user->subjects()->sync($subjectIds);
        return $user->subjects;
    }

    public function getSubjectsForUser($userId)
    {
        return User::findOrFail($userId)->subjects;
    }

    public function getUsersForSubject($subjectId)
    {
        return Subject::findOrFail($subjectId)->users;
    }
}
