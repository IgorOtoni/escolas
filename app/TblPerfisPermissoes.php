<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblPerfisPermissoes extends Model
{
    protected $fillable = ['id','id_perfil_igreja_modulo','id_permissao'];
}
