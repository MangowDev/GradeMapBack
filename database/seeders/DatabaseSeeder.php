<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SubjectSeeder::class,
            UserSeeder::class,
            ClassroomSeeder::class,
            BoardSeeder::class,
            ComputerSeeder::class,
            AssignComputerToUserSeeder::class,
            GradeSeeder::class
        ]);
    }
}
