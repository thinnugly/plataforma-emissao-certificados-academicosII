<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;

class StudentController extends Controller
{
    //
    public function index()
    {
        return view('studentdash');
    }

    public function getUserCertQtd()
    {
        $getUserLogged = Auth::user()->name;
        $users = DB::select('SELECT count(c.estudanteId) cD FROM certificados c INNER JOIN estudantes e ON c.estudanteId = e.nomeCompleto 
        INNER JOIN users u ON u.email = e.userId WHERE u.name =:name', ['name' => $getUserLogged]);
        return view('studentdash', ['users' => $users]);
    }

    public function getAllForEspUser()
    {
        $getUserLogged = Auth::user()->name;
        $allUserInfo = DB::select('SELECT e.* , c.*  FROM certificados c INNER JOIN estudantes e ON c.estudanteId = e.nomeCompleto 
        INNER JOIN users u ON u.email = e.userId WHERE u.name =:name', ['name' => $getUserLogged]);
        return view('estudante.stucertificados', ['allUserInfo' => $allUserInfo]);
    }

    public function viewPDFStu($stuname)
    {
        
        $getStuSeccao = DB::select('SELECT estudantes.* ,certificados.*  FROM certificados INNER JOIN
        estudantes ON estudantes.nomeCompleto=certificados.estudanteId WHERE estudantes.nomeCompleto =:nomeCompleto',
        ['nomeCompleto'=>$stuname]);
        foreach($getStuSeccao as $getStuSeccao)
        {
            
            if($getStuSeccao->contacto == "Ciências Naturas (Opção B)")
            {
                
                if($getStuSeccao->mediaFinal >= 10)
                {
                    $certificado = DB::select('SELECT estudantes.nomeCompleto,estudantes.naturalidade,
                    estudantes.morada, estudantes.nomePai, estudantes.nomeMae, estudantes.classe,
                    estudantes.contacto,estudantes.dataNascimento, estudantes.Sexo, certificados.portugues,
                    certificados.ingles, certificados.filosolia, certificados.created_at, certificados.fisica, certificados.biologia,
                    certificados.quimica, certificados.matematica, certificados.edfisica, certificados.mediaFinal
                    FROM certificados INNER JOIN estudantes
                    ON estudantes.nomeCompleto=certificados.estudanteId WHERE estudantes.nomeCompleto =:nomeCompleto', ['nomeCompleto'=>$stuname]);

                    view()->share('estudante.certificadostudetails', $certificado);
                    $pdf = PDF::loadview('estudante.certificadostudetails', ['certificado'=>$certificado]);
                    return $pdf->setPaper('a4', 'portrait')->stream();
                }else
                {
                    return redirect()->route('returnViewPDF')->with('error', 'Impossível visualizar o certificado do estudante...');
                }
                
            }else if($getStuSeccao->contacto == "Letras com Matematica (Opção A)")
            {
                if($getStuSeccao->mediaFinal >= 10)
                {
                    $certificado = DB ::select('SELECT estudantes.nomeCompleto,estudantes.naturalidade,
                    estudantes.morada, estudantes.nomePai, estudantes.nomeMae, estudantes.classe,
                    estudantes.contacto,estudantes.dataNascimento, estudantes.Sexo, certificados.portugues,
                    certificados.ingles, certificados.frances, certificados.created_at, certificados.matematica, certificados.edfisica,
                    certificados.geografia, certificados.historia, certificados.mediaFinal
                    FROM certificados INNER JOIN estudantes
                    ON estudantes.nomeCompleto=certificados.estudanteId WHERE estudantes.nomeCompleto =:nomeCompleto', ['nomeCompleto'=>$stuname]);
                    view()->share('estudante.certificadostudetails', $certificado);
                    $pdf = PDF::loadview('estudante.certificadostudetails', ['certificado'=>$certificado]);
                    return $pdf->setPaper('a4', 'portrait')->stream();
                }else
                {
                    return redirect()->route('returnViewPDF')->with('error', 'Impossível visualizar o certificado do estudante...');
                }
                
                
            }
        }


    }
}
