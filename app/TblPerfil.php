<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblPerfil extends Model
{
    protected $table = 'tbl_perfis';
    protected $fillable = ['id','nome','descricao','status'];
}
