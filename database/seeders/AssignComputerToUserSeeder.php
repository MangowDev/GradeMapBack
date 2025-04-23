<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Computer;

class AssignComputerToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $computers = Computer::all();

        if ($computers->isEmpty()) {
            $this->command->warn('No hay ordenadores disponibles.');
            return;
        }

        foreach ($users as $user) {
            if (rand(0, 1) && $computers->isNotEmpty()) {
                $user->computer_id = $computers->random()->id;
                $user->save();
            }
        }
    }
}
