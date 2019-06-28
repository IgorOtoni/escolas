<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblSubSubMenu extends Model
{
    protected $fillable = ['id','nome','link','id_submenu','ordem'];
}
