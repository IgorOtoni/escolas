<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblNoticias extends Model
{
    protected $fillable = ['id','nome','id_site','descricao','foto'];
}
