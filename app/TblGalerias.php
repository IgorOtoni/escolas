<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblGalerias extends Model
{
    protected $fillable = ['id','nome','id_igreja','data','descricao'];
}
