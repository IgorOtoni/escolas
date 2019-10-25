<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tbl_Configuracao_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_configuracoes')->insert([
            'id'=>1,
            'id_site'=>1,
            'id_template'=>1,
            'url'=>'cepsma',
            'texto_apresentativo'=>'NOSSA MISSÃO É OFERECER ORIENTAÇÃO CRISTÃ COM UMA EDUCAÇÃO ALICERÇADA NA "ROCHA" DO RESPEITO VOLTADA PARA OS VALORES PRIMEIROS , PREPARANDO OS EDUCANDOS PARA A VIDA. COM O COMPROMISSO DE FORMAR CRIANÇAS E ADOLESCENTES CAPAZES DE RACIOCINAR POR SI PRÓPRIOS, JOVENS QUE FAÇAM PARTE DA SOCIEDADE CONTEMPORÂNEA, COMO INDIVÍDUOS FELIZES E PESSOAS PLENAS. Tipos de educação: Maternal, Educação Infantil, Ensino Fundamental e Ensino Médio Regular - Supletivo Ensino Fundamental (anos finais) e Médio - Cursos Superiores EAD.',
        ]);

    }
}
