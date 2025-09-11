<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificado;
use App\Models\Estudante;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Files;
use PDF;

class CertificadoController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view ('certificado.certificados');

    }

    public function fetchData(Request $request)
    {
        /*if($request->ajax())
        {
            $data = DB::select('SELECT certificados.estudanteId, certificados.portugues, certificados.ingles ,
        certificados.frances, certificados.filosolia, certificados.fisica, certificados.biologia,
       certificados.quimica, certificados.matematica, certificados.desenho, certificados.geografia
, certificados.edfisica, certificados.historia, certificados.mediaFinal, estudantes.contacto FROM certificados
INNER JOIN estudantes ON estudantes.nomeCompleto=certificados.estudanteId');
            echo json_encode($data);
        }*/
        $certificados = DB::select('SELECT certificados.id, certificados.estudanteId, certificados.portugues, certificados.ingles ,
        certificados.frances, certificados.filosolia, certificados.fisica, certificados.biologia,
       certificados.quimica, certificados.matematica, certificados.desenho, certificados.geografia
, certificados.edfisica, certificados.historia, certificados.mediaFinal, certificados.juri, certificados.situacao, estudantes.contacto FROM certificados
INNER JOIN estudantes ON estudantes.nomeCompleto=certificados.estudanteId order by certificados.estudanteId');
return response()->json([
    'certificados' => $certificados,
]);

    }

    public function getStuName(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::table('estudantes')->get();
            echo json_encode($data);
        }
    }

    public function getStuSeccao(Request $request)
    {
        $secca = Estudante::select('contacto')->Where('nomeCompleto', $request->getStuNCompleto)->take(100)->get();
        return response()->json($secca);
    }

    public function getStuSeccaoByCertId(Request $request)
    {
        $studCertSessao = DB::table('certificados')
        ->join('estudantes', 'certificados.estudanteId','=','estudantes.nomeCompleto')
        ->select('estudantes.contacto', 'estudantes.nomeCompleto','certificados.portugues',
        'certificados.ingles', 'certificados.frances', 'certificados.frances', 'certificados.fisica',
        'certificados.biologia','certificados.quimica', 'certificados.filosolia', 'certificados.matematica'
        , 'certificados.geografia', 'certificados.edfisica', 'certificados.historia', 'certificados.mediaFinal', 'certificados.juri', 'certificados.situacao')
        ->where('certificados.id', $request->id)->get();
        return response()->json($studCertSessao);
    }

    public function addData(Request $request)
    {


        $validator = Validator::make($request->all(),[
            'estudanteId' => 'unique:certificados',

        ],[
            'estudanteId.unique' => 'Não é permitido associar o mesmo aluno aos exames da mesma época....por favor, selecione outro.',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' =>$validator->messages(),
            ]);

        }else
        {
            $certificado = new Certificado();
            $certificado->estudanteId = $request->input('estudanteId');
            $certificado->portugues = $request->input('portugues');
            $certificado->ingles = $request->input('ingles');
            $certificado->filosolia = $request->input('filosolia');
            $certificado->fisica = $request->input('fisica');
            $certificado->biologia = $request->input('biologia');
            $certificado->quimica = $request->input('quimica');
            $certificado->matematica = $request->input('matematica');
            $certificado->edfisica = $request->input('edfisica');
            $certificado->frances = $request->input('frances');
            $certificado->geografia = $request->input('geografia');
            $certificado->historia = $request->input('historia');
            $certificado->mediaFinal = $request->input('mediaFinal');
            $certificado->juri = $request->input('juri');
            $certificado->situacao = $request->input('situacao');
            $certificado->save();
            return response()->json([
                'status' => 200,
                'message' => 'Registo inserido com sucesso....',
                //'message' => '<div class="alert alert-success alert-dismissible fade show" role="alert"><p>Certificado created successfully....</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>',
            ]);
        }
    }

    public function deleteCert($id)
    {
        $certificado = Certificado::findOrFail($id)->delete();

        return response()->json(['status'=>'Estudante deleted successfully']);
    }

    public function viewPDF($id)
    {
        
        $getStuSeccao = DB::select('SELECT estudantes.* ,certificados.*  FROM certificados INNER JOIN
        estudantes ON estudantes.nomeCompleto=certificados.estudanteId WHERE certificados.id=:id',
        ['id'=>$id]);
        foreach($getStuSeccao as $getStuSeccao)
        {
            
            if($getStuSeccao->contacto == "Ciências Naturas (Opção B)")
            {
                
                if($getStuSeccao->mediaFinal >= 10)
                {
                    $certificado = DB::select('SELECT certificados.id, estudantes.id as studId, estudantes.nomeCompleto,estudantes.naturalidade,
                    estudantes.morada, estudantes.nomePai, estudantes.nomeMae, estudantes.classe,
                    estudantes.contacto,estudantes.dataNascimento, estudantes.Sexo, certificados.portugues,
                    certificados.ingles, certificados.filosolia, certificados.created_at, certificados.fisica, certificados.biologia,
                    certificados.quimica, certificados.matematica, certificados.edfisica, certificados.juri, certificados.mediaFinal
                    FROM certificados INNER JOIN estudantes
                    ON estudantes.nomeCompleto=certificados.estudanteId WHERE certificados.id=:id', ['id'=>$id]);

                    //$certificate = 'file://'.base_path().'/public/tcpdf.crt';
                   
                    $cert = 'C:\\Users\\MUIAMBO\\Documents\\Keys\certASign.crt';


                    // set additional information in the signature
                    $info = array(
                        'Name' => 'Certificado digital',
                        'Location' => 'Cidade de Maputo',
                        'Reason' => 'Validar o certificado digital',
                        'ContactInfo' => 'http://www.wnndev.org.mz',
                    );
                    // set document signature
                    PDF::setSignature('file://'.$cert, 'file://'.realpath($cert), 'achaedfo','', 2, $info);

                    // set document title
                    PDF::SetTitle('Certificado - ' .$getStuSeccao->estudanteId);

                    // PDF::SetFont('helvetica', '', 12);
                    PDF::AddPage();

                    // print a line of text
                    $text = view('certificado.certificadodetails', compact('certificado'));

                    // add view content
                    PDF::writeHTML($text, true, 0, true, 0);   

                    // define active area for signature appearance
                    //PDF::setSignatureAppearance(150, 60, 15, 15);
                    
                    PDF::setSignatureAppearance(152, 250, 15, 15);

                    $image_file = 'img/baixados (2).png';
                    PDF::Image($image_file, 98, 0, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                    
                    // save pdf file
                    PDF::Output('Certificado - '.$getStuSeccao->estudanteId.'.pdf', 'I');
                    // view()->share('certificado.certificadodetails', $certificado);
                    // $pdf = PDF::writeHTML(view('certificado.certificadodetails', ['certificado'=>$certificado]));
                    // return $pdf->setPaper('a4', 'portrait')->stream();
                }else
                {
                    return redirect()->route('allCerts')->with('error', 'Impossível visualizar o certificado do estudante...');
                }
                
            }else if($getStuSeccao->contacto == "Letras com Matematica (Opção A)")
            {
                if($getStuSeccao->mediaFinal >= 10)
                {
                    $certificado = DB::select('SELECT certificados.id, estudantes.id as studId, estudantes.nomeCompleto,estudantes.naturalidade,
                    estudantes.morada, estudantes.nomePai, estudantes.nomeMae, estudantes.classe,
                    estudantes.contacto,estudantes.dataNascimento, estudantes.Sexo, certificados.portugues,
                    certificados.ingles, certificados.frances, certificados.created_at, certificados.matematica, certificados.edfisica,
                    certificados.geografia, certificados.historia, certificados.juri, certificados.mediaFinal
                    FROM certificados INNER JOIN estudantes
                    ON estudantes.nomeCompleto=certificados.estudanteId WHERE certificados.id=:id', ['id'=>$id]);
                    // view()->share('certificado.certificadodetails', $certificado);
                    // $pdf = PDF::loadview('certificado.certificadodetails', ['certificado'=>$certificado]);
                    // return $pdf->setPaper('a4', 'portrait')->stream();

                        //$certificate = 'file://'.base_path().'/public/tcpdf.crt';
                        $cert = 'C:\\Users\\MUIAMBO\\Documents\\Keys\certASign.crt';

                        // set additional information in the signature
                        $info = array(
                            'Name' => 'Certificado digital',
                            'Location' => 'Cidade de Maputo',
                            'Reason' => 'Validar o certificado digital',
                            'ContactInfo' => 'http://www.wnndev.org.mz',
                        );
                        // set document signature
                        //PDF::setSignature($certificate, $certificate, 'tcpdfdemo', '', 2, $info);
                        PDF::setSignature('file://'.$cert, 'file://'.realpath($cert), 'achaedfo','', 2, $info);
    
                        // set document title
                        PDF::SetTitle('Certificado - ' .$getStuSeccao->estudanteId);
    
                        // PDF::SetFont('helvetica', '', 12);
                        PDF::AddPage();
    
                        // print a line of text
                        $text = view('certificado.certificadodetails', compact('certificado'));
    
                        // add view content
                        PDF::writeHTML($text, true, 0, true, 0);   
    
                        // define active area for signature appearance
                        PDF::setSignatureAppearance(152, 250, 15, 15);

                        $image_file = 'img/baixados (2).png';
                        PDF::Image($image_file, 98, 0, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    
                        // save pdf file
                        PDF::Output('Certificado - '.$getStuSeccao->estudanteId.'.pdf', 'I');
                }else
                {
                    return redirect()->route('allCerts')->with('error', 'Impossível visualizar o certificado do estudante...');
                }
                
                
            }
        }


    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            //'estudanteId' => 'unique:certificados',

        ],[
            //'estudanteId.unique' => 'Só é permitido cadastrar um certificado por estudante....por favor, selecione outro.',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' =>$validator->messages(),
            ]);

        }else
        {
            $certificado = Certificado::find($id);
            if($certificado)
            {
                $certificado->estudanteId = $request->input('estudanteId');
                $certificado->portugues = $request->input('portugues');
                $certificado->ingles = $request->input('ingles');
                $certificado->filosolia = $request->input('filosolia');
                $certificado->fisica = $request->input('fisica');
                $certificado->biologia = $request->input('biologia');
                $certificado->quimica = $request->input('quimica');
                $certificado->matematica = $request->input('matematica');
                $certificado->edfisica = $request->input('edfisica');
                $certificado->frances = $request->input('frances');
                $certificado->geografia = $request->input('geografia');
                $certificado->historia = $request->input('historia');
                $certificado->mediaFinal = $request->input('mediaFinal');
                $certificado->juri = $request->input('juri');
                $certificado->situacao = $request->input('situacao');
                $certificado->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Registo actualizado com sucesso....',
                    //'message' => '<div class="alert alert-success alert-dismissible fade show" role="alert"><p>Certificado updated successfully....</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>',
                ]);
            }else
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'Certificado não encontrado....',
                    //'message' => '<div class="alert alert-danger alert-dismissible fade show" role="alert"><p>Certificado not found....</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>',
                ]);
            }
        }
    }

    public function getAllCert()
    {
        $certificados = DB::select('SELECT count(c.estudanteId) cD FROM certificados c WHERE c.situacao=:situacao',['situacao' => 'Aprovado']);
        $certificadosV2 = DB::select('SELECT count(c.estudanteId) dC FROM certificados c');
        return view('officedash', compact('certificados','certificadosV2'));
    }


    public function teste()
    {
        $viewPDF = PDF::loadHTML('<h1>Testando a view do PDF');
        return $viewPDF->setPaper('a4')->stream('Teste.pdf');
    }

    public function getStuMFinal($id)
    {
        $getStuSeccao = DB::select('SELECT estudantes.* ,certificados.*  FROM certificados INNER JOIN
        estudantes ON estudantes.nomeCompleto=certificados.estudanteId WHERE certificados.id=:id',
        ['id'=>$id]);
    }

    public function getCertQTDByJuri(Request $request)
    {
        $qtdCertByJuri = DB::select('SELECT count(c.estudanteId ) AS QTD FROM certificados c WHERE c.juri = :juri',['juri' => $request->juri]);
        return response()->json($qtdCertByJuri);
    }

    public function getAllCertJuri(Request $request)
    {
        $certificados = DB::select('SELECT certificados.id, certificados.estudanteId, certificados.portugues, certificados.ingles ,
        certificados.frances, certificados.filosolia, certificados.fisica, certificados.biologia,
        certificados.quimica, certificados.matematica, certificados.desenho, certificados.geografia
        , certificados.edfisica, certificados.historia, certificados.mediaFinal, certificados.juri, certificados.situacao, estudantes.contacto FROM certificados
        INNER JOIN estudantes ON estudantes.nomeCompleto=certificados.estudanteId WHERE certificados.juri = :juri order by certificados.estudanteId',
        ['juri' => $request->juri]);
        return response()->json($certificados);
    }
    public function getAllCertJuriV2(Request $request)
    {
        $qtdCertByJuriV2 = DB::select('SELECT count(c.estudanteId) as QTD FROM certificados c WHERE c.juri=:juri AND c.situacao = :situacao', ['juri'=>$request->juri,'situacao'=>$request->situacao]);
        return response()->json($qtdCertByJuriV2);
    }
    public function getAllCertJuriV22(Request $request)
    {
        $certificados = DB::select('SELECT certificados.id, certificados.estudanteId, certificados.portugues, certificados.ingles ,
        certificados.frances, certificados.filosolia, certificados.fisica, certificados.biologia,
        certificados.quimica, certificados.matematica, certificados.desenho, certificados.geografia
        , certificados.edfisica, certificados.historia, certificados.mediaFinal, certificados.juri, certificados.situacao, estudantes.contacto FROM certificados
        INNER JOIN estudantes ON estudantes.nomeCompleto=certificados.estudanteId WHERE certificados.juri = :juri AND certificados.situacao = :situacao order by certificados.estudanteId',
        ['juri'=>$request->juri,'situacao'=>$request->situacao]);
        return response()->json($certificados);
    }
    public function viewPauta($juri)
    {
        
        $getQTDCertByJuri = DB::select('SELECT count(c.estudanteId ) AS QTD FROM certificados c WHERE c.juri = :juri',
        ['juri'=>$juri]);

        foreach($getQTDCertByJuri as $qtdByJuri)
        {
            if($qtdByJuri->QTD == 0)
            {
                return redirect()->route('allCerts')->with('error1', 'Este júri possui 0 aluno (s) inscrito (s)!');
            }
            else
            {
                //$pdf = new TCPDF ('l', 'm', 'A4', 'true', 'UTF-8');
                $getAllCertByJuri = DB::select('SELECT certificados.*  FROM certificados WHERE certificados.juri=:juri',
                ['juri'=>$juri]);
                $view = \View::make('viewPauta', ['getAllCertByJuri'=>$getAllCertByJuri]);
                $htmlContent = $view->render();
                //$view = view('viewPauta', compact('getAllCertByJuri'));
                
                
                foreach($getAllCertByJuri as $certificado)
                {
                    PDF::SetTitle('Pauta do júri ' .$certificado->juri);
                    PDF::AddPage();
                    PDF::writeHTML($htmlContent, true, false, true, false, '');
                    //PDF::writeHTML($view, true, 0, true, 0);
                    PDF::Output(uniqid().'Pauta do júri ' .$certificado->juri.'.pdf', 'I'); 
                }

            }
            
        }



    }

    public function show($id)
    {
        $certificados = DB::select('SELECT certificados.*, estudantes.* FROM certificados
        INNER JOIN estudantes ON estudantes.nomeCompleto=certificados.estudanteId WHERE certificados.id = :id', ['id' => $id]);
        return view('certificado.show', compact('certificados'));
    }
    public function certificados()
    {
        return view ('certificado.certificadosV2');
    }

    public function gestorFiles()
    {
        $files = Files::all();
        return view('certificado.files', ['files' => $files]);
    }

}
