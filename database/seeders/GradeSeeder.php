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
            $userSubjects = $subjects->random(rand(3, 6));
            foreach ($userSubjects as $subject) {
                Grade::create([
                    'grade' => round(rand(0, 100) + rand(0, 99) / 100, 2),
                    'type' => rand(0, 1) ? 'Examen' : 'Trabajo',
                    'name' => 'Nota de ' . $subject->name,
                    'user_id' => $user->id,
                    'subject_id' => $subject->id,
                ]);
            }
        }
    }
}
