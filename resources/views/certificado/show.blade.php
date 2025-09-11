@extends('layouts.app')

@section('template_title')
    {{ $users->name ?? 'Show Usuário' }}
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
                            <span class="card-title">Detalhes do estudante</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-warning" href="{{ route('allCerts') }}"><i class="fa fa-fw fa-arrow-left"></i> Retroceder</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @foreach($certificados as $estudante)
                            @if($estudante->contacto == "Ciências Naturas (Opção B)")
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <strong>Nome completo:</strong>
                                        {{ $estudante->estudanteId }}
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <strong>Português:</strong>
                                        {{ $estudante->portugues }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Inglês:</strong>
                                        {{ $estudante->ingles }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Filosofia:</strong>
                                        {{ $estudante->filosolia }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Física:</strong>
                                        {{ $estudante->fisica }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Biologia:</strong>
                                        {{ $estudante->biologia }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Química:</strong>
                                        {{ $estudante->quimica }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Matemática:</strong>
                                        {{ $estudante->matematica }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Educação física:</strong>
                                        {{ $estudante->edfisica }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Média final:</strong>
                                        {{ $estudante->mediaFinal }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Situação:</strong>
                                        {{ $estudante->situacao }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Júri:</strong>
                                        {{ $estudante->juri }}
                                    </div>
                                </div>
                            </div>
                            @else
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <strong>Nome completo:</strong>
                                            {{ $estudante->estudanteId }}
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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <strong>Português:</strong>
                                            {{ $estudante->portugues }}
                                        </div>
                                        <div class="form-group">
                                            <strong>Inglês:</strong>
                                            {{ $estudante->ingles }}
                                        </div>
                                        <div class="form-group">
                                            <strong>Francês:</strong>
                                            {{ $estudante->frances }}
                                        </div>
                                        <div class="form-group">
                                            <strong>Matemática:</strong>
                                            {{ $estudante->matematica }}
                                        </div><div class="form-group">
                                            <strong>Geografia:</strong>
                                            {{ $estudante->geografia }}
                                        </div>
                                        <div class="form-group">
                                            <strong>Educação física:</strong>
                                            {{ $estudante->edfisica }}
                                        </div>
                                        <div class="form-group">
                                            <strong>História:</strong>
                                            {{ $estudante->historia }}
                                        </div>
                                        <div class="form-group">
                                            <strong>Média final:</strong>
                                            {{ $estudante->mediaFinal }}
                                        </div>
                                        <div class="form-group">
                                            <strong>Situação:</strong>
                                            {{ $estudante->situacao }}
                                        </div>
                                        <div class="form-group">
                                            <strong>Júri:</strong>
                                            {{ $estudante->juri }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        </div>
                    </div>
                </div>
        </div>
    </section>
@endsection
