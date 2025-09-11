@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('main')
            </div>
            <div class="col-9" style="margin-top: 10px; margin-left: 20px;">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard da Secretária - Bem Vindo') }}</div>

                    <div class="card-body">
                       <!-- @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}-->
                            <div class="row">
                                
                                <div class="col-md-4">
                                <div>Total de certificados cadastrados</div>
                                   <div class="alert alert-warning">
                                       <div class="icon hidden-xs">
                                           <i class="fa fa-archive"></i>
                                       </div>
                                       <strong>Total</strong>
                                       <Br />
                                       @foreach($certificados as $certificado)
                                           {{ $certificado->cD }}
                                       @endforeach
                                   </div>
                               </div>
                               <div class="col-md-4">
                               <div>Total de exames cadastrados</div>
                                   <div class="alert alert-info">
                                       <div class="icon hidden-xs">
                                           <i class="fa fa-archive"></i>
                                       </div>
                                       <strong>Total</strong>
                                       <Br />
                                       @foreach($certificadosV2 as $certificado)
                                           {{ $certificado->dC }}
                                       @endforeach
                                   </div>
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

