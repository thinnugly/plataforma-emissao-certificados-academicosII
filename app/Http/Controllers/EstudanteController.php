<?php

namespace App\Http\Controllers;

use App\Models\Estudante;
use App\Models\User;
use App\Models\Pais;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

/**
 * Class EstudanteController
 * @package App\Http\Controllers
 */
class EstudanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //protected $redirectTo = "/admindash";

    public function index()
    {
        return view('estudante.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estudante = new Estudante();
        return view('estudante.create', compact('estudante'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nomeCompleto' => ['required','unique:estudantes'],
            'Sexo' => 'required',
            'paidId' => 'required',
            'naturalidade'=> 'required',
            'morada'=> 'required',
            'dataNascimento' => ['required','date'],
            'nomePai' => ['required','regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/'],
            'nomeMae' => ['required','regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/'],
            'classe' => 'required',
            'userId' => ['required','unique:estudantes'],
            'bi' => ['required','unique:estudantes','regex:/^[0-9]{12}[A-Z]$/'],
            'contacto' => ['required'],
            'turma_stu' => ['required'],
        ],[
            'nomeCompleto.required' => 'O campo do nome é obrigatório.',
            'nomeCompleto.unique' => 'O estudante fornecido já foi registado.',
            'Sexo.required' => 'Selecione o sexo.',
            'paidId.required' => 'Selecione o país.',
            'naturalidade.required' => 'Selecione a naturalidade.',
            'morada.required' => 'Selecione a morada.',
            'dataNascimento.required' => 'Selecione a data de nascimento.',
            'dataNascimento.date' => 'A data de nascimento fornecida não é válida.',
            'nomePai.required' => 'O campo do nome do pai é obrigatório.',
            'nomePai.regex' => 'O nome fornecido é inválido.',
            'nomeMae.required' => 'O campo do nome do pai é obrigatório.',
            'nomeMae.regex' => 'O nome fornecido é inválido.',
            'classe.required' => 'Selecione a classe.',
            'userId.required' => 'Selecione o usuário.',
            'userId.unique' => 'O usuário fornecido já foi registado.',
            'bi.required' => 'O campo do número de bilhete de identidade é obrigatório.',
            'bi.unique' => 'O número de bilhete de identidade fornecido já foi registado.',
            'bi.regex' => 'O número de bilhete de identidade fornecido é inválido.',
            'contacto.required'=>'O campo da secção é obrigatório.',
            'turma_stu.required' => 'Selecione a turma.',
            //'contacto.regex'=>'O número de telefone fornecido é inválido.',
            //'contacto.unique' => 'O número de telefone fornecido já foi registado.',
        ]);

        $estudante = Estudante::create(
            [
                'nomeCompleto' => $request->nomeCompleto,
                'Sexo' => $request->Sexo,
                'paidId' => $request->paidId,
                'dataNascimento' => $request->dataNascimento,
                'nomePai' => $request->nomePai,
                'nomeMae' => $request->nomeMae,
                'classe' => $request->classe,
                'userId' => $request->userId,
                'naturalidade' => $request->naturalidade,
                'morada' => $request->morada,
                'bi' => $request->bi,
                'contacto' => $request->contacto,
                'turma_stu' => $request->turma_stu,
            ]
        );

        return redirect()->route('estudantes')
            ->with('success', 'Estudante created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estudante = Estudante::find($id);
        /*$estudante = DB::select('select nomeCompleto, Sexo, nomePai, nomeMae, classe, dataNascimento,
       pais.nome, users.name, users.email from estudantes inner join pais on estudantes.paidId=pais.id inner join
           users on users.id=estudantes.userId                             where estudantes.id = :id',['id' => $id]);*/

        return view('estudante.show', compact('estudante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estudante = Estudante::find($id);
        $paises = Pais::all();
        $users = DB::select('SELECT email FROM users INNER JOIN role_user ON users.id=role_user.user_id INNER JOIN
    roles ON roles.id=role_user.role_id WHERE roles.name=:name', ['name'=>'student']);
        $turmas = Turma::all();
        return view('estudante.edit', compact('estudante','paises','users','turmas'));
    }

    /**
     * Update the specified resource in storage.
     * @
     * @param  \Illuminate\Http\Request $request
     * @param  Estudante $estudante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudante $estudante)
    {
        request()->validate([
            'nomeCompleto' => 'required',
            'Sexo' => 'required',
            'paidId' => 'required',
            'naturalidade'=> 'required',
            'morada'=> 'required',
            'dataNascimento' => ['required','date'],
            'nomePai' => ['required','regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/'],
            'nomeMae' => ['required','regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/'],
            'classe' => 'required',
            'userId' => ['required'],
            'bi' => ['required','regex:/^[0-9]{12}[A-Z]$/'],
            'contacto' => ['required'],
            'turma_stu' => ['required'],
        ],[
            'nomeCompleto.required' => 'O campo do nome é obrigatório.',
            'Sexo.required' => 'Selecione o sexo.',
            'paidId.required' => 'Selecione o país.',
            'naturalidade.required' => 'Selecione a naturalidade.',
            'morada.required' => 'Selecione a morada.',
            'dataNascimento.required' => 'Selecione a data de nascimento.',
            'dataNascimento.date' => 'A data de nascimento fornecida não é válida.',
            'nomePai.required' => 'O campo do nome do pai é obrigatório.',
            'nomePai.regex' => 'O nome fornecido é inválido.',
            'nomeMae.required' => 'O campo do nome do pai é obrigatório.',
            'nomeMae.regex' => 'O nome fornecido é inválido.',
            'classe.required' => 'Selecione a classe.',
            'userId.required' => 'Selecione o usuário.',
            'userId.unique' => 'O usuário fornecido já foi registado.',
            'bi.required' => 'O campo do número de bilhete de identidade é obrigatório.',
            'bi.regex' => 'O número de bilhete de identidade fornecido é inválido.',
            'contacto.required'=>'O campo da secção é obrigatório.',
            'turma_stu.required' => 'Selecione a turma.',
            //'contacto.regex'=>'O número de telefone fornecido é inválido.',
        ]);

        $estudante->update($request->all());

        return redirect()->route('estudantes')
            ->with('success1', 'Estudante actualizado com sucesso...');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $estudante = Estudante::find($id)->delete();

        return redirect()->route('estudantes')
            ->with('success', 'Estudante deleted successfully');
    }

    public function deleteStu($id)
    {
        $estudante = Estudante::findOrFail($id);
        $estudante->delete();

        return response()->json(['status'=>'Estudante deleted successfully']);

    }
    public function getAllToStudentCreate()
    {
        $paises = Pais::all();
        $users = DB::select('SELECT email FROM users INNER JOIN role_user ON users.id=role_user.user_id INNER JOIN
    roles ON roles.id=role_user.role_id WHERE roles.name=:name', ['name'=>'student']);
        $turmas = Turma::all();
        return view('estudante.create', compact('paises','users','turmas'));
    }
    public function getAllStu()
    {
        $students = DB::select('SELECT count(e.nomeCompleto) nC FROM estudantes e');
        $studentsHs = DB::select('SELECT count(e.nomeCompleto) nC FROM estudantes e where e.Sexo=:Sexo', ['Sexo'=>'Masculino']);
        $stMs = DB::select('SELECT count(e.nomeCompleto) nC FROM estudantes e where e.Sexo=:Sexo', ['Sexo'=>'Feminino']);
        $professores = DB::select('SELECT count(p.nomeCompleto) tp FROM professores p');
        $professHs = DB::select('SELECT count(p.nomeCompleto) tp FROM professores p where p.Sexo=:Sexo', ['Sexo'=>'Masculino']);
        $professMs = DB::select('SELECT count(p.nomeCompleto) tp FROM professores p where p.Sexo=:Sexo', ['Sexo'=>'Feminino']);
        $users = DB::select('SELECT count(u.name) userName FROM users u');
        return view('admindash', compact('students','studentsHs','stMs','users', 'professores', 'professHs', 'professMs'));
    }

    public function getAllToStudentEdit()
    {
        $paises = Pais::all();
        $users = DB::select('SELECT email FROM users INNER JOIN role_user ON users.id=role_user.user_id INNER JOIN
    roles ON roles.id=role_user.role_id WHERE roles.name=:name', ['name'=>'student']);
        return view('estudante.edit', ['paises'=>$paises], ['users'=>$users]);
    }
    public function findNaturalidadeByPais(Request $request)
    {
        $data = DB::select('select naturalidades.nome from naturalidades inner join pais on
    naturalidades.paisId=pais.id where pais.nome = :nome',['nome' => $request->paisN]);
        return response()->json($data);
    }

    public function findMordaByNaturalidade(Request $request)
    {
        $data = DB::select('select moradas.nome from moradas inner join naturalidades on
    naturalidades.id=moradas.naturalidadeId where naturalidades.nome = :nome',['nome' => $request->naturN]);
        return response()->json($data);
    }

    public function findNameByEmail(Request $request)
    {
        $data = DB::select('select users.name from users where users.email = :email',['email' => $request->userName]);
        return response()->json($data);
    }


    /*function getAllStu(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::table('estudantes')->get();
            echo json_encode($data);
        }
    }*/
    function getAllStuH(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::select('select * from estudantes where estudantes.Sexo = :Sexo',['Sexo' => $request->infoSexo]);
            echo json_encode($data);
        }
    }
    function getAllStuM(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::select('select * from estudantes where estudantes.Sexo = :Sexo',['Sexo' => $request->infoSexo]);
            echo json_encode($data);
        }
    }

    public function testeT()
    {
        $viewPDF = PDF::loadHTML('<h1>Testando a view do PDF');
        return $viewPDF->setPaper('a4')->stream('Teste.pdf');
    }

    public function getStuQTDByTurmaName(Request $request)
    {
        $qtdStuByTurma = DB::select('SELECT count(e.nomeCompleto) AS QTD FROM estudantes e WHERE e.turma_stu = :turma_stu',['turma_stu' => $request->turma_stu]);
        return response()->json($qtdStuByTurma);
    }

    public function getAllStuTurmaName(Request $request)
    {
        $data = DB::select('SELECT e.* FROM estudantes e WHERE e.turma_stu = :turma_stu',['turma_stu' => $request->turma_stu]);
        return response()->json($data);
    }
}
