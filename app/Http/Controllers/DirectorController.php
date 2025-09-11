<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Files;
use PDF;

class DirectorController extends Controller
{
    //
    public function index()
    {
        return view("directordash");
    }

    public function getAllForUser()
    {
        // $allUserInfo = DB::select('SELECT e.* , c.*  FROM certificados c INNER JOIN estudantes e ON c.estudanteId = e.nomeCompleto 
        // INNER JOIN users u ON u.email = e.userId');
        // return view('director.studentscertificados', ['allUserInfo' => $allUserInfo]);
        return view('director.certificados');
    }

    public function getAllCertJuriV3(Request $request)
    {
        $qtdCertByJuriV2 = DB::select('SELECT count(c.estudanteId) as QTD FROM certificados c WHERE c.juri=:juri AND c.situacao = :situacao', ['juri'=>$request->juri,'situacao'=>$request->situacao]);
        return response()->json($qtdCertByJuriV2);
    }
    public function getAllCertJuriV33(Request $request)
    {
        $certificados = DB::select('SELECT certificados.id, certificados.estudanteId, certificados.portugues, certificados.ingles ,
        certificados.frances, certificados.filosolia, certificados.fisica, certificados.biologia,
        certificados.quimica, certificados.matematica, certificados.desenho, certificados.geografia
        , certificados.edfisica, certificados.historia, certificados.mediaFinal, certificados.juri, certificados.situacao, estudantes.contacto FROM certificados
        INNER JOIN estudantes ON estudantes.nomeCompleto=certificados.estudanteId WHERE certificados.juri = :juri AND certificados.situacao = :situacao order by certificados.estudanteId',
        ['juri'=>$request->juri,'situacao'=>$request->situacao]);
        return response()->json($certificados);
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

                    view()->share('director.studentscertificadodetails', $certificado);
                    $pdf = PDF::loadview('director.studentscertificadodetails', ['certificado'=>$certificado]);
                    return $pdf->setPaper('a4', 'portrait')->stream();
                }else
                {
                    return redirect()->route('retutnall')->with('error', 'Impossível visualizar o certificado do estudante...');
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
                    view()->share('director.studentscertificadodetails', $certificado);
                    $pdf = PDF::loadview('director.studentscertificadodetails', ['certificado'=>$certificado]);
                    return $pdf->setPaper('a4', 'portrait')->stream();
                }else
                {
                    return redirect()->route('retutnall')->with('error', 'Impossível visualizar o certificado do estudante...');
                }
                
                
            }
        }


    }

    public function viewPDFD($id)
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
                    return redirect()->route('retutnall')->with('error', 'Impossível visualizar o certificado do estudante...');
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
                    return redirect()->route('retutnall')->with('error', 'Impossível visualizar o certificado do estudante...');
                }
                
                
            }
        }

    }

    public function downloadPDF($id)
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
                    //PDF::setSignatureAppearance(150, 60, 15, 15);
                    
                    PDF::setSignatureAppearance(152, 250, 15, 15);

                    $image_file = 'img/baixados (2).png';
                    PDF::Image($image_file, 98, 0, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                    
                    // save pdf file
                    PDF::Output('Certificado - '.$getStuSeccao->estudanteId.'.pdf', 'D');
                    // view()->share('certificado.certificadodetails', $certificado);
                    // $pdf = PDF::writeHTML(view('certificado.certificadodetails', ['certificado'=>$certificado]));
                    // return $pdf->setPaper('a4', 'portrait')->stream();
                }else
                {
                    return redirect()->route('retutnall')->with('error', 'Impossível visualizar o certificado do estudante...');
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
                        PDF::Output('Certificado - '.$getStuSeccao->estudanteId.'.pdf', 'D');
                }else
                {
                    return redirect()->route('retutnall')->with('error', 'Impossível visualizar o certificado do estudante...');
                }
                
                
            }
        }


    }

    public function gestorFiles()
    {
        $files = Files::all();
        return view('director.files', ['files' => $files]);
    }

    public function create()
    {
        return view('director.createFile');
    }

    public function store(Request $request)
    {
        request()->validate([
            'title' => ['required','unique:files'],
            'arquivo' => ['required','mimes:pdf'],
        ],[
            'title.required' => 'O campo do título é obrigatório.',
            'title.unique' => 'O título fornecido já foi registado.',
            'arquivo.required' => 'É obrigatório escolher um arquivo.',
            'arquivo.mimes' => 'Só é permitido carregar arquivos no formato PDF.',
            
        ]);

        // for($i = 0; $i < count($request->asllFiles()['arquivo']); $i++)
        // {
        //     var_dump($i);
        // }
        $data = $request->all();
        if($request->arquivo->isValid())
        {
            //$nameFile = Str::of($request->titulo)->slug('-') . '.' .$request->pdf->getClientOriginalExtension();
            $nameFile = $request->arquivo->getClientOriginalName();
            //$file = $request->pdf->storeAs('files', $nameFile);
            $file = $request->arquivo->storeAs('certificados_assinados', $nameFile);
            $data['path'] = $file;
        }
        Files::create($data);
        return redirect()->route('files')
            ->with('success', 'Arquivo carregado com sucesso.');
        //$request->file('arquivo')->store('certificados_assinados');
    }

    public function deleteCertAssing($id)
    {
        if(!$files = Files::find($id))
        {
            return redirect()->back();
        }
        
        if(Storage::exists($files->arquivo))
        {
            Storage::delete($files->arquivo);
        }
        $files->delete();
        return response()->json(['status'=>'Estudante deleted successfully']);
    }

    public function edit($id)
    {
        $files = Files::find($id);
        return view('director.edit', compact('files'));
    }

    public function update(Request $request, $id)
    {
        if(!$files = Files::find($id))
        {
            return redirect()->back();
        }
        $id = $request->segment(4);
        request()->validate([
            'title' => ['required',"unique:files,title,{$id},id"],
            'arquivo' => ['required','mimes:pdf'],
        ],[
            'title.required' => 'O campo do título é obrigatório.',
            'title.unique' => 'O título fornecido já foi registado.',
            'arquivo.required' => 'É obrigatório escolher um arquivo.',
            'arquivo.mimes' => 'Só é permitido carregar arquivos no formato PDF.',
            
        ]);

        $data = $request->all();
        if($request->arquivo->isValid())
        {
            if(Storage::exists($files->arquivo))
            {
                Storage::delete($files->arquivo);
            }
            $nameFile = $request->arquivo->getClientOriginalName();
            $file = $request->arquivo->storeAs('certificados_assinados', $nameFile);
            $data['path'] = $file;
        }
        $files->update($data);
        return redirect()->route('files')
            ->with('success1', 'Arquivo carregado com sucesso.');
        
    }
}
