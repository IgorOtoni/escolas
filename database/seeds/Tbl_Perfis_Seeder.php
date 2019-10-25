<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Tbl_Perfis_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_perfis')->insert([
            'id'=>1,
            'nome'=>'ADM Plataforma',
            'descricao'=>'Administrador da plataforma.',
            'status'=> true,
            'id_site'=>null,
        ]);

        DB::table('tbl_perfis')->insert([
            'id'=>2,
            'nome'=>'ADM Site',
            'descricao'=>'Administrador do site da site.',
            'id_site'=>1,
        ]);

        DB::table('tbl_perfis')->insert([
            'id'=>100,
            'nome'=>'Comprador',
            'descricao'=>'Usuário que pode realizar compras na plataforma.',
            'status'=> true,
            'id_site'=>null,
        ]);

        DB::table('tbl_turnos_entregas')->insert([
            'id'=>1,
            'nome'=>'Manhã',
            'descricao'=>'De 6h as 12h.',
        ]);
        DB::table('tbl_turnos_entregas')->insert([
            'id'=>2,
            'nome'=>'Tarde',
            'descricao'=>'De 13h as 17h.',
        ]);
        DB::table('tbl_turnos_entregas')->insert([
            'id'=>3,
            'nome'=>'Noite',
            'descricao'=>'De 17h as 22h.',
        ]);

        DB::table('tbl_situacoes_entregas')->insert([
            'id'=>1,
            'nome'=>'Pendente',
        ]);
        DB::table('tbl_situacoes_entregas')->insert([
            'id'=>2,
            'nome'=>'Atrasada',
        ]);
        DB::table('tbl_situacoes_entregas')->insert([
            'id'=>3,
            'nome'=>'Realizada',
        ]);
        DB::table('tbl_situacoes_entregas')->insert([
            'id'=>4,
            'nome'=>'Cancelada',
        ]);

        DB::table('tbl_tipos_vendas')->insert([
            'id'=>1,
            'nome'=>'Unidade',
        ]);

        DB::table('tbl_categorias_produtos')->insert([
            'id'=>1,
            'nome'=>'Teste 1',
            'id_site'=>1,
        ]);
        DB::table('tbl_categorias_produtos')->insert([
            'id'=>2,
            'nome'=>'Teste 2',
            'id_site'=>1,
        ]);
    }
}