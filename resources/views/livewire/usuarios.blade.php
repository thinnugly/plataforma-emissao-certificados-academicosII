<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
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
    <div id="getTable">
        <table class="table table-striped table-hover" id="getTU">
            <thead>
            <tr>
                <th>No</th>
                <th>Nome do usuário</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Acções</th>
            </tr>
            </thead>
            <tbody id="body">
            @if($search)
                @foreach($search as $search)
                    <tr>
                        <input type="hidden" class="serdelete_val_id" value="{{ $search->id}}">
                        <td>{{ $search->id }}</td>
                        <td>{{ $search->name }}</td>
                        <td>{{ $search->email }}</td>
                        <td>{{ $search->display_name }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary " href="{{ route('show',$search->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                            <a class="btn btn-sm btn-success" href="{{ route('editUser',$search->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger btn-sm showSweetModal"><i class="fa fa-fw fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                @foreach ($users as $user)
                    <tr>
                        <input type="hidden" class="serdelete_val_id" value="{{ $user->id}}">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->display_name }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary " href="{{ route('show',$user->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                            <a class="btn btn-sm btn-success" href="{{ route('editUser',$user->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger btn-sm showSweetModal"><i class="fa fa-fw fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div>
        <p>
            @if($filter)
                {{ $users->appends($filter)->links('pagination-links')}}
            @else
                {{ $users->links('pagination-links')}}
            @endif
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
                            url: '/administrator/usuarios/delete/'+getItemId,
                            data: "data",
                            success: function (response){
                                Swal.fire(
                                    'Eliminado!',
                                    'Usuário eliminado com  sucesso...',
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                });
                            }
                        });

                    }
                })
            });

            {{--$('.amount4').keypress(function(){--}}
            {{--    let getTxtPes = $('.amount4').val();--}}
            {{--    if(getTxtPes != "")--}}
            {{--    {--}}
            {{--        $('#body').html("");--}}
            {{--    }else if(getTxtPes === "")--}}
            {{--    {--}}
            {{--        $.ajax({--}}
            {{--            type: 'get',--}}
            {{--            url: '{!! URL::to('/administrator/usuarios/getAll') !!}',--}}
            {{--            success:function (users)--}}
            {{--            {--}}
            {{--                for (let index = 0; index < users.length; index++)--}}
            {{--                {--}}
            {{--                    $('tbody').append(--}}
            {{--                        '<tr>\--}}
            {{--                            <input type="hidden" class="serdelete_val_id" value="'+users[index].id+'">\--}}
            {{--                            <td>'+users[index].id+'</td>\--}}
            {{--                            <td>'+users[index].name+'</td>\--}}
            {{--                            <td>'+users[index].email+'</td>\--}}
            {{--                            <td>'+users[index].display_name+'</td>\--}}
            {{--                            <td>\--}}
            {{--                                <a class="btn btn-sm btn-primary " href="/administrator/usuarios/show/'+users[index].id+'"><i class="fa fa-fw fa-eye"></i></a>\--}}
            {{--                                <a class="btn btn-sm btn-success" href="/administrator/usuarios/edit/'+users[index].id+'"><i class="fa fa-fw fa-edit"></i></a>\--}}
            {{--                                <button type="submit" class="btn btn-danger btn-sm showSweetModal"><i class="fa fa-fw fa-trash"></i></button></button>\--}}
            {{--                            </td>\--}}
            {{--                        </tr>');--}}
            {{--                }--}}
            {{--            }--}}
            {{--        });--}}

            {{--    }--}}
            {{--});--}}

            {{--$(function()--}}
            {{--{--}}
            {{--    var seach = function(){--}}


            {{--        $('.amount4').each(function(){--}}
            {{--            $('#body').html("");--}}
            {{--            let getTxtPVal = $('.amount4').val();--}}
            {{--            if(getTxtPVal == "")--}}
            {{--            {--}}

            {{--            }else--}}
            {{--            {--}}



            {{--            }--}}
            {{--        });--}}

            {{--    }--}}

            {{--});--}}
        });
    </script>
</div>
