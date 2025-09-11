<div>
    {{-- Do your work, then step back. --}}
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
                Turmas:
                <select id="turma_stu" class="form-control getTurma_stu @error('turma_stu') is-invalid @enderror" name="turma_stu" value="{{ old('turma_stu') }}">
                    <option selected disabled>Selecione a turma</option>
                    @foreach($turmas as $turmas)
                        <option value="{{$turmas -> nome_turma }}">{{$turmas -> nome_turma }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6" style="margin-top: 23px;">
                <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Pesquise o estudante....">
            </div>
        </div>
        <div id="info" style="margin-top: 23px;margin-bottom: 23px;">
        </div>
        <table class="table table-striped table-hover">
            <thead class="thead">
            <tr>
                <th>No</th>
                <th>Nome completo</th>
                <th>Nr. BI</th>
                <th>Data de nascimento</th>
                <th>Classe</th>
                <th>Secção</th>
                <th>Turma</th>
                <th>Acções</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="tcorpo">
            @foreach ($estudantes as $estudante)
                <tr>
                    <input type="hidden" class="serdelete_val_id" value="{{ $estudante->id}}">
                    <td>{{ $estudante->id }}</td>
                    <td>{{ $estudante->nomeCompleto }}</td>
                    <!-- <td>{{ $estudante->bi }}</td> -->
                    <td>{{ $estudante->dataNascimento }}</td>
                    <td>{{ $estudante->classe }}</td>
                    <td>{{ $estudante->contacto }}</td>
                    <td>{{ $estudante->turma_stu}}</td>

                    <td>
                        <a class="btn btn-sm btn-primary " href="{{ route('showStu',$estudante->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                        <a class="btn btn-sm btn-success" href="{{ route('editStu',$estudante->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                        <button type="submit" class="btn btn-danger btn-sm showSweetModal"><i class="fa fa-fw fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <p>
                {{ $estudantes->links('pagination-links')}}
            </p>
        </div>
    <script src="{{asset('site/jquery.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function (){
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
                            url: '/administrator/estudantes/delete/'+getItemId,
                            data: data,
                            success: function (response){
                                Swal.fire(
                                    'Eliminado!',
                                    'Estudante eliminada com sucesso...',
                                    'success'
                                ).then((result) => {
                                        location.reload();
                                    });
                            }
                        });

                    }
                })
            });

            $(document).on('change','.getTurma_stu', function (){
                getStuTurma = $(this).val();
                $('#info').html("");
                $('#tcorpo').html("");
                $.ajax({
                    type: 'get',
                    url: '{!! URL::to('getStuQTDByTurmaName') !!}',
                    data: {'turma_stu':getStuTurma},
                    success: function (qtdStuByTurma){
                        for(var i=0; i<qtdStuByTurma.length; i++)
                        {
                            
                            $('#info').append(
                                '<strong>\
                                    Esta turma possui '+qtdStuByTurma[i].QTD+' aluno (s) inscrito (s)!\
                                </strong>'
                            );
                            
                        }
                        $.ajax({
                        type: 'get',
                        url: '{!! URL::to('getAllStuTurmaName') !!}',
                        data: {'turma_stu':getStuTurma},
                        success: function (data){
                            for(var i=0; i<data.length; i++)
                            {
                                
                                $('#tcorpo').append(
                                    '<tr>\
                                        <input type="hidden" class="serdelete_val_id" value="'+data[i].id+'">\
                                        <td>'+data[i].id+'</td>\
                                        <td>'+data[i].nomeCompleto+'</td>\
                                        <td>'+data[i].bi+'</td>\
                                        <td>'+data[i].dataNascimento+'</td>\
                                        <td>'+data[i].classe+'</td>\
                                        <td>'+data[i].contacto+'</td>\
                                        <td>'+data[i].turma_stu+'</td>\
                                        <td>\
                                            <a class="btn btn-sm btn-primary" href="/administrator/estudantes/show/'+data[i].id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                            <a class="btn btn-sm btn-success" href="/administrator/estudantes/edit/'+data[i].id+'"><i class="fa fa-fw fa-eye"></i></a>\
                                            <button type="submit" class="btn btn-danger btn-sm delete" id="'+data[i].id+'"><i class="fa fa-fw fa-trash"></i></button>\
                                        </td>\
                                    </tr>'
                                );
                                
                            }
                        }
                    });
                    }
                });
                
            });

            $(document).on('click', '.delete', function (e)
            {
                e.preventDefault();
                // var getItemId = $(this).closest("tr").find('.serdelete_val_id').val();
                let getIdDel = $(this).attr("id");
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
                            "id": getIdDel,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: '/administrator/estudantes/delete/'+getIdDel,
                            data: data,
                            success: function (response){
                                Swal.fire(
                                    'Eliminado!',
                                    'Estudante eliminada com sucesso...',
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
</div>
@section('scripts')

@endsection
