<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class Tbl_Fotos_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_fotos')->insert([
            'id'=>1,
            'id_galeria'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\galerias\\foto-1-1-1.jpeg"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);
        DB::table('tbl_fotos')->insert([
            'id'=>2,
            'id_galeria'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\galerias\\foto-2-1-1.jpeg"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);
        DB::table('tbl_fotos')->insert([
            'id'=>3,
            'id_galeria'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\galerias\\foto-3-1-1.jpeg"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);
        DB::table('tbl_fotos')->insert([
            'id'=>4,
            'id_galeria'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\galerias\\foto-4-1-1.jpeg"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);
        DB::table('tbl_fotos')->insert([
            'id'=>5,
            'id_galeria'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\galerias\\foto-5-1-1.jpeg"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);
        DB::table('tbl_fotos')->insert([
            'id'=>6,
            'id_galeria'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\galerias\\foto-6-1-1.jpeg"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);
        DB::table('tbl_fotos')->insert([
            'id'=>7,
            'id_galeria'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\galerias\\foto-7-1-1.jpeg"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);
        DB::table('tbl_fotos')->insert([
            'id'=>8,
            'id_galeria'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\galerias\\foto-8-1-1.jpeg"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);
        DB::table('tbl_fotos')->insert([
            'id'=>9,
            'id_galeria'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\galerias\\foto-9-1-1.jpeg"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);
        DB::table('tbl_fotos')->insert([
            'id'=>10,
            'id_galeria'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\galerias\\foto-10-1-1.jpeg"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);
    }
}
