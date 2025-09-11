@extends('layouts.app')

@section('template_title')
    Alocar disciplina
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('main')
            </div>
            <div class="col-md-9" style="margin-top: 10px; margin-left: 20px;">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Alocar disciplina') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route ('_create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    <i class="fa fa-fw fa-plus"></i> {{ __('Alocar nova') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @livewire('disciplina-professor')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('site/jquery.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            @if ($message = Session::get('success'))
            Swal.fire({
                    title: 'Operação concluída',
                    text: 'Disciplina alocada com sucesso...',
                    icon: 'success',
                    //showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    //: '#d33',
                    confirmButtonText: 'OK'
            })
            @endif
            @if ($message = Session::get('success2'))
            Swal.fire({
                    title: 'Operação concluída',
                    text: 'Alocação de disciplina actualizada com sucesso...',
                    icon: 'success',
                    //showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    //: '#d33',
                    confirmButtonText: 'OK'
            })
            @endif
        });
    </script>
@endsection
