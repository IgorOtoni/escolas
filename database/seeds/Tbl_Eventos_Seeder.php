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
        /*DB::table('tbl_eventos')->insert([
            'id'=>1,
            'nome'=>"Jejum e oração",
            'dados_horario_inicio'=>Carbon::parse(date('Y-m-d h:i:s', time()))->addHour(4),
            'dados_horario_fim'=>Carbon::parse(date('Y-m-d h:i:s', time()))->addHour(5),
            'dados_local'=>"Na própria igreja.",
            'id_igreja'=>3,
            'foto'=>"timeline-1-3.jpg",
            'descricao'=>"A igreja estará jejuando e orando juntos pela intenção X.",
        ]);*/
    }
}
