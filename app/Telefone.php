<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use SoftDeletes;


    protected $fillable = ['cliente', 'numero', 'usrinc', 'dtinc', 'usratualizacao', 'dtatualizacao', 'deleted_at'];
    protected $table = 'telefone';
}
