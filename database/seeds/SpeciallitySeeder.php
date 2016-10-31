<?php

use Illuminate\Database\Seeder;

class SpeciallitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('speciallity')->insert([ 'name' => 'Fonoaudiólogo' ]);
        DB::table('speciallity')->insert([ 'name' => 'Terapeuta Ocupacional' ]);
        DB::table('speciallity')->insert([ 'name' => 'Psicólogo Clínico' ]);
        DB::table('speciallity')->insert([ 'name' => 'Educador Diferencial/Audición y Lenguaje' ]);
        DB::table('speciallity')->insert([ 'name' => 'Profesor Lengua de Señas' ]);
        DB::table('speciallity')->insert([ 'name' => 'Médico Otorrino' ]);
        DB::table('speciallity')->insert([ 'name' => 'Tecnólogo Médico' ]);
        DB::table('speciallity')->insert([ 'name' => 'Audiólogo' ]);
        DB::table('speciallity')->insert([ 'name' => 'Musicoterapeuta' ]);
        DB::table('speciallity')->insert([ 'name' => 'Interprete Lengua de Señas' ]);
        DB::table('speciallity')->insert([ 'name' => 'Otro/a' ]);
    }
}
