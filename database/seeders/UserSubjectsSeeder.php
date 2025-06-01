<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSubjectsSeeder extends Seeder
{
    public function run()
    {
        $userIds = DB::table('users')->pluck('id')->toArray();
        $subjectIds = DB::table('subjects')->pluck('id')->toArray();

        foreach ($userIds as $userId) {
            $assignCount = rand(1, 3);

            $assignedSubjects = (array)array_rand(array_flip($subjectIds), $assignCount);

            foreach ($assignedSubjects as $subjectId) {
                DB::table('user_subjects')->insert([
                    'user_id' => $userId,
                    'subject_id' => $subjectId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
