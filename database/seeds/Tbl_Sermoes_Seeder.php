<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class Tbl_Sermoes_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('tbl_sermoes')->insert([
            'id'=>1,
            'nome'=>"Evento da escola",
            'id_igreja'=>1,
            'link'=>"https://www.youtube.com/embed/mJnIPgmEtJU",
            'descricao'=>"Evento da escola.",
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time()))->addHour(-20),
        ]);
        DB::table('tbl_sermoes')->insert([
            'id'=>2,
            'nome'=>"Eduno",
            'id_igreja'=>1,
            'link'=>"https://www.youtube.com/embed/8nEFSJKKTnA",
            'descricao'=>"Apresentação do Eduno.",
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time()))->addHour(-20),
        ]);
        
    }
}
