<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserSubjectService;

class UserSubjectController extends Controller
{
    protected $service;

    public function __construct(UserSubjectService $service)
    {
        $this->service = $service;
    }

    public function attach(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $subjects = $this->service->attachSubjectToUser($request->user_id, $request->subject_id);

        return response()->json($subjects);
    }

    public function detach(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $subjects = $this->service->detachSubjectFromUser($request->user_id, $request->subject_id);

        return response()->json($subjects);
    }

    public function sync(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        $subjects = $this->service->syncSubjectsForUser($request->user_id, $request->subject_ids);

        return response()->json($subjects);
    }

    public function userSubjects($userId)
    {
        return response()->json($this->service->getSubjectsForUser($userId));
    }

    public function subjectUsers($subjectId)
    {
        return response()->json($this->service->getUsersForSubject($subjectId));
    }
}
