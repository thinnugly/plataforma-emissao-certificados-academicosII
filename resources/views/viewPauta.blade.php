<div class="container">
        Ministério da Educação&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Exames nacionais do ensino secundário 2022 - pauta final
        <hr>
        <P>ESCOLA SECUNDÁRIA GWAZA MUTHINI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;12ª Classe</P>
        <table border="1" cellpapping="10" width="100%" style="margin-bottom: 100px;">
            <tr>
                <th width="10%">Aluno</th>
                <th>Port</th>
                <th>Ing</th>
                <th>Fra</th>
                <th>Fil</th>
                <th>Fís</th>
                <th>Bio</th>
                <th>Qu</th>
                <th>Mat</th>
                <th>Geo</th>
                <th>Ed. Fís</th>
                <th>H</th>
                <th>Méd</th>
                <th>Situaç</th>
            </tr>
        @foreach($getAllCertByJuri as $pauta)
            <tr>
                <td>{{ $pauta->estudanteId}}</td>
                <td>{{ $pauta->portugues }}</td>
                <td>{{ $pauta->ingles }}</td>
                <td>{{ $pauta->frances}}</td>
                <td>{{ $pauta->filosolia }}</td>
                <td>{{ $pauta->fisica }}</td>
                <td>{{ $pauta->biologia}}</td>
                <td>{{ $pauta->quimica }}</td>
                <td>{{ $pauta->matematica }}</td>
                <td>{{ $pauta->geografia }}</td>
                <td>{{ $pauta->edfisica }}</td>
                <td>{{ $pauta->historia }}</td>
                <td>{{ $pauta->mediaFinal}}</td>
                <td>{{ $pauta->situacao }}</td>
            </tr>
        @endforeach
    </table>
        
</div>

