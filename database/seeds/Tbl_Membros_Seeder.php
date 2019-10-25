<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class Tbl_Membros_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Mebros para Site CEPSMA =============================================================
        DB::table('tbl_membros')->insert([
            'id'=>1,
            'nome'=>"Ana",
            'descricao'=>'Professora do ensino médio e fundamental de matemática.',
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\membros\\membro-1-1.jpg"),
            'id_funcao'=>1,
            'id_site'=>1,
        ]);

        DB::table('tbl_membros')->insert([
            'id'=>2,
            'nome'=>"Beth",
            'descricao'=>'Professora do ensino médio e fundamental de portugês.',
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\membros\\membro-2-1.jpeg"),
            'id_funcao'=>1,
            'id_site'=>1,
        ]);

        DB::table('tbl_membros')->insert([
            'id'=>3,
            'nome'=>"Clara",
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\membros\\membro-3-1.jpg"),
            'id_funcao'=>2,
            'id_site'=>1,
        ]);

        DB::table('tbl_membros')->insert([
            'id'=>4,
            'nome'=>"Débora",
            'descricao'=>'Responsável pela recepção na site.',
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\membros\\membro-4-1.jpg"),
            'id_funcao'=>3,
            'id_site'=>1,
        ]);

    }
}
