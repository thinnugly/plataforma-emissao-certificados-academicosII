<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use App\Models\Users;
use App\Models\Turma;
use Illuminate\Support\Facades\DB;
use App\Models\Professore;
use App\Models\Disciplina;

class ProfessorController extends Controller
{
    public function index()
    {
        return view ('professor.index');
    }

    public function create()
    {
        $paises = Pais::all();
        $users = DB::select('SELECT email FROM users INNER JOIN role_user ON users.id=role_user.user_id INNER JOIN
    roles ON roles.id=role_user.role_id WHERE roles.name=:name', ['name'=>'professor']);
        $turmas = Turma::all();
        $disciplina = Disciplina:: all();
        return view ('professor.create', compact('paises', 'users', 'turmas', 'disciplina'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'nomeCompleto' => ['required','unique:professores'],
            'Sexo' => 'required',
            'paidId' => 'required',
            'naturalidade'=> 'required',
            'morada'=> 'required',
            'dataNascimento' => ['required','date'],
            'userId' => ['required','unique:professores'],
            'bi' => ['required','unique:professores','regex:/^[0-9]{12}[A-Z]$/'],
            'contacto' => ['required','unique:professores','regex:/^[0-9]{9}$/'],
            
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
            'discId.required' => 'Selecione a disciplina.',
        ]);

        $professor = Professore::create(
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

        return redirect()->route('professores')
            ->with('success', 'Professor created successfully.');
    }

    public function show($id)
    {
        $professor = Professore::find($id);
        /*$professor = DB::select('select professors.nomeCompleto, professors.Sexo, 
        professors.dataNascimento, pais.nome nacion, naturalidades.nome natur, moradas.nome, professors.bi
        professors.contacto users.email from professors inner join pais on professors.paidId=pais.nome 
        inner join naturalidades on professors.naturalidade=naturalidades.nome inner join moradas on 
        professors.morada=moradas.nome inner join users on users.email=professors.userId 
        where professors.id = :id',['id' => $id]);*/
        return view('professor.show', compact('professor'));
    }

    public function edit($id)
    {
        $professor = Professore::find($id);
        $paises = Pais::all();
        $users = DB::select('SELECT email FROM users INNER JOIN role_user ON users.id=role_user.user_id INNER JOIN
    roles ON roles.id=role_user.role_id WHERE roles.name=:name', ['name'=>'professor']);
        $disciplina = Disciplina:: all();
        return view('professor.edit', compact('professor','paises','users', 'disciplina'));
    }

    public function update(Request $request, $id)
    {
        if(!$professor = Professore::find($id))
        {
            return redirect()->back();
        }
        $id = $request->segment(4);
        request()->validate([
            'nomeCompleto' => ['required',"unique:professores,nomeCompleto,{$id},id"],
            'Sexo' => 'required',
            'paidId' => 'required',
            'naturalidade'=> 'required',
            'morada'=> 'required',
            'dataNascimento' => ['required','date'],
            'userId' => ['required',"unique:professores,userId,{$id},id"],
            'bi' => ['required',"unique:professores,bi,{$id},id",'regex:/^[0-9]{12}[A-Z]$/'],
            'contacto' => ['required',"unique:professores,contacto,{$id},id",'regex:/^[0-9]{9}$/'],
            
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

        $professor->update($request->all());

        return redirect()->route('professores')
            ->with('success1', 'Professor actualizado com sucesso...');
    }

    public function deleteProf($id)
    {
        $professor = Professore::findOrFail($id);
        $professor->delete();

        return response()->json(['status'=>'Professor deleted successfully']);

    }
}
