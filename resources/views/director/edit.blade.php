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
                                {{ __('Carregar certificado') }}
                            </span>

                            <div class="float-right">
                                <a class="btn btn-warning" href="{{ route('files') }}"><i class="fa fa-fw fa-arrow-left"></i> Retroceder</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('updateFiles', ['id' => $files->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <input id="arquivo" type="file" class="form-control @error('arquivo') is-invalid @enderror" name="arquivo" value="{{ old('arquivo') }}">
                                    @error('arquivo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-4">
                                    <label for="title">{{ __('Título:') }}</label>
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $files->title }}" placeholder="Título" autocomplete="title" autofocus>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="box-footer" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> Salvar</button>
                            </div>
                        </form>
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
        
    });
</script>
