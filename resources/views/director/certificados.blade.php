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
                    @if ($message = Session::get('success'))

                    @endif


                    <div class="card-body">
                        @livewire('certificado-v3')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
