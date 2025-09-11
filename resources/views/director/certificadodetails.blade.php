<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalhes do Certificado</title>
    <style type="text/css">
       p{
            font-style:italic;
            text-align:justify;
            line-height: 1.8;
            padding-left: 8px;
            padding-right: 8px;
        }
        /* p.big{
            line-height: 1.8;

        } */
        table{
            font-style:italic;
        }
        img {
        width: 80%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
        <!-- <center>
            <img src="img/baixados (2).png"  rigth="50%" alt="Recurso não encontrado..." width="400%">
        </center> -->
        <br><br><br>
        <div style="text-align:center;margin-rigth:100px;">
            REPÚBLICA DE MOÇAMBIQUE
        </div>
        <div style="text-align:center">
            GOVERNO DO DISTRITO DE MARRACUENE
        </div>
        <div style="text-align:center">
           ESCOLA SUCUNDÁRIA GWAZA MUTHINI
        </div>
        <div style="text-align:center">
            Certificado de Habilitações Literárias
        </div>
    
    @foreach($certificado as $certificado)
        @if($certificado->contacto == "Ciências Naturas (Opção B)")
            <p class="big">ESPERANÇA ISABEL MUIAMBO Chefe de Secretaria de Escola Secundária Gwaza Muthini, em Maputo, CERTIFICO,
                em cumprimento de despacho exarado em requerimento que fica arquivado nesta secretaria que
                        <span style="color:red">{{$certificado->nomeCompleto}}</span>, do sexo {{$certificado->Sexo}}, natural de {{$certificado->naturalidade}}, filho de {{$certificado->nomePai}}
                    e de {{$certificado->nomeMae}} concluiu nesta Escola como aluno Interno em {{$certificado->created_at}}, o exame das disciplinas da {{$certificado->classe}}
                        que constituem a <span style="color:red">secção de {{$certificado->contacto}}</span> e o obteve os resultados finais seguintes:</p>
            <table>
                <tr>
                    <td style="width:80;">Português</td>
                    <td style="width:80;">{{$certificado->portugues}}</td>
                    <td style="width:80;">Valores</td>
                    <td style="width:120;">Matemática</td>
                    <td style="width:80;">{{$certificado->matematica}}</td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:80;">Inglês</td>
                    <td style="width:80;">{{$certificado->ingles}}</td>
                    <td style="width:80;">Valores</td>
                    <td style="width:120;">Des. e Geo. Desc.</td>
                    <td style="width:80;"></td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:80;">Filosofia</td>
                    <td style="width:80;">{{$certificado->filosolia}}</td>
                    <td style="width:80;">Valores</td>
                    <td style="width:120;">Geografia</td>
                    <td style="width:80;"></td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:80;">Física</td>
                    <td style="width:80;">{{$certificado->fisica}}</td>
                    <td style="width:80;">Valores</td>
                    <td style="width:120;">Ed. Visual.</td>
                    <td style="width:80;"></td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:80;">Biologia</td>
                    <td style="width:80;">{{$certificado->biologia}}</td>
                    <td style="width:80;">Valores</td>
                    <td style="width:120;">Ed. Física</td>
                    <td style="width:80;">{{$certificado->edfisica}}</td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:80;">Química</td>
                    <td style="width:80;">{{$certificado->quimica}}</td>
                    <td style="width:80;">Valores</td>
                    <td style="width:120;">História</td>
                    <td style="width:80;"></td>
                    <td>Valores</td>
                </tr>
            </table>
            <p>MÉDIA GERAL <span style="color:red">{{$certificado->mediaFinal}} Valores</span></p>
            <p>Os resultados constam da pauta nº 999 e do livro de Termo de Exames nº {{$certificado->id}}/2022, júri {{$certificado->juri}}, nº do aluno {{$certificado->studId}}.<br>
        E por ser verdade passo a presente Certidão que assino e autentico com o carimbo a tinta de oléo / selo branco 
    em uso neste Estabelecimento de Ensino, em Maputo, {{$certificado->created_at}}.</p><br>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;O Director da Escola <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        @else
            <p class="big">ESPERANÇA ISABEL MUIAMBO Chefe de Secretaria de Escola Secundária Gwaza Muthini, em Maputo, CERTIFICO,
                em cumprimento de despacho exarado em requerimento que fica arquivado nesta secretaria que
                        <span style="color:red">{{$certificado->nomeCompleto}}</span>, do sexo {{$certificado->Sexo}}, natural de {{$certificado->naturalidade}}, filho de {{$certificado->nomePai}}
                    e de {{$certificado->nomeMae}} concluiu nesta Escola como aluno Interno em {{$certificado->created_at}}, o exame das disciplinas da {{$certificado->classe}}
                        que constituem a <span style="color:red">secção de {{$certificado->contacto}}</span> e o obteve os resultados finais seguintes:</p>
            <br>
            <table>
                <tr>
                    <td style="width:80px;">Português</td>
                    <td style="width:80px;">{{$certificado->portugues}}</td>
                    <td style="width:80px;">Valores</td>
                    <td style="width:120px;">Matemática</td>
                    <td style="width:80px;">{{$certificado->matematica}}</td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:80px;">Inglês</td>
                    <td style="width:80px;">{{$certificado->ingles}}</td>
                    <td style="width:80px;">Valores</td>
                    <td style="width:120px;">Des. e Geo. Desc.</td>
                    <td style="width:80px;"></td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:80px;">Francês</td>
                    <td style="width:80px;">{{$certificado->frances}}</td>
                    <td style="width:80px;">Valores</td>
                    <td style="width:120px;">Geografia</td>
                    <td style="width:80px;">{{$certificado->geografia}}</td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:80px;">Física</td>
                    <td style="width:80px;"></td>
                    <td style="width:80px;">Valores</td>
                    <td style="width:120px;">Ed. Visual.</td>
                    <td style="width:80px;"></td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:80px;">Biologia</td>
                    <td style="width:80px;"></td>
                    <td style="width:80px;">Valores</td>
                    <td style="width:120px;">Ed. Física</td>
                    <td style="width:80px;">{{$certificado->edfisica}}</td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:80px;">Química</td>
                    <td style="width:80px;"></td>
                    <td style="width:80px;">Valores</td>
                    <td style="width:120px;">História</td>
                    <td style="width:80px;">{{$certificado->historia}}</td>
                    <td>Valores</td>
                </tr>
            </table>
            <p>MÉDIA GERAL <span style="color:red">{{$certificado->mediaFinal}} Valores</span></p>
            <p>Os resultados constam da pauta nº 999 e do livro de Termo de Exames nº {{$certificado->id}}/2022, júri {{$certificado->juri}}, nº do aluno {{$certificado->studId}}.<br>
        E por ser verdade passo a presente Certidão que assino e autentico com o carimbo a tinta de oléo / selo branco 
    em uso neste Estabelecimento de Ensino, em Maputo, {{$certificado->created_at}}.</p><br>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;O Director da Escola <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        @endif
    @endforeach
</body>
</html>
