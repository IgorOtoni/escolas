<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblPermissao extends Model
{
    protected $table = 'tbl_permissoes';
    protected $fillable = ['id','nome','descricao'];
}
