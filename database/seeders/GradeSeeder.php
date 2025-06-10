<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::with('subjects')->get();

        if ($users->isEmpty()) {
            $this->command->warn('No hay usuarios disponibles. Asegúrate de crear usuarios en los seeders correspondientes.');
            return;
        }

        foreach ($users as $user) {
            $userSubjects = $user->subjects;

            if ($userSubjects->isEmpty()) {
                $this->command->warn("El usuario {$user->id} no tiene asignaturas asignadas.");
                continue;
            }

            foreach ($userSubjects as $subject) {
                Grade::create([
                    'grade' => (float) number_format(rand(10, 100) + rand(0, 99) / 100, 2, '.', ''),
                    'type' => rand(0, 1) ? 'Examen' : 'Trabajo',
                    'name' => 'Nota de ' . $subject->name,
                    'user_id' => $user->id,
                    'subject_id' => $subject->id,
                ]);
            }
        }
    }
}
