@extends('layouts.app')

@section('template_title')
    Certificado assinados
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
                                {{ __('Certificados assinados') }}
                            </span>

                            <!-- <div class="float-right">
                                <a href="{{ route('carregarFiles') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    <i class="fa fa-fw fa-plus"></i> {{ __('Carregar novo') }}
                                </a>
                            </div> -->
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-2">
                                Items por página:
                                <select wire:model="perPage" class="form-control">
                                    <option>5</option>
                                    <option>10</option>
                                    <option>15</option>
                                    <option>20</option>
                                    <option>25</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-6" style="margin-top: 23px;">
                                <form action="{{ route('usuarios') }}" method="GET">
                                    <input name="search" type="text" class="form-control amount4" placeholder="Pesquise o usuário....">
                                </form>
                            </div>
                        </div>

                        <table class="table table-striped table-hover" id="getTU">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Título</th>
                                <th>Localização</th>
                                <th>Data de cadastro</th>
                                <!-- <th>Acção</th> -->
                            </tr>
                            </thead>
                            <tbody id="body">
                            
                            
                                    @foreach ($files as $files)
                                        <tr>
                                            <input type="hidden" class="serdelete_val_id" value="{{ $files->id}}">
                                            <td>{{ $files->id }}</td>
                                            <td>{{ $files->title }}</td>
                                            <td><a href="{{ env('APP_URL')}}/storage/{{$files->path}}">{{ $files->path}}</a></td>
                                            <td>{{ $files->created_at }}</td>
                                            <!-- <td>
                                                <a class="btn btn-sm btn-success" href="{{ route('editCertAss',$files->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                <button type="submit" class="btn btn-danger btn-sm showSweetModal"><i class="fa fa-fw fa-trash"></i></button>
                                            </td> -->
                                        </tr>
                                    @endforeach
                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('site/jquery.js') }}"></script>
<script type="text/javascript">
    
    $(document).ready(function()
    {
        @if ($message = Session::get('success'))
            Swal.fire({
                    title: 'Operação concluída',
                    text: 'Arquivo carregado com sucesso...',
                    icon: 'success',
                    //showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    //: '#d33',
                    confirmButtonText: 'OK'
            })
        @endif
        @if ($message = Session::get('success1'))
            Swal.fire({
                    title: 'Operação concluída',
                    text: 'Arquivo actualizado com sucesso...',
                    icon: 'success',
                    //showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    //: '#d33',
                    confirmButtonText: 'OK'
            })
        @endif
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $('.showSweetModal').click(function (e)
            {
                e.preventDefault();
                var getItemId = $(this).closest("tr").find('.serdelete_val_id').val();
                Swal.fire({
                    title: 'Você tem certeza?',
                    text: "Você não poderá reverter esta acção!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Sim, eliminar este item!',
                }).then((result) => {
                    if (result.isConfirmed) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": getItemId,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: '/director/gestordeficheiros/delete/'+getItemId,
                            data: "data",
                            success: function (response){
                                Swal.fire(
                                    'Eliminado!',
                                    'Certificado eliminado com  sucesso...',
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                });
                            }
                        });

                    }
                })
            });
    });
</script>
