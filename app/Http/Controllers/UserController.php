<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('estudante.create', ['users'=>$users]);
    }
    function getAllUsers(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::table('users')->get();
            echo json_encode($data);
        }
    }


}
