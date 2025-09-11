<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina_professor extends Model
{
    use HasFactory;
    protected $table = "disciplina_professors";
    protected $fillable = ['disciplinaId','professorId','turmaId','classeId','seccaoId', 'status'];
}
