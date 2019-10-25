<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblMidias extends Model
{
    protected $fillable = ['id','nome','link','id_site','descricao'];
}
