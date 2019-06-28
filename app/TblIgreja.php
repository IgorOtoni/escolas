<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblIgreja extends Model
{
    protected $fillable = ['id','nome','cep','estado','cidade','bairro','rua','complemento','num','telefone','email','status','logo'];
}