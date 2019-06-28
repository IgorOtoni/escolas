<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblSermoes extends Model
{
    protected $fillable = ['id','nome','link','id_igreja','descricao'];
}
