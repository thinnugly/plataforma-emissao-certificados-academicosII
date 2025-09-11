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
                    <form method="POST" action="{{ route('update', ['id' => $users->id]) }}">
                    @csrf
                    <input type="hidden" id="userID" value="{{$users->id }}">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$users->name}}"  autocomplete="name" autofocus>

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
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$users->email}}"  autocomplete="email">

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
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" autocomplete="new-password">

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
                                    <select id="perfil" class="form-control getRoleId @error('perfil') is-invalid @enderror" name="perfil" value="">
                                        @foreach($usersd as $usersd)
                                            <option value="{{$usersd->id}}" selected >{{$usersd->display_name}}</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Director</option>
                                            <option value="3">Auxiliar de secretaria</option>
                                            <option value="5">Secretário titular</option>
                                            <option value="4">Estudante</option>
                                        @endforeach
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
                                    <button type="submit" class="btn btn-success  actualizaruser">
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
    <script src="{{asset('site/jquery.js')}}"></script>
    <script type="text/javascript">
        
        $(document).ready(function (){
            
            $(document).on('click', '.actualizaruser', function (){

                var select = document.getElementById('perfil');
                // var opcaoTexto = select.options[select.selectedIndex].text; pegando o texto do Select
                var roleId = select.options[select.selectedIndex].value;
                let userIDD = $('#userID').val();
                
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var data = 
                    {
                        'getUserId':userIDD,
                        'insertNewRoleValue': roleId,
                    }
                    $.ajax({
                       type: 'get',
                       url: '{!! URL::to('/administrator/usuarios/updateuserroles') !!}',
                       data: data,
                        success: function(response)
                        {
                            if(response.status == 200)
                            {
                                console.log(response.message);
                            }
                        }
                    });                
            });

        });
    </script>
@endsection
