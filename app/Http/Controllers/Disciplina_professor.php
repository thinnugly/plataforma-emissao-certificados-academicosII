<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Disciplina;
use App\Models\Seccoe;
use App\Models\Turma;
use Illuminate\Support\Facades\DB;
use App\Models\Professor;

class Disciplina_professor extends Controller
{
    public function index()
    {
        return view ('disciplina_professor.index');
    }

    public function create()
    {
        $classe = Classe::all();
        $professor = Professor::all();
        $turma = DB::select('SELECT t.nome_turma FROM turmas t INNER JOIN estudantes e ON 
        t.nome_turma=e.turma_stu');
        $turmas = Turma::all();
        return view ('disciplina_professor.create', compact('classe', 'turma', 'professor'));
    }

    public function findSeccaoByClasse(Request $request)
    {
        $data = DB::select('SELECT s.nome FROM seccoes s INNER JOIN classes c ON
    s.classeId=c.id WHERE c.nome = :nome',['nome' => $request->classeName]);
        return response()->json($data);
    }

    public function findDisciplinaBySeccao(Request $request)
    {
        $data = DB::select('SELECT d.nome FROM disciplinas d INNER JOIN seccoes s ON
    d.seccaoId=s.id WHERE s.nome = :nome',['nome' => $request->seccaoName]);
        return response()->json($data);
    }

    public function getDisAlocInfByProf(Request $request)
    {
        $results = DB::table('disciplina_professors')
        ->select('disciplina_professors.*')
        ->where('disciplina_professors.professorId', $request->profName)->get();
        return response()->json($results);
    }


    public function store(Request $request)
    {

        $results = DB::table('disciplina_professors')
        ->select('disciplina_professors.*')
        ->where('disciplina_professors.professorId', $request->professorId)->get();
        foreach($results as $result)
        {
            if($result->turmaId == "I1-AV")
            {
                return redirect()->route('_create')->with('error');
            }
        }
        /*$results = DB::select('SELECT dp.* FROM disciplina_professors dp');
        foreach($results as $results)
        {
            if($results->turmaId = $request->turmaId && $results->professorId = $request->professorId && 
            $results->seccaoId = $request->seccaoId)
            {
                return redirect()->route('_create')->with('error');
            }
        }
        /*$results = DB::table('disciplina_professors')
                       ->where(['professorId' => $request->getProfessorId])
                       ->select('disciplina_professors.*');
        return response()->json(
            [
                'results' => $results,
                'status' => 200,
                'message' => 'Role updated successfully....',
            ]
        );
        /*request()->validate([
            'nomeCompleto' => ['required','unique:professors'],
            'Sexo' => 'required',
            'paidId' => 'required',
            'naturalidade'=> 'required',
            'morada'=> 'required',
            'dataNascimento' => ['required','date'],
            'userId' => ['required','unique:professors'],
            'bi' => ['required','unique:professors','regex:/^[0-9]{12}[A-Z]$/'],
            'contacto' => ['required','unique:professors','regex:/^[0-9]{9}$/'],
            
        ],[
            'nomeCompleto.required' => 'O campo do nome é obrigatório.',
            'nomeCompleto.unique' => 'O professor fornecido já foi registado.',
            'Sexo.required' => 'Selecione o sexo.',
            'paidId.required' => 'Selecione o país.',
            'naturalidade.required' => 'Selecione a naturalidade.',
            'morada.required' => 'Selecione a morada.',
            'dataNascimento.required' => 'Selecione a data de nascimento.',
            'dataNascimento.date' => 'A data de nascimento fornecida não é válida.',
            'userId.required' => 'Selecione o usuário.',
            'userId.unique' => 'O usuário fornecido já foi registado.',
            'bi.required' => 'O campo do número de bilhete de identidade é obrigatório.',
            'bi.unique' => 'O número de bilhete de identidade fornecido já foi registado.',
            'bi.regex' => 'O número de bilhete de identidade fornecido é inválido.',
            'contacto.required'=>'O campo do contacto é obrigatório.',
            'contacto.regex'=>'O contacto fornecido é inválido.',
            'contacto.unique' => 'O contacto fornecido já foi registado.',
        ]);

        $estudante = Disciplina_professor::create(
            [
                'nomeCompleto' => $request->nomeCompleto,
                'Sexo' => $request->Sexo,
                'paidId' => $request->paidId,
                'dataNascimento' => $request->dataNascimento,
                'userId' => $request->userId,
                'naturalidade' => $request->naturalidade,
                'morada' => $request->morada,
                'bi' => $request->bi,
                'contacto' => $request->contacto,
                
            ]
        );

        return redirect()->route('_professor')
            ->with('success', 'Disciplina alocada successfully.');*/
    }
}
