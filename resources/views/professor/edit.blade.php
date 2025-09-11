@extends('layouts.app')

@section('template_title')
    Update Estudante
@endsection

@section('content')
    <section class="container">
        <div class="row">
            <div class="col-md-2">
                @include('main')
            </div>
            <div class="col-md-9" style="margin-top: 10px; margin-left: 20px;">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"></span>
                        <div class="float-right">
                            <a class="btn btn-warning" href="{{ route('professores') }}"><i class="fa fa-fw fa-arrow-left"></i> Retroceder</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('updateProf', $professor->id) }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="nomeCompleto">{{ __('Nome completo:') }}</label>
                                    <input id="nomeCompleto" type="text" readonly class="form-control @error('nomeCompleto') is-invalid @enderror" name="nomeCompleto" value="{{ $professor->nomeCompleto}}" placeholder="Campo somente de leitura" autocomplete="nomeCompleto" autofocus>
                                    @error('nomeCompleto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="sexo">{{ __('Sexo:') }}</label>
                                    <select id="sexo" class="form-control teste @error('Sexo') is-invalid @enderror" name="Sexo">
                                        <option selected >{{$professor->Sexo}}</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Feminino">Feminino</option>
                                    </select>
                                    @error('Sexo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-3">
                                    <label for="paidId">{{ __('País:') }}</label>
                                    <select id="paidId" class="form-control getPais @error('paidId') is-invalid @enderror" name="paidId" value="{{ old('paidId') }}">
                                        <option selected >{{$professor->paidId}}</option>
                                        @foreach($paises as $pais)
                                            <option value="{{$pais -> nome}}">{{$pais -> nome}}</option>
                                        @endforeach
                                    </select>
                                    @error('paidId')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="naturalidade">{{ __('Naturalidade:') }}</label>
                                    <select id="naturalidade" class="form-control getNatur @error('naturalidade') is-invalid @enderror" name="naturalidade" value="{{ old('naturalidade') }}">
                                        <option selected >{{$professor->naturalidade}}</option>
                                    </select>
                                    @error('naturalidade')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="morada">{{ __('Morada:') }}</label>
                                    <select id="morada" class="form-control getMorada @error('morada') is-invalid @enderror" name="morada" value="{{ old('morada') }}">
                                        <option selected>{{$professor->morada}}</option>
                                    </select>
                                    @error('morada')
                                    <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="data_nasci">{{ __('Data de nascimento:') }}</label>
                                    <input id="data_nasci" type="date" class="form-control @error('dataNascimento') is-invalid @enderror" name="dataNascimento" value="{{ $professor->dataNascimento}}" autocomplete="data_nasci" autofocus>
                                    @error('dataNascimento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-4">
                                    <label for="bi">{{ __('Bilhete de identidade:') }}</label>
                                    <input id="bi" type="text" class="form-control @error('bi') is-invalid @enderror" name="bi" value="{{ $professor->bi}}" placeholder="ex: 123456789012R" autocomplete="bi" autofocus>
                                    @error('bi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                <label for="userId">{{ __('Usuário:') }}</label>
                                    <select id="userId" class="form-control getName @error('userId') is-invalid @enderror" name="userId" value="{{ old('userId') }}">
                                        <option selected>{{$professor->userId}}</option>
                                        <option value="{{$professor->userId}}">{{$professor->userId}}</option>
                                    </select>
                                    @error('userId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="contacto">{{ __('Contacto:') }}</label>
                                    <input id="contacto" type="text" class="form-control @error('contacto') is-invalid @enderror" name="contacto" value="{{ $professor->contacto}}" placeholder="ex: 869567746" autocomplete="contacto" autofocus>
                                    @error('contacto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="box-footer mt20" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script src="{{asset('site/jquery.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function ()
    {
        //get morada by naturalidade
        $(document).on('change','.getPais', function (){
            var getPaisName = $(this).val(),
                op = "";
            $.ajax({
                type: 'get',
                url: '{!! URL::to('findNaturalidadeByPais') !!}',
                data: {'paisN':getPaisName},
                success: function (data){
                    //console.log(data.length);
                    op+='<option value="0" selected disabled>Selecione a naturalidade</option>';
                    for(var i=0; i<data.length; i++){
                        op+='<option value="'+data[i].nome+'">'+data[i].nome+'</option>';
                    }
                    $('.getNatur').html('');
                    $('.getMorada').html('');
                    $('.getNatur').append(op);
                },
                error: function (){
                }
            });
        });
        //get morada by naturalidade
        $(document).on('change','.getNatur', function (){
            var getNaturName = $(this).val(),
                op = "";
            $.ajax({
                type: 'get',
                url: '{!! URL::to('findMordaByNaturalidade') !!}',
                data: {'naturN':getNaturName},
                success: function (data){
                    op+='<option value="0" selected disabled>Selecione a morada</option>';
                    for(var i=0; i<data.length; i++){
                        op+='<option value="'+data[i].nome+'">'+data[i].nome+'</option>';
                    }
                    $('.getMorada').html('');
                    $('.getMorada').append(op);
                },
                error: function (){

                }
            });
        });

        //get nome by email
        $(document).on('change','.getName', function (){
            var getUserName = $(this).val();
            $.ajax({
                type: 'get',
                url: '{!! URL::to('findNameByEmail') !!}',
                data: {'userName':getUserName},
                dataType: 'json',
                success: function (data){
                    for(var i=0; i<data.length; i++){
                        $('#nomeCompleto').val(data[i].name);
                    }
                },
                error: function (){

                }
            });
        });
        //Teste
        $(document).on('change','.teste', function (){
            var getUserName = $(this).val();
            console.log(getUserName);
        });
    });
</script>
