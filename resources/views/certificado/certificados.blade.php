@extends('layouts.app')

@section('template_title')
    Certificado
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('main')
            </div>
            <div class="col-sm-9" style="margin-top: 10px; margin-left: 20px;">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Exame') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('allCerts') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    <i class="fa fa-fw fa-refresh"></i> {{ __('Actualizar à página') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))

                    @endif


                    <div class="card-body">
                        @livewire('certificados')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('site/jquery.js')}}"></script>
    <script src="{{asset('site/bootstrap.js')}}"></script>
    <script src="{{asset('validation/validation.js')}}"></script>
    <script type="text/javascript">
        let html = '';
        let getStuN;
        
        $(document).ready(function(){
            $('#showSuccMessage').html(""); $('#showErrMessage').hide();
            let tbl_row = $(this).closest('tr');
            tbl_row.find('#view').hide();

            @if ($message = Session::get('error'))
            Swal.fire({
                    title: 'Oooops....!',
                    text: "Impossível processar o certificado do estudante, sua média final é inferior a 10 Valores.",
                    icon: 'error',
                    //showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    //: '#d33',
                    confirmButtonText: 'OK'
                })
            @endif
            @if ($message = Session::get('error1'))
            Swal.fire({
                    title: 'Oooops....!',
                    text: "Este júri possui 0 aluno (s) inscrito (s)!",
                    icon: 'error',
                    //showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    //: '#d33',
                    confirmButtonText: 'OK'
                })
            @endif

            //Buscando todo o conteudo do Banco
            fetchData();
            function fetchData()
            {
                $.ajax({
                    type: "GET",
                    url: "/office/certificados/fetchData",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html("");
                        getStuName();
                        function getStuName()
                            {
                                var op = "";
                                $.ajax({
                                    type: 'get',
                                    url: '{!! URL::to('/office/certificados/getStuName') !!}',
                                    dataType: "json",
                                    success: function (data){
                                        op+='<option value="0" selected disabled>Selecione o estudante</option>';
                                        for(var i=0; i<data.length; i++){
                                            op+='<option value="'+data[i].nomeCompleto+'">'+data[i].nomeCompleto+'</option>';
                                        }
                                        $('#getStu').html('');
                                        $('#getStu').append(op);
                                    },
                                    error: function (){
                                    }
                                });
                            }
                        //console.log(response.certificados);
                        $('tbody').append(
                               '<tr>\
                                    <td><div class="input-control"><select id="getStu" class="form-control" name="estudanteId"><option selected disabled>Selecione o estudante</option></select><span class="invalid-feedback"><strong class="error"></strong><span></div></td>\
                                    <td contenteditable="false" id="portugues"></td>\
                                    <td contenteditable="false" id="ingles"></td>\
                                    <td contenteditable="false" id="frances"></td>\
                                    <td contenteditable="false" id="filosolia"></td>\
                                    <td contenteditable="false" id="fisica"></td>\
                                    <td contenteditable="false" id="biologia"></td>\
                                    <td contenteditable="false" id="quimica"></td>\
                                    <td contenteditable="false" id="matematica"></td>\
                                    <td contenteditable="false" id="desenho"></td>\
                                    <td contenteditable="false" id="geografia"></td>\
                                    <td contenteditable="false" id="edfisica"></td>\
                                    <td contenteditable="false" id="historia"></td>\
                                    <td contenteditable="false" id="mediaFinal"></td>\
                                    <td contenteditable="false" id="situacao"></td>\
                                    <td contenteditable="false" ></td>\
                                    <td><button type="button" class="btn btn-success btn-sm" id="adcionar"><i class="fa fa-fw fa-plus"></i></button></td>\
                                </tr>');

                        $.each(response.certificados, function(key, item){
                            if (item.contacto == "Ciências Naturas (Opção B)") {
                                //console.log("Teste");
                                $('tbody').append(
                                    '<tr>\
                                            <td contenteditable="false" data-column_name="estudanteId" id="' + item.id + '">' + item.estudanteId + '</td>\
                                            <td contenteditable="true" class="data-column_name" data-column_name="filosolia" id="' + item.id + '">' + item.juri + '</td>\
                                            <td contenteditable="true" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="column_name" data-column_name="portugues" id="' + item.id + '">' + item.portugues + '</td>\
                                            <td contenteditable="true" class="column_name" data-column_name="ingles" id="' + item.id + '">' + item.ingles + '</td>>\
                                            <td contenteditable="false"></td>\
                                            <td contenteditable="true" class="column_name" data-column_name="filosolia" id="' + item.id + '">' + item.filosolia + '</td>\
                                            <td contenteditable="true" class="column_name" data-column_name="fisica" id="' + item.id + '">' + item.fisica + '</td>\
                                            <td contenteditable="true" class="column_name" data-column_name="biologia" id="' + item.id + '">' + item.biologia + '</td>\
                                            <td contenteditable="true" class="column_name" data-column_name="quimica" id="' + item.id + '">' + item.quimica + '</td>\
                                            <td contenteditable="true" class="column_name" data-column_name="matematica" id="' + item.id + '">' + item.matematica + '</td>\
                                            <td contenteditable="false" class="column_name" data-column_name="desenho"></td>\
                                            <td contenteditable="false" class="column_name" data-column_name="geografia" ></td>\
                                            <td contenteditable="true" class="column_name" data-column_name="edfisica" id="' + item.id + '">' + item.edfisica + '</td>\
                                            <td contenteditable="false" class="column_name" data-column_name="historia"></td>\
                                            <td contenteditable="false" class="column_name" data-column_name="mediaFinal" id="' + item.id + '">' + item.mediaFinal + '</td>\
                                            <td contenteditable="false" class="column_name" data-column_name="situacao" id="' + item.id + '">' + item.situacao + '</td>\
                                            <td>\
                                                <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+item.id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                                <button type="button" data-bs-toggle="" data-bs-target="EditCertificado" class="btn btn-success btn-sm edit" id="' + item.id + '"><i class="fa fa-fw fa-edit"></i></button>\
                                                <button type="button" class="btn btn-danger btn-sm delete" id="' + item.id + '"><i class="fa fa-fw fa-trash"></i></button>\
                                            </td>\
                                        </tr>');
                            }else
                            {
                                $('tbody').append(
                                    '<tr>\
                                            <td contenteditable="false" class="column_name" data-column_name="estudanteId" id="' + item.id + '">' + item.estudanteId + '</td>\
                                            <td contenteditable="true" data-column_name="juri" id="' + item.id + '">' + item.juri + '</td>\
                                            <td contenteditable="true" class="column_name" data-column_name="portugues" id="' + item.id + '">' + item.portugues + '</td>\
                                            <td contenteditable="true" class="column_name" data-column_name="ingles" id="' + item.id + '">' + item.ingles + '</td>\
                                            <td contenteditable="true" class="column_name" data-column_name="frances" id="' + item.id + '">' + item.frances + '</td>\
                                            <td contenteditable="false" class="column_name" data-column_name="filosolia"></td>\
                                            <td contenteditable="false" class="column_name" data-column_name="fisica" ></td>\
                                            <td contenteditable="false" class="column_name" data-column_name="biologia" ></td>\
                                            <td contenteditable="false" class="column_name" data-column_name="quimica" ></td>\
                                            <td contenteditable="true" class="column_name" data-column_name="matematica" id="' + item.id + '">' + item.matematica + '</td>\
                                            <td contenteditable="false" class="column_name" data-column_name="desenho"></td>\
                                            <td contenteditable="true" class="column_name" data-column_name="geografia" id="' + item.id + '">' + item.geografia + '</td>\
                                            <td contenteditable="true" class="column_name" data-column_name="edfisica" id="' + item.id + '">' + item.edfisica + '</td>\
                                            <td contenteditable="true" class="column_name" data-column_name="historia" id="' + item.id + '">' + item.historia + '</td>\
                                            <td contenteditable="false" class="column_name" data-column_name="mediaFinalF" id="' + item.id + '">' + item.mediaFinal + '</td>\
                                            <td contenteditable="false" class="column_name" data-column_name="situacao" id="' + item.id + '">' + item.situacao + '</td>\
                                            <td>\
                                                <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+item.id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                                <button type="button" data-bs-toggle="" data-bs-target="EditCertificado" class="btn btn-success btn-sm edit" id="' + item.id + '"><i class="fa fa-fw fa-edit"></i></button>\
                                                <button type="button" class="btn btn-danger btn-sm delete" id="' + item.id + '"><i class="fa fa-fw fa-trash"></i></button>\
                                            </td>\
                                    </tr>');
                            }

                        });

                    }
                });
            }

            //Buscando todos os estudantes cadastrados
            getStuName();
            function getStuName()
            {
                var op = "";
                $.ajax({
                    type: 'get',
                    url: '{!! URL::to('/office/certificados/getStuName') !!}',
                    dataType: "json",
                    success: function (data){
                        op+='<option value="0" selected disabled>Selecione o estudante</option>';
                        for(var i=0; i<data.length; i++){
                            op+='<option value="'+data[i].nomeCompleto+'">'+data[i].nomeCompleto+'</option>';
                        }
                        $('#getStu').html('');
                        $('#getStu').append(op);
                    },
                    error: function (){
                    }
                });
            }

            //Quando o estudante for selecionado
            $(document).on('change','#getStu', function (){
                $('#showSuccMessage').html(""); $('#showErrMessage').hide();
                getStuN = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{!! URL::to('/office/certificados/getStuSeccao') !!}',
                    data: {'getStuNCompleto':getStuN},
                    success: function (secca){
                        for(var i=0; i<secca.length; i++){
                            if(secca[i].contacto == "Ciências Naturas (Opção B)")
                            {

                                create();
                                function create(){
                                    $.ajax({
                                        type: "GET",
                                        url: "/office/certificados/fetchData",
                                        dataType: "json",
                                        success: function (response)
                                        {
                                            $('tbody').html("");

                                            $('tbody').append(
                                                '<tr>\
                                                    <td><select id="getStu" class="form-control"><option selected></option></select></td>\
                                                    <td><div class="input-control"><select id="selectStuJuri" class="form-control" name="juri"><option value="0" selected disabled>Selecione o júri</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option></select><span class="invalid-feedback"><strong class="error"></strong><span></div></td>\
                                                    <td><div class="input-control"><input id="portugues" name="portugues" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td><div class="input-control"><input id="ingles" name="ingles" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td contenteditable="false" id="frances"></td>\
                                                    <td><div class="input-control"><input id="filosolia" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td><div class="input-control"><input id="fisica" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td><div class="input-control"><input id="biologia" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td><div class="input-control"><input id="quimica" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td><div class="input-control"><input id="matematica" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td contenteditable="false" id="desenho"></td>\
                                                    <td contenteditable="false" id="geografia"></td>\
                                                    <td><div class="input-control"><input id="edfisica" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td contenteditable="false" id="historia"></td>\
                                                    <td><div class="input-control"><input id="mediaFinal" name="mediaFinal" readonly type="text" class="form-control"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td><div class="input-control"><input id="situacao" name="situacao" readonly type="text" class="form-control"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td><button type="button" class="btn btn-success btn-sm" id="adcionar"><i class="fa fa-fw fa-plus"></i></button></td></tr>\
                                                </tr>');

                                            $(function()
                                            {
                                                var total_amount = function(){

                                                    var soma = 0;
                                                    var precisaoN = 0;
                                                    $('.amount').each(function(){
                                                        var num = $(this).val();

                                                        if(num != 0)
                                                        {
                                                            soma += parseFloat(num)/8;
                                                            precisaoN = soma.toFixed();
                                                        }
                                                        //console.log('Consegui.....');
                                                    });
                                                    $('#mediaFinal').val("");
                                                    $('#mediaFinal').val(precisaoN);
                                                    let mediaFinal = $('#mediaFinal').val();
                                                    if(mediaFinal >=  10)
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

                                                $('.amount').keyup(function (){
                                                    total_amount();
                                                });

                                            });
                                            $.each(response.certificados, function(key, item){
                                            if (item.contacto == "Ciências Naturas (Opção B)") {
                                                //console.log("Teste");
                                                $('tbody').append(
                                                    '<tr>\
                                                            <td contenteditable="false" class="column_name" data-column_name="estudanteId" id="' + item.id + '">' + item.estudanteId + '</td>\
                                                            <td contenteditable="true" class="data-column_name" data-column_name="juri" id="' + item.id + '">' + item.juri + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="portugues" id="' + item.id + '">' + item.portugues + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="ingles" id="' + item.id + '">' + item.ingles + '</td>>\
                                                            <td contenteditable="false"></td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="filosolia" id="' + item.id + '">' + item.filosolia + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="fisica" id="' + item.id + '">' + item.fisica + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="biologia" id="' + item.id + '">' + item.biologia + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="quimica" id="' + item.id + '">' + item.quimica + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="matematica" id="' + item.id + '">' + item.matematica + '</td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="desenho"></td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="geografia" ></td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="edfisica" id="' + item.id + '">' + item.edfisica + '</td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="historia"></td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="mediaFinal" id="' + item.id + '">' + item.mediaFinal + '</td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="situacao" id="' + item.id + '">' + item.situacao + '</td>\
                                                            <td>\
                                                                <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+item.id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                                                <button type="button" data-bs-toggle="" data-bs-target="EditCertificado" class="btn btn-success btn-sm edit" id="' + item.id + '"><i class="fa fa-fw fa-edit"></i></button>\
                                                                <button type="button" class="btn btn-danger btn-sm delete" id="' + item.id + '"><i class="fa fa-fw fa-trash"></i></button>\
                                                             </td>\
                                                        </tr>');
                                            }else
                                            {
                                                $('tbody').append(
                                                    '<tr>\
                                                            <td contenteditable="false" class="column_name" data-column_name="estudanteId" id="' + item.id + '">' + item.estudanteId + '</td>\
                                                            <td contenteditable="true" class="data-column_name" data-column_name="juri" id="' + item.id + '">' + item.juri + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="portugues" id="' + item.id + '">' + item.portugues + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="ingles" id="' + item.id + '">' + item.ingles + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="frances" id="' + item.id + '">' + item.frances + '</td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="filosolia"></td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="fisica" ></td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="biologia" ></td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="quimica" ></td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="matematica" id="' + item.id + '">' + item.matematica + '</td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="desenho"></td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="geografia" id="' + item.id + '">' + item.geografia + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="edfisica" id="' + item.id + '">' + item.edfisica + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="historia" id="' + item.id + '">' + item.historia + '</td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="mediaFinalF" id="' + item.id + '">' + item.mediaFinal + '</td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="situacao" id="' + item.id + '">' + item.situacao + '</td>\
                                                            <td>\
                                                                <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+item.id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                                                <button type="button" data-bs-toggle="" data-bs-target="EditCertificado" class="btn btn-success btn-sm edit" id="' + item.id + '"><i class="fa fa-fw fa-edit"></i></button>\
                                                                <button type="button" class="btn btn-danger btn-sm delete" id="' + item.id + '"><i class="fa fa-fw fa-trash"></i></button>\
                                                             </td>\
                                                    </tr>');
                                            }

                                        });

                                        }
                                    })
                                }
                                getStuName();
                                function getStuName()
                                {
                                    var op = "";
                                    $.ajax({
                                        type: 'get',
                                        url: '{!! URL::to('/office/certificados/getStuName') !!}',
                                        dataType: "json",
                                        success: function (data){
                                            op+='<option value="'+getStuN+'" selected disabled>'+getStuN+'</option>';
                                            for(var i=0; i<data.length; i++){
                                                op+='<option value="'+data[i].nomeCompleto+'">'+data[i].nomeCompleto+'</option>';
                                            }
                                            $('#getStu').html('');
                                            $('#getStu').append(op);
                                        },
                                        error: function (){
                                        }
                                    });
                                }

                            }else
                            {
                                create();
                                function create(){
                                    $.ajax({
                                        type: "GET",
                                        url: "/office/certificados/fetchData",
                                        dataType: "json",
                                        success: function (response)
                                        {
                                            $('tbody').html("");
                                            $('tbody').append(
                                                '<tr>\
                                                    <td><select id="getStu" class="form-control"><option selected></option></select></td>\
                                                    <td><div class="input-control"><select id="selectStuJuri" class="form-control" name="juri"><option value="0" selected disabled>Selecione o júri</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option></select><span class="invalid-feedback"><strong class="error"></strong><span></div></td>\
                                                    <td><div class="input-control"><input id="portugues" name="portugues" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount1"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td><div class="input-control"><input id="ingles" name="ingles" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount1"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td><div class="input-control"><input id="frances" name="frances" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount1"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td contenteditable="false" id="filosolia"></td>\
                                                    <td contenteditable="false" id="fisica"></td>\
                                                    <td contenteditable="false" id="biologia"></td>\
                                                    <td contenteditable="false" id="quimica"></td>\
                                                    <td><div class="input-control"><input id="matematica" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount1"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td contenteditable="false" id="desenho"></td>\
                                                    <td><div class="input-control"><input id="geografia" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount1"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td><div class="input-control"><input id="edfisica" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount1"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td><div class="input-control"><input id="historia" type="text" onblur="this.value = minMaxValidationFunc(this, this.value)" min="0" max="20" class="form-control amount1"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td><div class="input-control"><input id="mediaFinal" name="mediaFinal" readonly type="text" class="form-control"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td><div class="input-control"><input id="situacao" name="situacao" readonly type="text" class="form-control"/><span class="invalid-feedback error"><strong class="error"></strong><span></div></td>\
                                                    <td><button type="button" class="btn btn-success btn-sm" id="adcionar"><i class="fa fa-fw fa-plus"></i></button></td></tr>\
                                                </tr>');


                                            $(function()
                                            {
                                                var total_amount1 = function(){

                                                    var soma = 0;
                                                    var precisao = 0;
                                                    $('.amount1').each(function(){
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
                                                    let mediaFinal = $('#mediaFinal').val();
                                                    if(mediaFinal >=  10)
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

                                                $('.amount1').keyup(function (){
                                                    total_amount1();
                                                });

                                            });
                                            $.each(response.certificados, function(key, item){
                                            if (item.contacto == "Ciências Naturas (Opção B)") {
                                                //console.log("Teste");
                                                $('tbody').append(
                                                    '<tr>\
                                                            <td contenteditable="false" class="column_name" data-column_name="estudanteId" id="' + item.id + '">' + item.estudanteId + '</td>\
                                                            <td contenteditable="true" class="data-column_name" data-column_name="juri" id="' + item.id + '">' + item.juri + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="portugues" id="' + item.id + '">' + item.portugues + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="ingles" id="' + item.id + '">' + item.ingles + '</td>>\
                                                            <td contenteditable="false"></td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="filosolia" id="' + item.id + '">' + item.filosolia + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="fisica" id="' + item.id + '">' + item.fisica + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="biologia" id="' + item.id + '">' + item.biologia + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="quimica" id="' + item.id + '">' + item.quimica + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="matematica" id="' + item.id + '">' + item.matematica + '</td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="desenho"></td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="geografia" ></td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="edfisica" id="' + item.id + '">' + item.edfisica + '</td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="historia"></td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="mediaFinal" id="' + item.id + '">' + item.mediaFinal + '</td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="situacao" id="' + item.id + '">' + item.situacao + '</td>\
                                                            <td>\
                                                                <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+item.id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                                                <button type="button" data-bs-toggle="" data-bs-target="EditCertificado" class="btn btn-success btn-sm edit" id="' + item.id + '"><i class="fa fa-fw fa-edit"></i></button>\
                                                                <button type="button" class="btn btn-danger btn-sm delete" id="' + item.id + '"><i class="fa fa-fw fa-trash"></i></button>\
                                                             </td>\
                                                        </tr>');
                                            }else
                                            {
                                                $('tbody').append(
                                                    '<tr>\
                                                            <td contenteditable="false" class="column_name" data-column_name="estudanteId" id="' + item.id + '">' + item.estudanteId + '</td>\
                                                            <td contenteditable="true" class="data-column_name" data-column_name="juri" id="' + item.id + '">' + item.juri + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="portugues" id="' + item.id + '">' + item.portugues + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="ingles" id="' + item.id + '">' + item.ingles + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="frances" id="' + item.id + '">' + item.frances + '</td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="filosolia"></td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="fisica" ></td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="biologia" ></td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="quimica" ></td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="matematica" id="' + item.id + '">' + item.matematica + '</td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="desenho"></td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="geografia" id="' + item.id + '">' + item.geografia + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="edfisica" id="' + item.id + '">' + item.edfisica + '</td>\
                                                            <td contenteditable="true" class="column_name" data-column_name="historia" id="' + item.id + '">' + item.historia + '</td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="mediaFinalF" id="' + item.id + '">' + item.mediaFinal + '</td>\
                                                            <td contenteditable="false" class="column_name" data-column_name="situacao" id="' + item.id + '">' + item.situacao + '</td>\
                                                            <td>\
                                                                <a class="btn btn-sm btn-primary" href="/office/certificados/show/'+item.id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                                                <button type="button" data-bs-toggle="" data-bs-target="EditCertificado" class="btn btn-success btn-sm edit" id="' + item.id + '"><i class="fa fa-fw fa-edit"></i></button>\
                                                                <button type="button" class="btn btn-danger btn-sm delete" id="' + item.id + '"><i class="fa fa-fw fa-trash"></i></button>\
                                                             </td>\
                                                    </tr>');
                                            }

                                        });

                                        }
                                    })
                                }
                                getStuName();
                                function getStuName()
                                {
                                    var op = "";
                                    $.ajax({
                                        type: 'get',
                                        url: '{!! URL::to('/office/certificados/getStuName') !!}',
                                        dataType: "json",
                                        success: function (data){
                                            op+='<option value="'+getStuN+'" selected>'+getStuN+'</option>';
                                            for(var i=0; i<data.length; i++){
                                                op+='<option value="'+data[i].nomeCompleto+'">'+data[i].nomeCompleto+'</option>';
                                            }
                                            $('#getStu').html('');
                                            $('#getStu').append(op);
                                        },
                                        error: function (){
                                        }
                                    });
                                }
                            }

                        }

                    },
                    error: function (){
                    }
                });
            });

            //Registando os dados do certificado
            $(document).on('click', '#adcionar', function(){
                validateSelectInput();
            });

            //Excluindo o certificado
            $(document).on('click', '.delete', function(){
                let getIdDel = $(this).attr("id");
                //alert('DELETE: '+getIdDel);
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

            //Habilando  os campos para actualizar o certificado
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
            //Actualizando os dados do certificado
             $(document).on('click', '.save', function(e){
                e.preventDefault();
                validateSelectInputEdit();

            });
        });
    </script>
@endsection
