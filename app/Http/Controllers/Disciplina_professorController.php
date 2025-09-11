<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Disciplina;
use App\Models\Seccoe;
use App\Models\Turma;
use Illuminate\Support\Facades\DB;
use App\Models\Professore;
use App\Models\Disciplina_professor;

class Disciplina_professorController extends Controller
{
    public function index()
    {
        return view ('disciplina_professor.index');
    }

    public function create()
    {
        $classe = Classe::all();
        $professor = Professore::all();
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

    public function findTurmaBySeccao(Request $request)
    {
        $data = DB::select('SELECT DISTINCT(t.nome_turma) FROM disciplina_sessoes ds INNER JOIN turmas t ON 
        ds.turma_id=t.id INNER JOIN seccoes s ON ds.seccao_id=s.id INNER JOIN estudantes e ON 
        t.nome_turma=e.turma_stu WHERE s.nome = :nome',['nome' => $request->seccaoName]);
        return response()->json($data);
    }

    public function findDisciplinaByTurma(Request $request)
    {
        $data = DB::select('SELECT d.* FROM turma_disciplina td INNER JOIN disciplinas d ON 
        td.disciplina_id=d.id INNER JOIN turmas t ON td.turma_id=t.id 
        WHERE t.nome_turma = :nome_turma AND td.status =:estado',
        [
            'nome_turma' => $request->turmaName,
            'estado' => 'Nenhum professor alocado'
        ]);
        return response()->json($data);

    }

    public function store(Request $request)
    {

        request()->validate([
            'classeId' => ['required'],
            'seccaoId' => 'required',
            'turmaId' => 'required',
            'disciplinaId'=> 'required',
            'professorId'=> 'required',
            
        ],[
            'classeId.required' => 'Selecione à classe',
            'seccaoId.required' => 'Selecione à secção.',
            'turmaId.required' => 'Selecione à turma.',
            'disciplinaId.required' => 'Selecione à disciplina que deseja alocar.',
            'professorId.required' => 'Selecione o professor para à disciplina a alocar.',
        ]);

        $disc_prof = Disciplina_professor::create(
            [
                'classeId' => $request->classeId,
                'seccaoId' => $request->seccaoId,
                'turmaId' => $request->turmaId,
                'disciplinaId' => $request->disciplinaId,
                'professorId' => $request->professorId,
            ]
        );
        return redirect()->route('_professor')
            ->with('success', 'Disciplina alocada successfully.');
    }

    public function findIdByDisciplina(Request $request)
    {
        $data = DB::select('SELECT d.id from disciplinas d WHERE
         d.nome = :nome',['nome' => $request->disciplinaName]);
        return response()->json($data);
    }

    public function updateDisciplinaStatus(Request $request)
    {
        $results = DB::table('turma_disciplina')
                       ->where(['disciplina_id' => $request->getDiscId])
                       ->update(['status' => "Professor alocado"]);
        return response()->json(
            [
                'results' => $results,
                'estado' => 200,
                'message' => 'Status updated successfully....',
            ]
        );
        
    }

    public function updateDisciplinaStatusII(Request $request)
    {
        $results = DB::table('turma_disciplina')
                       ->where(['disciplina_id' => $request->getDiscId])
                       ->update(['status' => "Nenhum professor alocado"]);
        return response()->json(
            [
                'results' => $results,
                'estado' => 200,
                'message' => 'Status updated successfully....',
            ]
        );
        
    }

    public function _deleteAlocar($id)
    {
        $disc_prof = Disciplina_professor::findOrFail($id);
        $disc_prof->delete();
    
        return response()->json(['status'=>'Disciplina desalocada successfully']);

    }

    public function edit($id)
    {
        $disc_prof = Disciplina_professor::find($id);
        $classe = Classe::all();
        $professor = Professore::all();
        return view ('disciplina_professor.edit', compact('disc_prof', 'classe', 'professor'));
    }

    public function update(Request $request, $id)
    {
        $disc_prof = Disciplina_professor::findOrFail($id);
        request()->validate([
            'classeId' => ['required'],
            'seccaoId' => 'required',
            'turmaId' => 'required',
            'disciplinaId'=> 'required',
            'professorId'=> 'required',
        ],[
            'classeId.required' => 'Selecione à classe',
            'seccaoId.required' => 'Selecione à secção.',
            'turmaId.required' => 'Selecione à turma.',
            'disciplinaId.required' => 'Selecione à disciplina que deseja alocar.',
            'professorId.required' => 'Selecione o professor para à disciplina a alocar.',
        ]);
        $disc_prof -> update(
            [
                'classeId' => $request->classeId,
                'seccaoId' => $request->seccaoId,
                'turmaId' => $request->turmaId,
                'disciplinaId' => $request->disciplinaId,
                'professorId' => $request->professorId,
            ]
        );
        
        return redirect()->route('_professor')
            ->with('success2', 'Alocação de disciplina actualizada com sucesso...');

        /*$results = DB::table('disciplina_professors')
        ->where(['id' => $request->id])
        ->update(['professorId' => $request->professorId]);
        return response()->json(
        [
            'results' => $results,
            'estado' => 200,
            'message' => 'Alocação de disciplina actualizada com sucesso...',
        ]
        );*/
    }

    public function show($id)
    {
        $disc_prof = Disciplina_professor::find($id);
        return view ('disciplina_professor.show', compact('disc_prof'));
    }
    
}
