<div>
    {{-- The whole world belongs to you. --}}
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
                <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Pesquise a disciplina....">
            </div>
        </div>
        <div id="info" style="margin-top: 23px;margin-bottom: 23px;">
        </div>
        <table class="table table-striped table-hover">
            <thead class="thead">
            <tr>
                <th>No</th>
                <th>Disciplina</th>
                <th>Professor alocado</th>
                <th>Turma</th>
                <th>Classe</th>
                <th>Secção</th>
                <th>Acções</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="tcorpo">
            @foreach ($disciplina_professor as $professor)
                <tr>
                    <input type="hidden" class="serdelete_val_id" value="{{ $professor->id}}">
                    <input type="hidden" class="serdelete_val_disname" value="{{ $professor->disciplinaId}}">
                    <input type="hidden" id="getDisciplinaId">
                    <td>{{ $professor->id }}</td>
                    <td>{{ $professor->disciplinaId }}</td>
                    <td>{{ $professor->professorId }}</td>
                    <td>{{ $professor->turmaId }}</td>
                    <td>{{ $professor->classeId }}</td>
                    <td>{{ $professor->seccaoId }}</td>
                    <td>
                        <a class="btn btn-sm btn-primary " href="{{ route('_showAloc',$professor->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                        <a class="btn btn-sm btn-success" href="{{ route('_editAloc',$professor->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                        <button type="submit" href="{{ route('editProf',$professor->id) }}" class="btn btn-danger btn-sm showSweetModal"><i class="fa fa-fw fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <p>
                {{ $disciplina_professor->links('pagination-links')}}
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
                var getItemId = $(this).closest("tr").find('.serdelete_val_id').val(),
                    getItemName = $(this).closest("tr").find('.serdelete_val_disname').val();
                $.ajax({
                    type: 'get',
                    url: '{!! URL::to('findIdByDisciplina') !!}',
                    data: {'disciplinaName':getItemName},
                    dataType: 'json',
                    success: function (data){
                        for(var i=0; i<data.length; i++){
                            $('#getDisciplinaId').val(data[i].id);
                            
                        }
                    },
                    error: function (){

                    }
                });
                
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
                        let getDisciplinaIdII = $('#getDisciplinaId').val();
                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": getItemId,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: '/administrator/disciplinas/delete/'+getItemId,
                            data: data,
                            success: function (response){
                                Swal.fire(
                                    'Eliminado!',
                                    'Disciplina desalocada com sucesso...',
                                    'success'
                                ).then((result) => {
                                        location.reload();
                                    });
                            }
                        });
                        $.ajax({
                            type: 'get',
                            url: '{!! URL::to('/administrator/disciplinas/updatedisciplinastatusII') !!}',
                            data: {'getDiscId':getDisciplinaIdII},
                            success: function(response)
                            { 
                                if(response.estado == 200)
                                {
                                    console.log(response.message);
                                }
                            }
                        });
                        

                    }
                })

            });
        });
    </script> 
</div>
