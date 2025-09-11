<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/usuarios";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        return view('auth.index');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required','regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/'],
            'email' => ['required','email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:12', 'confirmed'],
            'perfil' => ['required'],
        ],
            [
                'name.required'=>'O campo do nome do usuário é obrigatório.',
                'name.regex'=>'O nome do usuário fornecido é inválido.',
                'email.required'=>'O campo do email é obrigatório.',
                'email.email'=>'O email fornecido não é válido.',
                'email.unique'=>'O email fornecido pertence a um usuário que foi registado.',
                'password.required'=>'O campo da password é obrigatório.',
                'password.min'=>'A password deve possuir :min caracteres no mínimo.',
                'password.max'=>'A password deve possuir :max caracteres no máximo.',
                'password.confirmed'=>'A password e a password de confirmação não coincidem.',
                'perfil.required'=>'Selecione o perfil.',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = (User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]));
        $user->attachRole($data['perfil']);
        return $user;
    }

    public function edit($id)
    {
        $users = User::find($id);
        $usersd = DB::select('select roles.display_name, roles.id from roles inner join
        role_user on roles.id=role_user.role_id inner join users on users.id=role_user.user_id
    where users.id =:id',['id' => $id]);
        return view('auth.edit', compact('users', 'usersd'));
    }

    public function show($id)
    {
        //$users = User::find($id);
        $users = DB::select('select users.name, users.email, roles.display_name from roles inner join
        role_user on roles.id=role_user.role_id inner join users on users.id=role_user.user_id
    where users.id =:id',['id' => $id]);
        return view('auth.show', compact('users'));
    }

    public function deleteUser($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return response()->json(['status'=>'Usuário deleted successfully']);

    }

    public function pesquisar(Request $request)
    {
//        $users = DB::select('select users.name, users.email, roles.display_name from roles inner join
//        role_user on roles.id=role_user.role_id inner join users on users.id=role_user.user_id
//    where users.name =:name',['name' => $val]);
//        return response()->json(
//            [
//                'users'=>$users
//            ]);
        $users = DB::table('roles')
            ->join('role_user','roles.id', '=','role_user.role_id')
            ->join('users','role_user.user_id','=','users.id')
            ->select('users.name','users.email','users.id','roles.display_name')
            ->where('users.name', 'like', '%' .$request->val. '%')->get();
//            ->Orwhere('users.email', 'like', '%' .$val. '%')
//            ->Orwhere('roles.display_name', 'like', '%' .$val. '%');
        return response()->json($users);
    }

    public function getAll()
    {
        $users = DB::table('roles')
            ->join('role_user','roles.id', '=','role_user.role_id')
            ->join('users','role_user.user_id','=','users.id')
            ->select('users.name','users.email','users.id','roles.display_name')
            ->get();
        return response()->json($users);
    }

    public function updateUserRoles(Request $request)
    {
        $results = DB::table('role_user')
                       ->where(['user_id' => $request->getUserId])
                       ->update(['role_id' => $request->insertNewRoleValue]);
        return response()->json(
            [
                'results' => $results,
                'status' => 200,
                'message' => 'Role updated successfully....',
            ]
        );
        
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => ['required','regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/'],
            'email' => ['required','email', 'max:255', ''],
            'password' => ['required', 'string', 'min:8', 'max:12', 'confirmed'],
            'perfil' => ['required'],
        ],
            [
                'name.required'=>'O campo do nome do usuário é obrigatório.',
                'name.regex'=>'O nome do usuário fornecido é inválido.',
                'email.required'=>'O campo do email é obrigatório.',
                'email.email'=>'O email fornecido não é válido.',
                'email.unique'=>'O email fornecido pertence a um usuário foi registado.',
                'password.required'=>'O campo da password é obrigatório.',
                'password.min'=>'A password deve possuir :min caracteres no mínimo.',
                'password.max'=>'A password deve possuir :max caracteres no máximo.',
                'password.confirmed'=>'A password e a password de confirmação não coincidem.',
                'perfil.required'=>'Selecione o perfil.',
            ]
        );
        $user = User::find($id);
        $user->update([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('usuarios')
            ->with('success2', 'Usuário actualizado sucesso.');
        // $user = User::find($id);
        // if($user)
        // {
        //     $user->name = $request->input('name');
        //     $user->email = $request->input('email');
        //     $user->password = Hash::make($request->input('password'));
        //     $certificado->update();
        //     return response()->json([
        //         'status' => 200,
        //         'message' => 'Usuário actalizado com sucesso....',
        //     ]);
        // }else
        // {
        //     return response()->json([
        //         'status' => 404,
        //         'message' => 'Usuário não encontrado....',
        //     ]);
        // }
        
    }


}
