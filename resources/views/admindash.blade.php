@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('main')
            </div>
            <div class="col-9" style="margin-top: 10px; margin-left: 20px;">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard do Administrator - Bem Vindo') }}</div>

                    <div class="card-body">
                       <!-- @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}-->
                           <div class="row">
                               <div>Total de estudantes cadastrados</div>
                               <div class="col-md-4">
                                   <div class="alert alert-danger">
                                       <div class="icon hidden-xs">
                                           <i class="fa fa-people-line"></i>
                                       </div>
                                       <strong>Total</strong>
                                       <Br />
                                       @foreach($students as $student)
                                           {{ $student->nC }}
                                       @endforeach
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="alert alert-danger">
                                       <div class="icon hidden-xs">
                                           <i class="fa fa-person"></i>
                                       </div>
                                       <strong>Homens</strong>
                                       <Br />
                                       @foreach($studentsHs as $studentsH)
                                           {{ $studentsH->nC }}
                                       @endforeach
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="alert alert-danger">
                                       <div class="icon hidden-xs">
                                           <i class="fa fa-person-dress"></i>
                                       </div>
                                       <strong>Mulheres</strong>
                                       <Br />
                                       @foreach($stMs as $stMs)
                                           {{ $stMs->nC }}
                                       @endforeach
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div>Total de professores cadastrados</div>
                               <div class="col-md-4">
                                   <div class="alert alert-info">
                                       <div class="icon hidden-xs">
                                           <i class="fa fa-people-line"></i>
                                       </div>
                                       <strong>Total</strong>
                                       <Br />
                                       @foreach($professores as $professores)
                                           {{ $professores->tp }}
                                       @endforeach
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="alert alert-info">
                                       <div class="icon hidden-xs">
                                           <i class="fa fa-person"></i>
                                       </div>
                                       <strong>Homens</strong>
                                       <Br />
                                       @foreach($professHs as $professHs)
                                           {{ $professHs->tp }}
                                       @endforeach
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="alert alert-info">
                                       <div class="icon hidden-xs">
                                           <i class="fa fa-person-dress"></i>
                                       </div>
                                       <strong>Mulheres</strong>
                                       <Br />
                                       @foreach($professMs as $professMs)
                                           {{ $professMs->tp }}
                                       @endforeach
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div>Total de usuários cadastrados</div>
                               <div class="col-md-4">
                                   <div class="alert alert-warning">
                                       <div class="icon hidden-xs">
                                           <i class="fa fa-users"></i>
                                       </div>
                                       <strong>Total</strong>
                                       <Br />
                                       @foreach($users as $user)
                                           {{ $user->userName }}
                                       @endforeach
                                   </div>
                               </div>
                           </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

