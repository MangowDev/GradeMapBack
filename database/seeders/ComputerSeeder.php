<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Computer;
use App\Models\Board;

class ComputerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boards = Board::all();

        if ($boards->isEmpty()) {
            $this->command->warn('No hay mesas disponibles.');
            return;
        }

        foreach ($boards as $board) {
            $maxSize = $board->size ?? 0;

            if ($maxSize <= 0) {
                $this->command->warn("La mesa con ID {$board->id} tiene tamaño 0 o indefinido.");
                continue;
            }

            $computersCount = rand(1, $maxSize);

            for ($i = 0; $i < $computersCount; $i++) {
                $assignBoard = rand(1, 100) > 30;
                
                Computer::create([
                    'board_id' => $assignBoard ? $board->id : null,
                ]);
            }
        }

        $extraComputers = 5;
        for ($i = 0; $i < $extraComputers; $i++) {
            Computer::create([
                'board_id' => null,
            ]);
        }
    }
}
