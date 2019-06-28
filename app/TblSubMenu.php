<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblSubMenu extends Model
{
    protected $fillable = ['id','nome','link','id_menu','ordem'];
}
