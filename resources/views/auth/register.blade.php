@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            @include('main')
        </div>
        <div class="col-md-9" style="margin-top: 10px; margin-left: 20px;">
            <div class="card">
                <div class="card-header">{{ __('') }}
                    <div class="float-right">
                        <a class="btn btn-warning" href="{{ route('usuarios') }}"><i class="fa fa-fw fa-arrow-left"></i> Retroceder</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="perfil" class="col-md-4 col-form-label text-md-end">{{ __('Perfil:') }}</label>
                            <div class="col-md-6">
                                <select id="perfil" class="form-control @error('perfil') is-invalid @enderror" name="perfil" value="{{ old('perfil') }}">
                                    <option value="0" selected disabled>Selecione um perfil</option>
                                    <option value="administrator">Administrador</option>
                                    <option value="director">Director</option>
                                    <option value="office">Auxiliar de secretaria</option>
                                    <option value="office_titular">Titular de secretaria</option>
                                    <option value="student">Estudante</option>
                                    <option value="professor">Professor</option>
                                    <option value="funcionario">Funcionário</option>
                                </select>
                                @error('perfil')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                <i class="fa fa-fw fa-save"></i> {{ __('Salvar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
