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
            [
                'name' => 'Montaje y Mantenimiento de Equipos',
                'image' => 'https://www.ticarte.com/sites/su/styles/maxxx/public/users/7/teaser/montaje_mantenimiento_equipo.jpg?itok=mPpmf2MR',
            ],
            [
                'name' => 'Sistemas Operativos Monopuesto',
                'image' => 'https://gradomediosistemasmicroinformaticos.gregoriofer.com/wp-content/uploads/2017/03/Web/images/mac.jpg',
            ],
            [
                'name' => 'Redes Locales',
                'image' => 'https://acelerapyme.afm.es/wp-content/uploads/2024/06/junio-11-banner-1024x512.webp',
            ],
            [
                'name' => 'Aplicaciones Ofimáticas',
                'image' => 'https://www.muypymes.com/wp-content/uploads/2014/08/weird-android-apps.jpg',
            ],
            [
                'name' => 'Seguridad Informática',
                'image' => 'https://www.ibero.edu.co/sites/default/files/styles/open_graph_images/public/2024-04/importancia-de-la-seguridad-inform%C3%A1tica.jpg.webp?itok=mtfFXpZL',
            ],
            [
                'name' => 'Servicios en Red',
                'image' => 'https://www.aurum-informatica.es/images/easyblog_articles/97/servicios-administracion-red.jpg',
            ],
            [
                'name' => 'Formación y Orientación Laboral (FOL)',
                'image' => 'https://emprego.xunta.gal/portal/portal/SPEG/Formacion/orientadores2023/imx_curso_web.jpg',
            ],
            [
                'name' => 'Empresa e Iniciativa Emprendedora',
                'image' => 'https://flippaconfol.com/wp-content/uploads/2021/09/Empresa-e-iniciativa-emprendedora.png',
            ],
            [
                'name' => 'Bases de Datos',
                'image' => 'https://www.godaddy.com/resources/latam/wp-content/uploads/sites/4/2023/06/portada_base-de-datos.png?size=3840x0',
            ],
            [
                'name' => 'Lenguajes de Marcas',
                'image' => 'https://atlantidaformacionprofesional.es/wp-content/uploads/2023/07/modulo-lenguaje-de-marcas-y-sistemas-de-gestion-de-informacion.jpg',
            ],
            [
                'name' => 'Programación',
                'image' => 'https://seovalladolid.es/wp-content/uploads/2024/02/cosejos-programacion.jpg',
            ],
            [
                'name' => 'Diseño web',
                'image' => 'https://acerkate.com/storage/2021/05/diseno-web-scaled.jpg',
            ],
            [
                'name' => 'Entornos de desarrollo',
                'image' => 'https://togrowagencia.com/wp-content/uploads/2024/02/web-software.jpg',
            ],
            [
                'name' => 'Acceso a Datos',
                'image' => 'https://www.muycomputerpro.com/wp-content/uploads/2018/10/empresas-gestion-cuentas-contrasenas.jpg',
            ],
            [
                'name' => 'Despliegue de Aplicaciones',
                'image' => 'https://raul-profesor.github.io/DEAW/img/application-server1.webp',
            ],
        ];

        $teachers = User::where('role', 'teacher')->get();

        if ($teachers->isEmpty()) {
            $this->command->warn("No hay usuarios con rol 'teacher'. No se asignarán teachers a las asignaturas.");
        }

        foreach ($subjects as $subject) {
            Subject::create([
                'name' => $subject['name'],
                'image' => $subject['image'],
                'teacher_id' => $teachers->isNotEmpty()
                    ? $teachers->random()->id
                    : null,
            ]);
        }
    }
}
