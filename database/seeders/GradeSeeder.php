<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Subject;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $subjects = Subject::all();

        if ($users->isEmpty() || $subjects->isEmpty()) {
            $this->command->warn('No hay usuarios o materias disponibles. Asegúrate de crear ambos en los seeders correspondientes.');
            return;
        }

        foreach ($users as $user) {
            foreach ($subjects as $subject) {
                $gradeRandom = rand(0, 1);
                $gradeType = $gradeRandom === 0 ? "Examen" : "Trabajo";

                Grade::create([
                    'grade' => round(rand(0, 100) + rand(0, 99) / 100, 2),
                    'type' => $gradeType,
                    'name' => $gradeType . ' de ' . $subject->name,
                    'user_id' => $user->id,
                    'subject_id' => $subject->id,
                ]);
            }
        }
    }
}
