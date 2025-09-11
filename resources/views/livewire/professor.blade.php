<div>
    {{-- Success is as dangerous as failure. --}}
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
                <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Pesquise o professor....">
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
                <th>Contacto</th>
                <th>Usuário</th>
                <th>Acções</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="tcorpo">
            @foreach ($professores as $professor)
                <tr>
                    <input type="hidden" class="serdelete_val_id" value="{{ $professor->id}}">
                    <td>{{ $professor->id }}</td>
                    <td>{{ $professor->nomeCompleto }}</td>
                    <td>{{ $professor->bi }}</td>
                    <td>{{ $professor->dataNascimento }}</td>
                    <td>{{ $professor->contacto }}</td>
                    <td>{{ $professor->userId }}</td>
                    <td>
                        <a class="btn btn-sm btn-primary " href="{{ route('showProf',$professor->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                        <a class="btn btn-sm btn-success" href="{{ route('editProf',$professor->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                        <button type="submit" class="btn btn-danger btn-sm showSweetModal"><i class="fa fa-fw fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <p>
                {{ $professores->links('pagination-links')}}
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
                            url: '/administrator/professores/delete/'+getItemId,
                            data: data,
                            success: function (response){
                                Swal.fire(
                                    'Eliminado!',
                                    'Professor eliminada com sucesso...',
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
