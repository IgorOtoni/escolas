<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblModulosPermissoes extends Model
{
    protected $fillable = ['id','id_permissao','id_modulo'];
}
