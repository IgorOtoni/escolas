<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tbl_Banner_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('tbl_banners')->insert([
            'id'=>1,
            'nome'=>'Venha conhecer nossa escola!',
            'descricao'=>'Clique aqui para saber mais sobre nossa localização e contatos.',
            'foto'=>file_get_contents(getcwd().'\\public\\storage\\banners\\banner-1-1.jpg'),
            'link'=>'contato',
            'ordem'=>1,
            'id_igreja'=>1,
        ]);
        DB::table('tbl_banners')->insert([
            'id'=>2,
            'nome'=>'Venha fazer curso de inglês em nossa escola!',
            'descricao'=>'Clique aqui para saber mais sobre nossa localização e contatos.',
            'foto'=>file_get_contents(getcwd().'\\public\\storage\\banners\\banner-2-1.jpeg'),
            'link'=>'contato',
            'ordem'=>1,
            'id_igreja'=>1,
        ]);
        DB::table('tbl_banners')->insert([
            'id'=>3,
            'nome'=>'Temos a melhor equipe de professores!',
            'descricao'=>'Clique aqui para saber mais sobre nossa equipe.',
            'foto'=>file_get_contents(getcwd().'\\public\\storage\\banners\\banner-3-1.jpeg'),
            'link'=>'apresentacao',
            'ordem'=>1,
            'id_igreja'=>1,
        ]);
        DB::table('tbl_banners')->insert([
            'id'=>4,
            'nome'=>'Venha conhecer nossa escola!',
            'descricao'=>'Clique aqui para saber mais sobre nossa localização e contatos.',
            'foto'=>file_get_contents(getcwd().'\\public\\storage\\banners\\banner-4-1.jpeg'),
            'link'=>'contato',
            'ordem'=>1,
            'id_igreja'=>1,
        ]);
        DB::table('tbl_banners')->insert([
            'id'=>5,
            'nome'=>'Venha conhecer nossa escola!',
            'descricao'=>'Clique aqui para saber mais sobre nossa localização e contatos.',
            'foto'=>file_get_contents(getcwd().'\\public\\storage\\banners\\banner-5-1.jpeg'),
            'link'=>'contato',
            'ordem'=>1,
            'id_igreja'=>1,
        ]);
        DB::table('tbl_banners')->insert([
            'id'=>6,
            'nome'=>'Venha conhecer nossa escola!',
            'descricao'=>'Clique aqui para saber mais sobre nossa localização e contatos.',
            'foto'=>file_get_contents(getcwd().'\\public\\storage\\banners\\banner-6-1.jpeg'),
            'link'=>'contato',
            'ordem'=>1,
            'id_igreja'=>1,
        ]);
        DB::table('tbl_banners')->insert([
            'id'=>7,
            'nome'=>'Venha conhecer nossa escola!',
            'descricao'=>'Clique aqui para saber mais sobre nossa localização e contatos.',
            'foto'=>file_get_contents(getcwd().'\\public\\storage\\banners\\banner-7-1.jpeg'),
            'link'=>'contato',
            'ordem'=>1,
            'id_igreja'=>1,
        ]);
        DB::table('tbl_banners')->insert([
            'id'=>8,
            'nome'=>'Venha conhecer nossa escola!',
            'descricao'=>'Clique aqui para saber mais sobre nossa localização e contatos.',
            'foto'=>file_get_contents(getcwd().'\\public\\storage\\banners\\banner-8-1.jpeg'),
            'link'=>'contato',
            'ordem'=>1,
            'id_igreja'=>1,
        ]);
        DB::table('tbl_banners')->insert([
            'id'=>9,
            'nome'=>'Venha conhecer nossa escola!',
            'descricao'=>'Clique aqui para saber mais sobre nossa localização e contatos.',
            'foto'=>file_get_contents(getcwd().'\\public\\storage\\banners\\banner-9-1.jpeg'),
            'link'=>'contato',
            'ordem'=>1,
            'id_igreja'=>1,
        ]);
        DB::table('tbl_banners')->insert([
            'id'=>10,
            'nome'=>'Venha conhecer nossa escola!',
            'descricao'=>'Clique aqui para saber mais sobre nossa localização e contatos.',
            'foto'=>file_get_contents(getcwd().'\\public\\storage\\banners\\banner-10-1.jpeg'),
            'link'=>'contato',
            'ordem'=>1,
            'id_igreja'=>1,
        ]);
    }
}
