<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Board;
use App\Models\Classroom;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classrooms = Classroom::all();

        if ($classrooms->isEmpty()) {
            $this->command->warn('No hay aulas disponibles.');
            return;
        }

        foreach ($classrooms as $classroom) {
            Board::create([
                'classroom_id' => $classroom->id, 
            ]);
        }
    }
}
