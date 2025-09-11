<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Usuarios extends Component
{
    use withPagination;
    public $perPage = 5;
    public $search = '';

    public function render()
    {
//        $users = User::query('SE')
//            ->search($this->search)
//            ->paginate($this->perPage);
//        return view('livewire.usuarios',[
//            'users'=>$users,
//        ])->with('i');

        $search = request('search');
        $filter = request()->all();
        if($search)
        {

            $users = DB::table('roles')
                ->join('role_user','roles.id', '=','role_user.role_id')
                ->join('users','role_user.user_id','=','users.id')
                ->select('users.name','users.email','users.id','roles.display_name')
                ->where('users.name', 'like', '%' .$search. '%')
                ->Orwhere('users.email', 'like', '%' .$search. '%')
                ->Orwhere('roles.display_name', 'like', '%' .$search. '%')
                ->paginate($this->perPage);
        }else
        {
            $users = DB::table('roles')
                ->join('role_user','roles.id', '=','role_user.role_id')
                ->join('users','role_user.user_id','=','users.id')
                ->select('users.name','users.email','users.id','roles.display_name')
//            ->search($this->search)
                ->paginate($this->perPage);
        }
        return view('livewire.usuarios',[
            'users'=>$users,
            'search'=>$search,
            'filter'=>$filter,
        ])->with('i');
    }

    public function paginationView()
    {
        return 'pagination-links';
    }
}
