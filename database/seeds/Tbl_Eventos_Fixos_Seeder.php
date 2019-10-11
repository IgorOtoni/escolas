<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tbl_Eventos_Fixos_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_eventos_fixos')->insert([
            'id'=>1,
            'nome'=>"Aulas do ensino médio",
            'dados_horario_local'=>"De segunda a sexta, de 7:00 ás 11:30, na escola.",
            'id_igreja'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\eventos\\evento-1-1.jpeg"),
            'descricao'=>"Horário de todas as turmas do ensino médio.",
        ]);

        DB::table('tbl_eventos_fixos')->insert([
            'id'=>2,
            'nome'=>"Aulas do ensino fundamental",
            'dados_horario_local'=>"De segunda a sexta, de 7:00 ás 13:30 e de 13:00 ás 17:30, na escola.",
            'id_igreja'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\eventos\\evento-2-1.jpeg"),
            'descricao'=>"Horário de todas as turmas do ensino fundamental.",
        ]);
    }
}
