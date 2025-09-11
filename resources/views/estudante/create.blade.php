@extends('layouts.app')

@section('template_title')
    Create Estudante
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
                            <a class="btn btn-warning" href="{{ route('estudantes') }}"><i class="fa fa-fw fa-arrow-left"></i> Retroceder</a>
                        </div>
                    </div>
                    <div class="card-body">
                            <!-- <div class="float-right">
                                <a href="{{ route('testeT') }}" target="__blank" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    <i class="fa fa-fw fa-plus"></i> {{ __('Create New') }}
                                </a>
                            </div> -->
                        <form method="POST" action="{{ route('estudantes.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="nomeCompleto">{{ __('Nome completo:') }}</label>
                                    <input id="nomeCompleto" type="text" readonly class="form-control @error('nomeCompleto') is-invalid @enderror" name="nomeCompleto" value="{{ old('nomeCompleto') }}" placeholder="Campo somente de leitura" autocomplete="nomeCompleto" autofocus>
                                    @error('nomeCompleto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="sexo">{{ __('Sexo:') }}</label>
                                    <select id="sexo" class="form-control @error('Sexo') is-invalid @enderror" name="Sexo">
                                        <option selected disabled>Selecione o sexo</option>
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
                                        <option value="0" selected disabled>País</option>
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
                                        <option value="0" selected disabled>Naturalidade</option>
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
                                        <option value="0" selected disabled>Morada</option>
                                    </select>
                                    @error('morada')
                                    <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="data_nasci">{{ __('Data de nascimento:') }}</label>
                                    <input id="data_nasci" type="date" class="form-control @error('dataNascimento') is-invalid @enderror" name="dataNascimento" value="{{ old('data_nasci') }}" autocomplete="data_nasci" autofocus>
                                    @error('dataNascimento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-4">
                                    <label for="nomePai">{{ __('Nome do pai:') }}</label>
                                    <input id="nomePai" type="text" class="form-control @error('nomePai') is-invalid @enderror" name="nomePai" value="{{ old('nomePai') }}" placeholder="ex: Amosse Jamissone" autocomplete="nomePai" autofocus>
                                    @error('nomePai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <label for="nomeMae">{{ __('Nome da mãe:') }}</label>
                                    <input id="nomeMae" type="text" class="form-control @error('nomeMae') is-invalid @enderror" name="nomeMae" value="{{ old('nomeMae') }}" placeholder="ex: Vita Lodina" autocomplete="nomeMae" autofocus>
                                    @error('nomeMae')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="turma_stu">{{ __('Turma:') }}</label>
                                    <select id="turma_stu" class="form-control @error('turma_stu') is-invalid @enderror" name="turma_stu" value="{{ old('turma_stu') }}">
                                        <option selected disabled>Selecione a turma</option>
                                        @foreach($turmas as $turmas)
                                            <option value="{{$turmas -> nome_turma }}">{{$turmas -> nome_turma }}</option>
                                        @endforeach
                                    </select>
                                    @error('turma_stu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-3">
                                    <label for="classe">{{ __('Classe:') }}</label>
                                    <select id="classe" class="form-control @error('classe') is-invalid @enderror" name="classe" value="{{ old('classe') }}">
                                        <option selected disabled>Selecione a classe</option>
                                        <option value="12ª Classe">12ª Classe</option>
                                    </select>
                                    @error('classe')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="userId">{{ __('Usuário:') }}</label>
                                    <select id="userId" class="form-control getName @error('userId') is-invalid @enderror" name="userId" value="{{ old('userId') }}">
                                        <option selected disabled>Selecione o usuário</option>
                                        @foreach($users as $user)
                                            <option value="{{$user -> email}}">{{$user -> email}}</option>
                                        @endforeach
                                    </select>
                                    @error('userId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="bi">{{ __('Bilhete de identidade:') }}</label>
                                    <input id="bi" type="text" class="form-control @error('bi') is-invalid @enderror" name="bi" value="{{ old('bi') }}" placeholder="ex: 123456789012R" autocomplete="bi" autofocus>
                                    @error('bi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="contacto">{{ __('Secção:') }}</label>
                                    <select id="contacto" class="form-control getName @error('contacto') is-invalid @enderror" name="contacto" value="{{ old('contacto') }}">
                                        <option selected disabled>Selecione a secção</option>
                                        <option value="Ciências Naturas (Opção B)">Ciências Naturas (Opção B)</option>
                                        <option value="Letras com Matematica (Opção A)">Letras com Matematica (Opção A)</option>
                                    </select>
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
    });
</script>
