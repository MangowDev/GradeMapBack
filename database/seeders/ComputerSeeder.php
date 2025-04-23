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
            $computersCount = rand(1, 3);

            for ($i = 0; $i < $computersCount; $i++) {
                Computer::create([
                    'board_id' => $board->id, 
                ]);
            }
        }
    }
}
