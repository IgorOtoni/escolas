<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblEventos extends Model
{
    protected $fillable = ['id','nome','dados_horario_inicio','dados_horario_fim','dados_local','id_igreja','foto','descricao'];
}
