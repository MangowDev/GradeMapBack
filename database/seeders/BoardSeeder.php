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

        $targetClassroomId = 1;
        $targetClassroomId2 = 2;

        $fixedBoards = [3, 3, 3, 3, 2, 3, 3, 2, 1];
        foreach ($fixedBoards as $size) {
            Board::create([
                'classroom_id' => $targetClassroomId,
                'size' => $size,
            ]);
        }

        $fixedBoards = [3, 3, 3, 3, 2, 3, 3, 2, 1];
        foreach ($fixedBoards as $size) {
            Board::create([
                'classroom_id' => $targetClassroomId2,
                'size' => $size,
            ]);
        }

        $otherClassrooms = $classrooms->where('id', '!=', $targetClassroomId);
        foreach ($otherClassrooms as $classroom) {
            Board::create([
                'classroom_id' => $classroom->id,
                'size' => rand(1, 5),
            ]);
        }
    }
}
