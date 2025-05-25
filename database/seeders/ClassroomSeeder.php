<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classroom;
use App\Models\User;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = User::where('role', 'teacher')->get();

        if ($teachers->isEmpty()) {
            $this->command->warn('No hay usuarios con rol teacher.');
            return;
        }

        $classrooms = [
            '1º SMR',
            '2º SMR',
            '1º DAW',
            '2º DAW',
            '1º DAM',
            '2º DAM',
            '1º ASIR', 
            '2º ASIR',
        ];

        foreach ($classrooms as $name) {
            Classroom::create([
                'name' => $name,
                'teacher_id' => $teachers->random()->id,
            ]);
        }
    }
}
