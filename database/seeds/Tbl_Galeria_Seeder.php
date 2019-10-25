<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class Tbl_Galeria_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_galerias')->insert([
            'id'=>1,
            'nome'=>"Fotos de apresentação da nossa site",
            'id_site'=>1,
            'descricao'=>"Fotos de apresentação da nossa site.",
            'data'=>Carbon::parse(date('Y-m-d h:i:s', time()))->addHour(-30),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);
    }
}
