<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $preguntas = 'database/sql/preguntas_v4.sql';
        $respuestas = 'database/sql/respuestas_v4.sql';
        DB::unprepared(file_get_contents($preguntas));
        DB::unprepared(file_get_contents($respuestas));
    }
}
