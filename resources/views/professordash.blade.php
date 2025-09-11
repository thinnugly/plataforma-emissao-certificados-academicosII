@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('main')
            </div>
            <div class="col-9" style="margin-top: 10px; margin-left: 20px;">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard do Professor - Bem Vindo') }}</div>

                    <div class="card-body">
                       <!-- @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}-->
                        <div class="row">
                            <div>Total de disciplinas alocadas</div>
                                <div class="col-md-4">
                                    <div class="alert alert-info">
                                        <div class="icon hidden-xs">
                                            <i class="fa fa-archive"></i>
                                        </div>
                                        <strong>Total</strong>
                                        <Br />
                                        @foreach($prof_disc as $prof_disc)
                                            {{ $prof_disc->qtdDisc }}
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="alert alert-warning">
                                       <div class="icon hidden-xs">
                                           <i class="fa fa-archive"></i>
                                       </div>
                                       <strong>Disciplina (s)</strong>
                                       <Br />
                                       <table>
                                            @foreach($prof_discII as $prof_discII)
                                                <tr>
                                                    <!--<td><a href="#">{{ $prof_discII -> disciplinaId }}</a></td>-->
                                                    <td style="width:100px;">{{ $prof_discII -> disciplinaId }}</td>
                                                    <td style="width:500px;"><a class="btn btn-sm btn-success " href=""><i class="fa fa-fw fa-upload"></i> Inserir notas</a></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                   </div>
                               </div>
                               <!--<div class="col-md-4">
                                   <div class="alert alert-danger">
                                       <div class="icon hidden-xs">
                                           <i class="fa fa-archive"></i>
                                       </div>
                                       <strong>certificados não assinados</strong>
                                       <Br />
                                       
                                   </div>
                               </div>-->
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

