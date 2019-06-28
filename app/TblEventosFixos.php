<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblEventosFixos extends Model
{
    protected $fillable = ['id','nome','dados_horario_local','id_igreja','foto','descricao'];
}
