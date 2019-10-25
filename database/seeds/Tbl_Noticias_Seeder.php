<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Tbl_Noticias_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_noticias')->insert([
            'id'=>1,
            'nome'=>"Campanha a favor das árvores!",
            'id_site'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\noticias\\noticia-1-1.jpeg"),
            'descricao'=>"Nossa site está incentivando os alunos a plantar uma árvore e promovendo conscientização sobre o desmatamento.",
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time()))->addHour(-50),
        ]);

        DB::table('tbl_noticias')->insert([
            'id'=>2,
            'nome'=>"Curso de inglês extra-classe!",
            'id_site'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\noticias\\noticia-2-1.jpeg"),
            'descricao'=>"Venham participar da nossa nova turma de inglês.",
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time()))->addHour(-40),
        ]);
    }
}
