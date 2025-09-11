<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row mb-4">
        <div class="col-md-2">
                Items por página:
                <select wire:model="perPage" class="form-control">
                    <option>5</option>
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                    <option>25</option>
                </select>
        </div>
        <div class="col-md-4">
                Júri:
                <select id="juriV2" class="form-control getJuri @error('juriV2') is-invalid @enderror" name="juri" value="{{ old('juriV2') }}">
                    <option value="0" selected disabled>Selecione o júri</option>
                    <option value="50">50</option>
                    <option value="51">51</option>
                    <option value="52">52</option>
                    <option value="53">53</option>
                    <option value="54">54</option>
                </select>
            </div>
        <div class="col-md-6" style="margin-top: 23px;">
            <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Pesquise o certificado....">
        </div> 
    </div>
    <div class="row">
        <div class="col" id="info" style="margin-left: 8px;"></div>
        <div class="col" id="getPauta">
            
        </div>
    </div>  
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover" >
            <thead>
            <tr>
                <th>Nome do aluno&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Júri&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Portugues&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Inglês&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Francês&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Filosolia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Física&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Biologia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Química&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Matemática&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Desenho&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Geografia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Ed. Física&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>História&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Média final&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Situação&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>Acção&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            </tr>
            </thead>
            <tbody id="tcorpo">
            @foreach ($certificados as $certificado)
               @if($certificado->situacao == "Aprovado")
                    <tr>
                        <td>{{$certificado->estudanteId}}</td>
                        <td>{{$certificado->juri}}</td>
                        <td>{{$certificado->portugues}}</td>
                        <td>{{$certificado->ingles}}</td>
                        <td>{{$certificado->frances}}</td>
                        <td>{{$certificado->filosolia}}</td>
                        <td>{{$certificado->fisica}}</td>
                        <td>{{$certificado->biologia}}</td>
                        <td>{{$certificado->quimica}}</td>
                        <td>{{$certificado->matematica}}</td>
                        <td></td>
                        <td>{{$certificado->geografia}}</td>
                        <td>{{$certificado->edfisica}}</td>
                        <td>{{$certificado->historia}}</td>
                        <td>{{$certificado->mediaFinal}}</td>
                        <td>{{$certificado->situacao}}</td>
                        <td>
                            <a class="btn btn-sm btn-primary edit" id="{{$certificado->status}}" href="{{ route('createStuCertD',$certificado->id) }}'"><i class="fa fa-fw fa-eye"></i></a>
                            <a class="btn btn-sm btn-success" id="{{$certificado->status}}" href="{{ route('downloadStuCertD',$certificado->id) }}'"><i class="fa fa-fw fa-download"></i></a>
                        </td>
                    </tr>
               @endif
            @endforeach
            
            </tbody>
        </table>
        <div>
            <p>
                {{ $certificados->links('vendor.pagination.pagination-links')}}
            </p>
        </div>
    </div>
    <script src="{{asset('site/jquery.js')}}"></script>
    <script type="text/javascript">
        
        $(document).ready(function (){

            $(document).on('change','#juriV2', function (){
                getCertJuri = $(this).val();
                var getSituacao = "Aprovado";

                $('#tcorpo').html("");
                $('#info').html("");
                $('#getPauta').html("");
                $('#tcorpo').html("");$('#info').html("");

                var data = 
                    {
                        'juri':getCertJuri,
                        'situacao': getSituacao,
                    }
                $.ajax({
                    type: 'get',
                    url: '{!! URL::to('getAllCertJuriV3') !!}',
                    data: data,
                    success: function(qtdCertByJuriV2)
                    {
                        for(var i = 0; i<qtdCertByJuriV2.length; i++)
                        {
                            $('#info').append(
                                '<strong>\
                                    Este júri possui '+qtdCertByJuriV2[i].QTD+' certificados (s) registados (s)!\
                                </strong>'
                            );
                        }
                        $.ajax({
                            type: 'get',
                            url: '{!! URL::to('getAllCertJuriV33') !!}',
                            data: data,
                            success: function(certificados)
                            {
                                for(var i = 0; i<certificados.length; i++)
                                {
                                    if(certificados[i].contacto == "Ciências Naturas (Opção B)")
                                {
                                    $('#tcorpo').append(
                                    '<tr>\
                                        <input type="hidden" class="serdelete_val_id" value="'+certificados[i].id+'">\
                                        <td>'+certificados[i].estudanteId+'</td>\
                                        <td>'+certificados[i].juri+'</td>\
                                        <td>'+certificados[i].portugues+'</td>\
                                        <td>'+certificados[i].ingles+'</td>\
                                        <td></td>\
                                        <td>'+certificados[i].filosolia+'</td>\
                                        <td>'+certificados[i].fisica+'</td>\
                                        <td>'+certificados[i].biologia+'</td>\
                                        <td>'+certificados[i].quimica+'</td>\
                                        <td>'+certificados[i].matematica+'</td>\
                                        <td></td>\
                                        <td></td>\
                                        <td>'+certificados[i].edfisica+'</td>\
                                        <td></td>\
                                        <td>'+certificados[i].mediaFinal+'</td>\
                                        <td>'+certificados[i].situacao+'</td>\
                                        <td>\
                                            <a class="btn btn-sm btn-primary" href="/director/certificados/viewpdff/'+certificados[i].id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                            <a class="btn btn-sm btn-success" href="/director/certificados/downloadpdf/'+certificados[i].id+'"><i class="fa fa-fw fa-download"></i></a>\
                                        </td>\
                                    </tr>'
                                    );
                                }else
                                {
                                    $('#tcorpo').append(
                                    '<tr>\
                                        <input type="hidden" class="serdelete_val_id" value="'+certificados[i].id+'">\
                                        <td>'+certificados[i].estudanteId+'</td>\
                                        <td>'+certificados[i].juri+'</td>\
                                        <td>'+certificados[i].portugues+'</td>\
                                        <td>'+certificados[i].ingles+'</td>\
                                        <td>'+certificados[i].frances+'</td>\
                                        <td></td>\
                                        <td></td>\
                                        <td></td>\
                                        <td></td>\
                                        <td>'+certificados[i].matematica+'</td>\
                                        <td></td>\
                                        <td>'+certificados[i].geografia+'</td>\
                                        <td>'+certificados[i].edfisica+'</td>\
                                        <td>'+certificados[i].historia+'</td>\
                                        <td>'+certificados[i].mediaFinal+'</td>\
                                        <td>'+certificados[i].situacao+'</td>\
                                        <td>\
                                            <a class="btn btn-sm btn-primary" href="/director/certificados/viewpdff/'+certificados[i].id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                            <a class="btn btn-sm btn-success" href="/director/certificados/downloadpdf/'+certificados[i].id+'"><i class="fa fa-fw fa-download"></i></a>\
                                        </td>\
                                    </tr>'
                                    );
                                }
                                }
                            }
                        });
                    }
                });
            });

        });
    </script>
</div>
