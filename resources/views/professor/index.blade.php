@extends('layouts.app')

@section('template_title')
    Professor
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
                                {{ __('Professor') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('createProf') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    <i class="fa fa-fw fa-plus"></i> {{ __('Cadastrar novo') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        @livewire('professor')
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
                    text: 'Professor criado com sucesso...',
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
                    text: 'Professor actualizado com sucesso...',
                    icon: 'success',
                    //showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    //: '#d33',
                    confirmButtonText: 'OK'
            })
        @endif
    });
</script>