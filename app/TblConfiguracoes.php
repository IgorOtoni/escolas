<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblConfiguracoes extends Model
{
    protected $fillable = ['id','id_igreja','id_template','url','texto_apresentativo','facebook','twitter','youtube'];
}
