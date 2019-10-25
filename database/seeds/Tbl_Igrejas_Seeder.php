<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Tbl_Sites_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_sites')->insert([
            'id'=>1,
            'nome'=>'Colégio CEPSMA',
            'cnpj'=>'999.999.999/9999-99',
            'estado' => 'MG',
            'cidade' => 'Coronel Fabriciano',
            'bairro' => 'Centro',
            'rua' => 'Avenida Pedro Nolasco',
            'num'=> '609',
            'cep'=> '35.170-300',
            'logo'=> file_get_contents(getcwd()."\\public\\storage\\sites\\logo-site-1.png"),
            'status'=> true,
        ]);
    }
}
