<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tbl_Template_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_templates')->insert([
            'nome'=>'Template padrão 1',
        ]);

        DB::table('tbl_templates')->insert([
            'nome'=>'Template padrão 2',
        ]);

        DB::table('tbl_templates')->insert([
            'nome'=>'Template padrão 3',
        ]);

        DB::table('tbl_templates')->insert([
            'nome'=>'Template padrão 4',
        ]);

        DB::table('tbl_templates')->insert([
            'nome'=>'Template padrão 5',
        ]);

        DB::table('tbl_templates')->insert([
            'nome'=>'Template padrão 6',
        ]);
    }
}
