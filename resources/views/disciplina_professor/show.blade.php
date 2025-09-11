@extends('layouts.app')

@section('template_title')
    {{ $disc_prof->disciplinaId ?? 'Show Disciplina Alocação' }}
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
                            <a class="btn btn-warning" href="{{ route('_professor') }}"><i class="fa fa-fw fa-arrow-left"></i> Retroceder</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Disciplina:</strong>
                            {{ $disc_prof->disciplinaId}}
                        </div>
                        <div class="form-group">
                            <strong>Professor alocado:</strong>
                            {{ $disc_prof->professorId }}
                        </div>
                        <div class="form-group">
                            <strong>Turma:</strong>
                            {{ $disc_prof->turmaId }}
                        </div>
                        <div class="form-group">
                            <strong>Classe:</strong>
                            {{ $disc_prof->classeId }}
                        </div>
                        <div class="form-group">
                            <strong>Secção:</strong>
                            {{ $disc_prof->seccaoId }}
                        </div>
                        <div class="form-group">
                            <strong>Data de registo:</strong>
                            {{ $disc_prof->created_at }}
                        </div>
                        <div class="form-group">
                            <strong>Data da última actualização:</strong>
                            {{ $disc_prof->updated_at }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
