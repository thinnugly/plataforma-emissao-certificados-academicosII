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
                            <span class="card-title"></span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-warning" href="{{ route('usuarios') }}"><i class="fa fa-fw fa-arrow-left"></i> Retroceder</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @foreach($users as $user)
                            <div class="form-group">
                                <strong>Nome do usuário:</strong>
                                {{ $user->name }}
                            </div>
                            <div class="form-group">
                                <strong>Email:</strong>
                                {{ $user->email }}
                            </div>
                            <div class="form-group">
                                <strong>Perfil:</strong>
                                {{ $user->display_name }}
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
        </div>
    </section>
@endsection
