<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblMenu extends Model
{
    protected $fillable = ['id','nome','link','id_configuracao','ordem'];
}
