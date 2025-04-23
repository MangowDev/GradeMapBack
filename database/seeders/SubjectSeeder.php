<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            'Matemáticas',
            'Lengua y Literatura',
            'Inglés',
            'Historia',
            'Física',
            'Química',
            'Educación Física',
            'Tecnología',
        ];

        foreach ($subjects as $name) {
            Subject::create(['name' => $name]);
        }
    }
}
