<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use App\Models\Naturalidade;
use App\Models\Morada;

class PaisController extends Controller
{
    public function index()
    {
        $paises = Pais::all();
        return view('estudante.create', ['paises'=>$paises]);
    }

    public function findNaturalidadeByPais(Request $request)
    {
        $data = Naturalidade::select('nome', 'id')->Where('paisId', $request->id)->take(100)->get();
        return response()->json($data);
    }

    public function findMordaByNaturalidade(Request $request)
    {
        $data = Morada::select('nome', 'id')->Where('naturalidadeId', $request->id)->take(100)->get();
        return response()->json($data);
    }
}
