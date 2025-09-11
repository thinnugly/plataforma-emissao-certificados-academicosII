<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Lancar_notasController extends Controller
{
    public function index()
    {
        return view('professordash');
    }

    public function getProfQtdDisci()
    {
        $getUserLogged = Auth::user()->name;
        $prof_disc = DB::select('SELECT count(dp.disciplinaId) qtdDisc FROM disciplina_professors dp 
        INNER JOIN professores p ON dp.professorId = p.nomeCompleto 
        INNER JOIN users u ON p.userId = u.email WHERE u.name =:name', ['name' => $getUserLogged]);
        $prof_discII = DB::select('SELECT dp.disciplinaId FROM disciplina_professors dp 
        INNER JOIN professores p ON dp.professorId = p.nomeCompleto 
        INNER JOIN users u ON p.userId = u.email WHERE u.name =:name', ['name' => $getUserLogged]);
        return view('professordash', ['prof_disc' => $prof_disc, 'prof_discII' => $prof_discII]);
    }

}
