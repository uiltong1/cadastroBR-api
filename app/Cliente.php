<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome','cpf', 'rg', 'dtcadastro', 'dtatualizacao', 'usrinc', 'usratualizacao', 'nascimento','localnasc'];
    protected $table = 'cliente';
}
