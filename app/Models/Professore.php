<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professore extends Model
{
    use HasFactory;
    protected $table = "professores";
    protected $fillable = ['nomeCompleto','Sexo','paidId','dataNascimento','userId','naturalidade', 'morada','bi','contacto', 'discId'];
}
