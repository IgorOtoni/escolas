<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblConfiguracoes extends Model
{
    protected $fillable = ['id','id_site','id_template','url','texto_apresentativo','facebook','twitter','youtube'];
}
