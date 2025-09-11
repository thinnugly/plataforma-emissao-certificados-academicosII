<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="modal fade" id="editCertificado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar registos do exame</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="body"></div>
                    <input type="hidden" id="getCertId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-fw fa-close"></i> Fechar</button>
                    <button type="button" class="btn btn-success save"><i class="fa fa-fw fa-save"></i> Salvar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="showSuccMessage"></div>
    <div id="showErrMessage" class="text-center"></div>
    <div id="putError"></div>
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
                <select id="juri" class="form-control getJuri @error('juri') is-invalid @enderror" name="juri" value="{{ old('juri') }}">
                    <option value="0" selected disabled>Selecione o júri</option>
                    <option value="50">50</option>
                    <option value="51">51</option>
                    <option value="52">52</option>
                    <option value="53">53</option>
                    <option value="54">54</option>
                </select>
            </div>
        <div class="col-md-6" style="margin-top: 23px;">
            <form action="{{ route('usuarios') }}" method="GET">
                <input name="search" type="text" class="form-control amount4" placeholder="Pesquise o exame....">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col" id="info" style="margin-left: 8px;"></div>
        <div class="col" id="getPauta">
            <!-- <a class="btn btn-sm btn-primary imprimir"><i class="fa fa-fw fa-eye"></i> Visualizar à pauta</a> -->
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
                <th>Acção&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            </tr>
            </thead>
            <tbody id="tcorpo">
                
            </tbody>
        </table>
        <div>
            <p>
                {{ $certificados->links('pagination-links')}}
            </p>
        </div>
    </div>
    <script src="{{asset('site/jquery.js')}}"></script>
    <script type="text/javascript">
        
        $(document).ready(function (){
            $(document).on('change','#juri', function (){
                getCertJuri = $(this).val();
                $('#tcorpo').html("");
                $('#info').html("");
                $('#getPauta').html("");
                $.ajax({
                    type: 'get',
                    url: '{!! URL::to('getCertQTDByJuri') !!}',
                    data: {'juri':getCertJuri},
                    success: function (qtdCertByJuri){
                        for(var i=0; i<qtdCertByJuri.length; i++)
                        {
                            // if(qtdCertByJuri[i].QTD == 0)
                            // {
                            //     $('#info').append(
                            //     '<strong>\
                            //         Este júri possui '+qtdCertByJuri[i].QTD+' aluno (s) inscrito (s)!\
                            //     </strong>'
                            //     ); 
                            // }
                            // else
                            // {
                            //     $('#info').append(
                            //         '<strong>\
                            //             Este júri possui '+qtdCertByJuri[i].QTD+' aluno (s) inscrito (s)!\
                            //         </strong>'
                            //     );
                            //     $('#getPauta').append(
                            //         '<a class="btn btn-sm btn-primary imprimir" href="/office/certificados/viewpauta/' + getCertJuri + '"><i class="fa fa-fw fa-eye"></i> Visualizar à pauta</a>'
                            //     );
                            // }
                                $('#info').append(
                                    '<strong>\
                                        Este júri possui '+qtdCertByJuri[i].QTD+' aluno (s) inscrito (s)!\
                                    </strong>'
                                );
                                $('#getPauta').append(
                                    '<a class="btn btn-sm btn-primary imprimir" href="/office/certificados/viewpauta/' + getCertJuri + '"><i class="fa fa-fw fa-eye"></i> Visualizar à pauta</a>'
                                );
                            
                            
                            
                        }
                        $.ajax({
                        type: 'get',
                        url: '{!! URL::to('getAllCertJuri') !!}',
                        data: {'juri':getCertJuri},
                        success: function (certificados){
                            for(var i=0; i<certificados.length; i++)
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
                                            <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+certificados[i].id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                            <a class="btn btn-sm btn-success edit" id="'+certificados[i].id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                            <button type="submit" class="btn btn-danger btn-sm delete" id="'+certificados[i].id+'"><i class="fa fa-fw fa-trash"></i></button>\
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
                                            <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+certificados[i].id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                            <a class="btn btn-sm btn-success edit" id="'+certificados[i].id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                            <button type="submit" class="btn btn-danger btn-sm delete" id="'+certificados[i].id+'"><i class="fa fa-fw fa-trash"></i></button>\
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

            $(document).on('click', '.delete', function(){
                let getIdDel = $(this).attr("id");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                Swal.fire({
                    title: 'Você tem certeza?',
                    text: "Você não poderá reverter esta acção!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Sim, eliminar este item!',
                }).then((result) => {
                    if (result.isConfirmed) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": getIdDel,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: '/office/certificados/delete/'+getIdDel,
                            data: "data",
                            success: function (response){
                                Swal.fire(
                                    'Eliminado!',
                                    'Certificado eliminado com sucesso....',
                                    'success'
                                ).then((result) => {
                                        location.reload();
                                    });
                            }
                        });

                    }
                })
            });

            $(document).on('click', '.edit', function(){
                let getIdActua = $(this).attr("id");
                $('#getCertId').val(getIdActua);
                // alert(getIdActua);
                $.ajax({
                    type: 'get',
                    url: '{!! URL::to('/office/certificados/getStuSeccaoByCertId') !!}',
                    data: {'id':getIdActua},
                    success: function(studCertSessao){
                        for (let index = 0; index < studCertSessao.length; index++) {
                            // console.log(studCertSessao[index].contacto);
                            // $('#getCertId').val(studCertSessao[index].contacto);
                            if(studCertSessao[index].contacto == "Ciências Naturas (Opção B)")
                            {
                                //console.log("Ciencias");
                                $('#body').html("");
                                $('#body').append(
                                    '<div class="row">\
                                        <div class="col-md-6">\
                                            <label for="estudanteId ">Nome do estudante</label>\
                                            <div class="input-control"><input id="estudanteId" type="text" readonly class="estudanteId form-control" value="'+studCertSessao[index].nomeCompleto+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                        <div class="col-md-3">\
                                            <label for="juri">Júri</label>\
                                            <td><div class="input-control"><select id="selectStuJuri" class="form-control" name="juri"><option value="'+studCertSessao[index].juri+'" selected>'+studCertSessao[index].juri+'</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option></select><span class="invalid-feedback"><strong class="error"></strong><span></div></td>\
                                        </div>\
                                        <div class="col-md-3">\
                                            <label for="portugues ">Português</label>\
                                            <div class="input-control"><input id="portugues" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="portugues form-control amount2" value="'+studCertSessao[index].portugues+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                    </div>\
                                    <div class="row" style="margin-top: 10px;">\
                                        <div class="col-md-3">\
                                            <label for="ingles ">Inglês</label>\
                                            <div class="input-control"><input id="ingles" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="ingles form-control amount2" value="'+studCertSessao[index].ingles+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                        <div class="col-md-3">\
                                            <label for="filosolia ">Filosofia</label>\
                                            <div class="input-control"><input id="filosolia" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="filosolia form-control amount2" value="'+studCertSessao[index].filosolia+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                        <div class="col-md-3">\
                                            <label for="fisica ">Física</label>\
                                            <div class="input-control"><input id="fisica" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="fisica form-control amount2" value="'+studCertSessao[index].fisica+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                        <div class="col-md-3">\
                                            <label for="biologia ">Biológia</label>\
                                            <div class="input-control"><input id="biologia" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="biologia form-control amount2" value="'+studCertSessao[index].biologia+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                    </div>\
                                    <div class="row" style="margin-top: 10px;">\
                                        <div class="col-md-3">\
                                            <label for="quimica ">Química</label>\
                                            <div class="input-control"><input id="quimica" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="quimica form-control amount2" value="'+studCertSessao[index].quimica+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                        <div class="col-md-3">\
                                            <label for="matematica ">Matemática</label>\
                                            <div class="input-control"><input id="matematica" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="matematica form-control amount2" value="'+studCertSessao[index].matematica+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                        <div class="col-md-6">\
                                            <label for="edfisica ">Educação física</label>\
                                            <div class="input-control"><input id="edfisica" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="edfisica form-control amount2" value="'+studCertSessao[index].edfisica+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                    </div>\
                                    <div class="row" style="margin-top: 10px;">\
                                        <div class="col-md-6">\
                                            <label for="mediaFinal ">Média final</label>\
                                            <div class="input-control"><input id="mediaFinal" type="text" readonly class="mediaFinal form-control" value="'+studCertSessao[index].mediaFinal+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                        <div class="col-md-6">\
                                            <label for="situacao ">Situação</label>\
                                            <div class="input-control"><input id="situacao" type="text" readonly class="mediaFinal form-control" value="'+studCertSessao[index].situacao+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                    </div>');
                                    $(function()
                                            {
                                                var total_amount2 = function(){

                                                    var soma = 0;
                                                    var precisaoN = 0;
                                                    $('.amount2').each(function(){
                                                        var num = $(this).val();

                                                        if(num != 0)
                                                        {
                                                            soma += parseFloat(num)/8;
                                                            precisaoN = soma.toFixed();
                                                        }

                                                    });
                                                    $('#mediaFinal').val("");
                                                    $('#mediaFinal').val(precisaoN);
                                                    let mediaFinal = $('#mediaFinal').val();
                                                    if(mediaFinal >= 10)
                                                    {
                                                        $('#situacao').val("");
                                                        $('#situacao').val("Aprovado");
                                                        console.log("Aprovado")
                                                    }else
                                                    {
                                                        $('#situacao').val("");
                                                        $('#situacao').val("Reprovado");
                                                        console.log("Reprovado")
                                                    }

                                                }

                                                $('.amount2').keyup(function (){
                                                    total_amount2();
                                                });
                                            });


                            }else
                            {
                                //console.log("Letras");
                                $('#body').html("");
                                $('#body').append(
                                    '<div class="row">\
                                        <div class="col-md-6">\
                                            <label for="estudanteId ">Nome do estudante</label>\
                                            <div class="input-control"><input id="estudanteId" type="text" readonly class="estudanteId form-control" value="'+studCertSessao[index].nomeCompleto+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                        <div class="col-md-3">\
                                            <label for="juri">Júri</label>\
                                            <td><div class="input-control"><select id="selectStuJuri" class="form-control" name="juri"><option value="'+studCertSessao[index].juri+'" selected>'+studCertSessao[index].juri+'</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option></select><span class="invalid-feedback"><strong class="error"></strong><span></div></td>\
                                        </div>\
                                        <div class="col-md-3">\
                                            <label for="portugues ">Português</label>\
                                            <div class="input-control"><input id="portugues" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="portugues form-control amount2" value="'+studCertSessao[index].portugues+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                    </div>\
                                    <div class="row" style="margin-top: 10px;">\
                                        <div class="col-md-3">\
                                            <label for="ingles ">Inglês</label>\
                                            <div class="input-control"><input id="ingles" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="ingles form-control amount2" value="'+studCertSessao[index].ingles+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                        <div class="col-md-3">\
                                            <label for="frances ">Francês</label>\
                                            <div class="input-control"><input id="frances" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="frances form-control amount3" value="'+studCertSessao[index].frances+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                        <div class="col-md-6">\
                                            <label for="matematica ">Matemática</label>\
                                            <div class="input-control"><input id="matematica" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="matematica form-control amount3" value="'+studCertSessao[index].matematica+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                    </div>\
                                    <div class="row" style="margin-top: 10px;">\
                                        <div class="col-md-6">\
                                            <label for="edfisica ">Educação física</label>\
                                            <div class="input-control"><input id="edfisica" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="edfisica form-control amount3" value="'+studCertSessao[index].edfisica+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                        <div class="col-md-3">\
                                            <label for="geografia ">Geográfia</label>\
                                            <div class="input-control"><input id="geografia" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="geografia form-control amount3" value="'+studCertSessao[index].geografia+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                        <div class="col-md-3">\
                                            <label for="historia ">Historia</label>\
                                            <div class="input-control"><input id="historia" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="historia form-control amount3" value="'+studCertSessao[index].historia+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                    </div>\
                                    <div class="row" style="margin-top: 10px;">\
                                        <div class="col-md-6">\
                                            <label for="mediaFinal ">Média final</label>\
                                            <div class="input-control"><input id="mediaFinal" type="text" readonly class="mediaFinal form-control" value="'+studCertSessao[index].mediaFinal+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                        <div class="col-md-6">\
                                            <label for="situacao ">Situação</label>\
                                            <div class="input-control"><input id="situacao" type="text" readonly class="mediaFinal form-control" value="'+studCertSessao[index].situacao+'"/><span class="invalid-feedback error"><strong class="error"></strong><span></div>\
                                        </div>\
                                    </div>');
                                    $(function()
                                            {
                                                var total_amount3 = function(){

                                                    var soma = 0;
                                                    var precisao = 0;
                                                    $('.amount3').each(function(){
                                                        var num = $(this).val();

                                                        if(num != 0)
                                                        {
                                                            soma += parseFloat(num)/7;
                                                            precisao = soma.toFixed();
                                                        }
                                                        //console.log('Consegui.....');
                                                    });
                                                    $('#mediaFinal').val("");
                                                    $('#mediaFinal').val(precisao);
                                                    //console.log(precisao);
                                                    let mediaFinal = $('#mediaFinal').val();
                                                    if(mediaFinal >= 10)
                                                    {
                                                        $('#situacao').val("");
                                                        $('#situacao').val("Aprovado");
                                                        console.log("Aprovado")
                                                    }else
                                                    {
                                                        $('#situacao').val("");
                                                        $('#situacao').val("Reprovado");
                                                        console.log("Reprovado")
                                                    }
                                                }

                                                $('.amount3').keyup(function (){
                                                    total_amount3();
                                                });

                                            });

                            }

                        }

                    }
                });
                $('#editCertificado').modal('show');



            });
        });
    </script>
</div>
