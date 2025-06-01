<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\User;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            'Montaje y Mantenimiento de Equipos',
            'Sistemas Operativos Monopuesto',
            'Redes Locales',
            'Aplicaciones Ofimáticas',
            'Seguridad Informática',
            'Servicios en Red',
            'Formación y Orientación Laboral (FOL)',
            'Empresa e Iniciativa Emprendedora',
            'Bases de Datos',
            'Lenguajes de Marcas y Sistemas de Gestión de la Información',
            'Programación',
            'Diseño web',
            'Entornos de desarrollo',
            'Acceso a Datos',
            'Desarrollo de Interfaces',
            'Despliegue de Aplicaciones',
            'Sistemas Informáticos',
            'Servicios de Red e Internet',
            'Administración de Sistemas Operativos',
            'Gestión de Bases de Datos',
        ];
        $teachers = User::where('role', 'teacher')->get();

        if ($teachers->isEmpty()) {
            $this->command->warn("No hay usuarios con rol 'teacher'. No se asignarán teachers a las asignaturas.");
        }

        foreach ($subjects as $index => $name) {
            Subject::create([
                'name' => $name,
                'image' => "https://picsum.photos/seed/subject{$index}/300/200",
                'teacher_id' => $teachers->isNotEmpty()
                    ? $teachers->random()->id
                    : null, // en caso de que no haya profesores
            ]);
        }
    }
}
