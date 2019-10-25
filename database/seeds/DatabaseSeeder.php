<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Seeder_Gratunos::class);
        //$this->call(Tbl_Sites_Seeder::class);
        //$this->call(Tbl_Funcoes_Seeder::class);
        //$this->call(Tbl_Membros_Seeder::class);
        //$this->call(Tbl_Perfis_Seeder::class); 
        //$this->call(Tbl_User_Seeder::class);
        //$this->call(Tbl_Modulos_Seeder::class);
        //$this->call(Tbl_Permissoes_Seeder::class);
        //$this->call(Tbl_Permissoes_Modulos_Seeder::class);
        
        /*$this->call(Tbl_Sites_Modulos_Seeder::class);
        $this->call(Tbl_Perfis_Sites_Modulos_Seeder::class);
        $this->call(Tbl_Perfis_Permissoes_Seeder::class);
        $this->call(Tbl_Template_Seeder::class);
        $this->call(Tbl_Configuracao_Seeder::class);
        $this->call(Tbl_Eventos_Fixos_Seeder::class);
        $this->call(Tbl_Noticias_Seeder::class);
        $this->call(Tbl_Eventos_Seeder::class);
        $this->call(Tbl_Midias_Seeder::class);
        $this->call(Tbl_Galeria_Seeder::class);
        $this->call(Tbl_Fotos_Seeder::class);
        $this->call(Tbl_Menus_Android_Seeder::class);
        $this->call(Tbl_Menus_Seeder::class);
        $this->call(Tbl_Sub_Menus_Seeder::class);
        $this->call(Tbl_Sub_Sub_Menus_Seeder::class);
        $this->call(Tbl_Publicacao_Seeder::class);
        $this->call(Tbl_Publicacao_Fotos_Seeder::class);
        $this->call(Tbl_Banner_Seeder::class);
        $this->call(Tbl_Template_Fotos_Seeder::class);
        $this->call(Tbl_Comunidades_Seeder::class);*/
    }
}
