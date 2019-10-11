<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Tbl_Template_Fotos_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_template_fotos')->insert([
            'id'=>1,
            'id_template'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-1-1.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>2,
            'id_template'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-2-1.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>3,
            'id_template'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-3-1.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>4,
            'id_template'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-4-1.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>5,
            'id_template'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-5-1.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>6,
            'id_template'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-6-1.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>7,
            'id_template'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-7-1.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>8,
            'id_template'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-8-1.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>9,
            'id_template'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-9-1.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>10,
            'id_template'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-10-1.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>11,
            'id_template'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-11-1.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>12,
            'id_template'=>1,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-12-1.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>13,
            'id_template'=>2,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-13-2.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>14,
            'id_template'=>2,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-14-2.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>15,
            'id_template'=>2,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-15-2.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>16,
            'id_template'=>2,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-16-2.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>17,
            'id_template'=>2,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-17-2.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>18,
            'id_template'=>2,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-18-2.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>19,
            'id_template'=>2,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-19-2.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>20,
            'id_template'=>2,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-20-2.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>21,
            'id_template'=>2,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-21-2.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>22,
            'id_template'=>2,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-22-2.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>23,
            'id_template'=>2,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-23-2.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>24,
            'id_template'=>2,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-24-2.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>25,
            'id_template'=>3,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-25-3.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>26,
            'id_template'=>3,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-26-3.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>27,
            'id_template'=>3,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-27-3.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>28,
            'id_template'=>3,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-28-3.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>29,
            'id_template'=>3,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-29-3.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>30,
            'id_template'=>3,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-30-3.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>31,
            'id_template'=>3,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-31-3.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>32,
            'id_template'=>3,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-32-3.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>33,
            'id_template'=>3,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-33-3.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>34,
            'id_template'=>3,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-34-3.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>35,
            'id_template'=>3,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-35-3.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);

        DB::table('tbl_template_fotos')->insert([
            'id'=>36,
            'id_template'=>3,
            'foto'=>file_get_contents(getcwd()."\\public\\storage\\templates\\template-36-3.png"),
            'created_at'=>Carbon::parse(date('Y-m-d h:i:s', time())),
        ]);
    }
}
