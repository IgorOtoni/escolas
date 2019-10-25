<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class Tbl_Midias_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('tbl_midias')->insert([
            'id'=>1,
            'nome'=>"Evento da site",
            'id_site'=>1,
            'link'=>"https://www.youtube.com/embed/mJnIPgmEtJU",
            'descricao'=>"Evento da site.",
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time()))->addHour(-20),
        ]);
        DB::table('tbl_midias')->insert([
            'id'=>2,
            'nome'=>"Eduno",
            'id_site'=>1,
            'link'=>"https://www.youtube.com/embed/8nEFSJKKTnA",
            'descricao'=>"Apresentação do Eduno.",
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time()))->addHour(-20),
        ]);
        
    }
}
