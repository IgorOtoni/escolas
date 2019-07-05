<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Tbl_Igrejas_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_igrejas')->insert([
            'id'=>1,
            'nome'=>'Colégio CEPSMA',
            'estado' => 'MG',
            'cidade' => 'Coronel Fabriciano',
            'bairro' => 'Centro',
            'rua' => 'Avenida Pedro Nolasco',
            'num'=> '609',
            'cep'=> '35.170-300',
            'logo'=> 'logo-igreja-1.jpeg',
            'status'=> true,
        ]);
    }
}
