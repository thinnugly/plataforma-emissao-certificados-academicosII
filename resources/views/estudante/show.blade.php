@extends('layouts.app')

@section('template_title')
    {{ $estudante->name ?? 'Show Estudante' }}
@endsection

@section('content')
    <section class="container">
        <div class="row">
            <div class="col-md-2">
                @include('main')
            </div>
            <div class="col-md-9" style="margin-top: 10px; margin-left: 20px;">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title"></span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-warning" href="{{ route('estudantes') }}"><i class="fa fa-fw fa-arrow-left"></i> Retroceder</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nome completo:</strong>
                            {{ $estudante->nomeCompleto }}
                        </div>
                        <div class="form-group">
                            <strong>Sexo:</strong>
                            {{ $estudante->Sexo }}
                        </div>
                        <div class="form-group">
                            <strong>País:</strong>
                            {{ $estudante->paidId }}
                        </div>
                        <div class="form-group">
                            <strong>Naturalidade:</strong>
                            {{ $estudante->naturalidade }}
                        </div>
                        <div class="form-group">
                            <strong>Morada:</strong>
                            {{ $estudante->morada }}
                        </div>
                        <div class="form-group">
                            <strong>Data de nascimento:</strong>
                            {{ $estudante->dataNascimento }}
                        </div>
                        <div class="form-group">
                            <strong>Nome do pai:</strong>
                            {{ $estudante->nomePai }}
                        </div>
                        <div class="form-group">
                            <strong>Nome do mãe:</strong>
                            {{ $estudante->nomeMae }}
                        </div>
                        <div class="form-group">
                            <strong>Classe:</strong>
                            {{ $estudante->classe }}
                        </div>
                        <div class="form-group">
                            <strong>Usuário:</strong>
                            {{ $estudante->userId }}
                        </div>
                        <div class="form-group">
                            <strong>Bilhete de identidade:</strong>
                            {{ $estudante->bi }}
                        </div>
                        <div class="form-group">
                            <strong>Secção:</strong>
                            {{ $estudante->contacto }}
                        </div>
                        <div class="form-group">
                            <strong>Turma:</strong>
                            {{ $estudante->turma_stu }}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
