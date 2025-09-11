@extends('layouts.app')

@section('template_title')
    Alocar disciplina
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
                            <a class="btn btn-warning" href="{{ route('_professor') }}"><i class="fa fa-fw fa-arrow-left"></i> Retroceder</a>
                        </div>
                    </div>
                    <div class="card-body">
                            <!-- <div class="float-right">
                                <a href="{{ route('testeT') }}" target="__blank" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    <i class="fa fa-fw fa-plus"></i> {{ __('Create New') }}
                                </a>
                            </div> -->
                        <form method="POST" action="{{ route ('_alocarDisc') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="getDisciplinaId">
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-3">
                                    <label for="classeId">{{ __('Classe:') }}</label>
                                    <select id="classeId" class="form-control getClasse @error('classeId') is-invalid @enderror" name="classeId" value="{{ old('classeId') }}">
                                        <option value="0" selected disabled>Selecione a classe</option>
                                        @foreach($classe as $classe)
                                            <option value="{{$classe -> nome}}">{{$classe -> nome}}</option>
                                        @endforeach
                                    </select>
                                    @error('classeId')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="seccaoId">{{ __('Secção:') }}</label>
                                    <select id="seccaoId" class="form-control getSeccao @error('seccaoId') is-invalid @enderror" name="seccaoId" value="{{ old('seccaoId') }}">
                                        <option value="0" selected disabled>Secção</option>
                                    </select>
                                    @error('seccaoId')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="turmaId">{{ __('Turma:') }}</label>
                                    <select id="turmaId" class="form-control getTurma @error('turmaId') is-invalid @enderror" name="turmaId" value="{{ old('turmaId') }}">
                                        <option value="0" selected disabled>Turma</option>
                                    </select>
                                    @error('turmaId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <label for="disciplinaId">{{ __('Disciplina:') }}</label>
                                    <select id="disciplinaId" class="form-control getDisciplina @error('disciplinaId') is-invalid @enderror" name="disciplinaId" value="{{ old('disciplinaId') }}">
                                        <option value="0" selected disabled>Disciplina</option>
                                    </select>
                                    @error('disciplinaId')
                                    <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-7">
                                    <label for="professorId">{{ __('Professor por alocar:') }}</label>
                                    <select id="professorId" class="form-control @error('professorId') is-invalid @enderror" name="professorId" value="{{ old('professorId') }}">
                                        <option selected disabled>Selecione o professor</option>
                                        @foreach($professor as $professor)
                                            <option value="{{$professor -> nomeCompleto }}">{{$professor -> nomeCompleto }}</option>
                                        @endforeach
                                    </select>
                                    @error('professorId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="box-footer mt20" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-success actualizarStatusTurmaDis"><i class="fa fa-fw fa-save"></i> Salvar</button>
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
        //get seccao by classe
        $(document).on('change','.getClasse', function (){
            var getClasseName = $(this).val(),
                op = "";
            $.ajax({
                type: 'get',
                url: '{!! URL::to('findSeccaoByClasse') !!}',
                data: {'classeName':getClasseName},
                success: function (data){
                    //console.log(data.length);
                    op+='<option value="0" selected disabled>Selecione a secção</option>';
                    for(var i=0; i<data.length; i++){
                        op+='<option value="'+data[i].nome+'">'+data[i].nome+'</option>';
                    }
                    $('.getSeccao').html('');
                    $('.getTurma').html('<option value="0" selected disabled>Turma</option>');
                    $('.getDisciplina').html('<option value="0" selected disabled>Disciplina</option>');
                    $('.getSeccao').append(op);
                },
                error: function (){
                }
            });
        });
        //get turma by seccao
        $(document).on('change','.getSeccao', function (){
            var getSeccaoName = $(this).val(),
                op = "";
            $.ajax({
                type: 'get',
                url: '{!! URL::to('findTurmaBySeccao') !!}',
                data: {'seccaoName':getSeccaoName},
                success: function (data){
                    op+='<option value="0" selected disabled>Selecione a turma</option>';
                    for(var i=0; i<data.length; i++){
                        op+='<option value="'+data[i].nome_turma+'">'+data[i].nome_turma+'</option>';
                        
                    }
                    $('.getTurma').html('');
                    $('.getDisciplina').html('<option value="0" selected disabled>Disciplina</option>');
                    $('.getTurma').append(op);
                },
                error: function (){

                }
            });
        });
        //get disciplina by turma
        $(document).on('change','.getTurma', function (){
            var getTurmaName = $(this).val(),
                op = "",
                opI = "";
            $.ajax({
                type: 'get',
                url: '{!! URL::to('findDisciplinaByTurma') !!}',
                data: {'turmaName':getTurmaName},
                success: function (data){
                    op+='<option value="0" selected disabled>Selecione a disciplina</option>';
                    for(var i=0; i<data.length; i++){
                        op+='<option value="'+data[i].nome+'">'+data[i].nome+'</option>';
                        
                    }
                    $('.getDisciplina').html('');
                    $('.getDisciplina').append(op);
                },
                error: function (){

                }
            });
        });
        //get disciplina id by name
        $(document).on('change','.getDisciplina', function (){
            var getDisciplinaName = $(this).val();
            $.ajax({
                type: 'get',
                url: '{!! URL::to('findIdByDisciplina') !!}',
                data: {'disciplinaName':getDisciplinaName},
                dataType: 'json',
                success: function (data){
                    for(var i=0; i<data.length; i++){
                        $('#getDisciplinaId').val(data[i].id);
                    }
                },
                error: function (){

                }
            });
        });
        $(document).on('click', '.actualizarStatusTurmaDis', function()
        {
            let getDisciplinaIdII = $('#getDisciplinaId').val();
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: '{!! URL::to('/administrator/disciplinas/updatedisciplinastatus') !!}',
                data: {'getDiscId':getDisciplinaIdII},
                success: function(response)
                { 
                    if(response.estado == 200)
                    {
                        console.log(response.message);
                    }
                }
            });
        });
    });
</script>
