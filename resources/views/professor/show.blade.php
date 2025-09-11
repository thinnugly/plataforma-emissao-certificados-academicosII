@extends('layouts.app')

@section('template_title')
    {{ $professor->name ?? 'Show Professor' }}
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
                            <a class="btn btn-warning" href="{{ route('professores') }}"><i class="fa fa-fw fa-arrow-left"></i> Retroceder</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nome completo:</strong>
                            {{ $professor->nomeCompleto }}
                        </div>
                        <div class="form-group">
                            <strong>Sexo:</strong>
                            {{ $professor->Sexo }}
                        </div>
                        <div class="form-group">
                            <strong>País:</strong>
                            {{ $professor->paidId }}
                        </div>
                        <div class="form-group">
                            <strong>Naturalidade:</strong>
                            {{ $professor->naturalidade }}
                        </div>
                        <div class="form-group">
                            <strong>Morada:</strong>
                            {{ $professor->morada }}
                        </div>
                        <div class="form-group">
                            <strong>Data de nascimento:</strong>
                            {{ $professor->dataNascimento }}
                        </div>
                        <div class="form-group">
                            <strong>Usuário:</strong>
                            {{ $professor->userId }}
                        </div>
                        <div class="form-group">
                            <strong>Bilhete de identidade:</strong>
                            {{ $professor->bi }}
                        </div>
                        <div class="form-group">
                            <strong>Contacto:</strong>
                            {{ $professor->contacto }}
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
