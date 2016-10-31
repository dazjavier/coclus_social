<?php

use Illuminate\Database\Seeder;

class CommunicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('communication_type')->insert([ 'name' => 'Implante Coclear' ]);
        DB::table('communication_type')->insert([ 'name' => 'Audífono' ]);
        DB::table('communication_type')->insert([ 'name' => 'Lengua de Señas' ]);
    }
}
