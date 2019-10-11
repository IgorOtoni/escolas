<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class Tbl_Eventos_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_eventos')->insert([
            'id'=>1,
            'nome'=>"Encenação na escola",
            'dados_horario_inicio'=>Carbon::parse(date('Y-m-d h:i:s', time()))->addHour(4),
            'dados_horario_fim'=>Carbon::parse(date('Y-m-d h:i:s', time()))->addHour(5),
            'dados_local'=>"Na própria escola.",
            'id_igreja'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\timeline\\timeline-16-1.jpg"),
            'descricao'=>"Teatro da escola.",
        ]);
    }
}
