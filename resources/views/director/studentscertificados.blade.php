@extends('layouts.app')

@section('template_title')
    Certificado
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('main')
            </div>
            <div class="col-sm-9" style="margin-top: 10px; margin-left: 20px;">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Certificado') }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col form-inline">
                                Por página: &nbsp;
                                <select wire:model="perPage">
                                    <option>5</option>
                                    <option>10</option>
                                    <option>15</option>
                                    <option>20</option>
                                    <option>25</option>
                                </select>
                            </div>
                            <div class="col">
                                <form action="{{ route('usuarios') }}" method="GET">
                                    <input name="search" type="text" class="form-control amount4" placeholder="Pesquise o certificado....">
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Nome do estudante</th>
                                    <th>Portugues</th>
                                    <th>Inglês</th>
                                    <th>Francês</th>
                                    <th>Filosolia</th>
                                    <th>Física</th>
                                    <th>Biologia</th>
                                    <th>Química</th>
                                    <th>Matemática</th>
                                    <th>Desenho</th>
                                    <th>Geografia</th>
                                    <th>Ed. Física</th>
                                    <th>História</th>
                                    <th>Média final</th>
                                    <th>Acção</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($allUserInfo as $stu)
                                        @if($stu->contacto == "Ciências Naturas (Opção B)")
                                            <tr>
                                                <td>{{$stu->nomeCompleto}}</td>
                                                <td>{{$stu->portugues}}</td>
                                                <td>{{$stu->ingles}}</td>
                                                <td></td>
                                                <td>{{$stu->filosolia}}</td>
                                                <td>{{$stu->fisica}}</td>
                                                <td>{{$stu->biologia}}</td>
                                                <td>{{$stu->quimica}}</td>
                                                <td>{{$stu->matematica}}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{$stu->edfisica}}</td>
                                                <td></td>
                                                <td>{{$stu->mediaFinal}}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" id="view" target="" href="{{ route('viewPDF', $stu->nomeCompleto)}}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-primary btn-sm" id="download" target="" href=""><i class="fa fa-fw fa-signature"></i></a>
                                                </td>
                                            </td>
                                        @else
                                            <tr>
                                                    <td>{{$stu->nomeCompleto}}</td>
                                                    <td>{{$stu->portugues}}</td>
                                                    <td>{{$stu->ingles}}</td>
                                                    <td>{{$stu->frances}}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{$stu->matematica}}</td>
                                                    <td></td>
                                                    <td>{{$stu->geografia}}</td>
                                                    <td>{{$stu->edfisica}}</td>
                                                    <td>{{$stu->historia}}</td>
                                                    <td>{{$stu->mediaFinal}}</td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm" id="view" target="" href="{{ route('viewPDF', $stu->nomeCompleto)}}"><i class="fa fa-fw fa-eye"></i></a>
                                                        <a class="btn btn-primary btn-sm" id="download" target="" href=""><i class="fa fa-fw fa-signature"></i></a>
                                                    </td>
                                            </td>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('site/jquery.js')}}"></script>
    <script src="{{asset('site/bootstrap.js')}}"></script>
    <script src="{{asset('validation/validation.js')}}"></script>
    <script type="text/javascript">
        
        $(document).ready(function(){
            @if ($message = Session::get('error'))
            Swal.fire({
                    title: 'Oooops....!',
                    text: "Impossível processar seu certificado, sua média final é inferior a 10 Valores.",
                    icon: 'error',
                    //showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    //: '#d33',
                    confirmButtonText: 'OK'
                })
            @endif
        });
    </script>
@endsection
