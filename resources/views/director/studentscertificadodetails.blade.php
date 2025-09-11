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
    </style>
</head>
<body>
    <center>
        <img src="{{ public_path('img/baixados (2).png') }}" alt="Recurso não encontrado..." width="10%"><br>
        <div style="margin-top:25px;">
            REPÚBLICA DE MOÇAMBIQUE
        </div>
        <div style="margin-top:8px;">
            GOVERNO DA CIDADE DE MAPUTO
        </div>
        <div style="margin-top:8px;">
            <span style="font-weight:bold">ESCOLA SUCUNDÁRIA GWAZA MUTHINE</span>
        </div>
        <div style="margin-top:8px;">
            <span style="font-weight:bold; font-size:20px;">CERTIDÃO</span>
        </div>
    </center><br><br>
    @foreach($certificado as $certificado)
        @if($certificado->contacto == "Ciências Naturas (Opção B)")
            <p class="big">ESPERANÇA ISABEL MUIAMBO Chefe de Secretaria de Escola Secundária Gwaza Muthine, em Maputo, CERTIFICO,
                em cumprimento de despacho exarado em requerimento que fica arquivado nesta secretaria que
                        <span style="color:red">{{$certificado->nomeCompleto}}</span>, do sexo {{$certificado->Sexo}}, natural de {{$certificado->naturalidade}}, filho de {{$certificado->nomePai}}
                    e de {{$certificado->nomeMae}} concluiu nesta Escola como aluno Interno em {{$certificado->created_at}}, o exame das disciplinas da {{$certificado->classe}}
                        que constituem a <span style="color:red">secção de {{$certificado->contacto}}</span> e o obteve os resultados finais seguintes:</p>
            <br>
            <table>
                <tr>
                    <td style="width:100px;">Português</td>
                    <td style="width:100px;">{{$certificado->portugues}}</td>
                    <td style="width:100px;">Valores</td>
                    <td style="width:100px;">Matemática</td>
                    <td style="width:100px;">{{$certificado->matematica}}</td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:100px;">Inglês</td>
                    <td style="width:100px;">{{$certificado->ingles}}</td>
                    <td style="width:100px;">Valores</td>
                    <td style="width:150px;">Des. e Geo. Desc.</td>
                    <td style="width:100px;"></td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:100px;">Filosofia</td>
                    <td style="width:100px;">{{$certificado->filosolia}}</td>
                    <td style="width:100px;">Valores</td>
                    <td style="width:150px;">Geografia</td>
                    <td style="width:100px;"></td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:100px;">Física</td>
                    <td style="width:100px;">{{$certificado->fisica}}</td>
                    <td style="width:100px;">Valores</td>
                    <td style="width:150px;">Ed. Visual.</td>
                    <td style="width:100px;"></td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:100px;">Biologia</td>
                    <td style="width:100px;">{{$certificado->biologia}}</td>
                    <td style="width:100px;">Valores</td>
                    <td style="width:100px;">Ed. Física</td>
                    <td style="width:100px;">{{$certificado->edfisica}}</td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:100px;">Química</td>
                    <td style="width:100px;">{{$certificado->quimica}}</td>
                    <td style="width:100px;">Valores</td>
                    <td style="width:100px;">História</td>
                    <td style="width:100px;"></td>
                    <td>Valores</td>
                </tr>
            </table>
            <br>
            <p>MÉDIA GERAL <span style="color:red">{{$certificado->mediaFinal}} Valores</span></p><br>
            <p>Os resultados constam da pauta nº 999 e do livro de Termo de Exames nº 999/2022, júri 50, nº do aluno 999.<br>
        E por ser verdade passo a presente Certidão que assino e autentico com o carimbo a tinta de oléo / selo branco 
    em uso neste Estabelecimento de Ensino, em Maputo, {{$certificado->created_at}}.</p><br>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A Chefe de Secretaria
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;O Director da Escola <br>
___________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___________________________________</p>
        @else
            <p class="big">ESPERANÇA ISABEL MUIAMBO Chefe de Secretaria de Escola Secundária Gwaza Muthine, em Maputo, CERTIFICO,
                em cumprimento de despacho exarado em requerimento que fica arquivado nesta secretaria que
                        <span style="color:red">{{$certificado->nomeCompleto}}</span>, do sexo {{$certificado->Sexo}}, natural de {{$certificado->naturalidade}}, filho de {{$certificado->nomePai}}
                    e de {{$certificado->nomeMae}} concluiu nesta Escola como aluno Interno em {{$certificado->created_at}}, o exame das disciplinas da {{$certificado->classe}}
                        que constituem a <span style="color:red">secção de {{$certificado->contacto}}</span> e o obteve os resultados finais seguintes:</p>
            <br>
            <table>
                <tr>
                    <td style="width:100px;">Português</td>
                    <td style="width:100px;">{{$certificado->portugues}}</td>
                    <td style="width:100px;">Valores</td>
                    <td style="width:100px;">Matemática</td>
                    <td style="width:100px;">{{$certificado->matematica}}</td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:100px;">Inglês</td>
                    <td style="width:100px;">{{$certificado->ingles}}</td>
                    <td style="width:100px;">Valores</td>
                    <td style="width:150px;">Des. e Geo. Desc.</td>
                    <td style="width:100px;"></td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:100px;">Francês</td>
                    <td style="width:100px;">{{$certificado->frances}}</td>
                    <td style="width:100px;">Valores</td>
                    <td style="width:150px;">Geografia</td>
                    <td style="width:100px;">{{$certificado->geografia}}</td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:100px;">Física</td>
                    <td style="width:100px;"></td>
                    <td style="width:100px;">Valores</td>
                    <td style="width:150px;">Ed. Visual.</td>
                    <td style="width:100px;"></td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:100px;">Biologia</td>
                    <td style="width:100px;"></td>
                    <td style="width:100px;">Valores</td>
                    <td style="width:100px;">Ed. Física</td>
                    <td style="width:100px;">{{$certificado->edfisica}}</td>
                    <td>Valores</td>
                </tr>
                <tr>
                    <td style="width:100px;">Química</td>
                    <td style="width:100px;"></td>
                    <td style="width:100px;">Valores</td>
                    <td style="width:100px;">História</td>
                    <td style="width:100px;">{{$certificado->historia}}</td>
                    <td>Valores</td>
                </tr>
            </table>
            <br>
            <p>MÉDIA GERAL <span style="color:red">{{$certificado->mediaFinal}} Valores</span></p><br>
            <p>Os resultados constam da pauta nº 888 e do livro de Termo de Exames nº 888/2022, júri 59, nº do aluno 888i.<br>
        E por ser verdade passo a presente Certidão que assino e autentico com o carimbo a tinta de oléo / selo branco 
    em uso neste Estabelecimento de Ensino, em Maputo, {{$certificado->created_at}}.</p><br>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A Chefe de Secretaria
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;O Director da Escola <br>
___________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___________________________________</p>
        @endif
    @endforeach
</body>
</html>
