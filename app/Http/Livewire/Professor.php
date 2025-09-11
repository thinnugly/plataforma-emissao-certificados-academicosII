<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Professor extends Component
{
    use withPagination;
    public $perPage = 5;
    public $search = '';

    public function render()
    {
        $professores = DB::table('professores')
        ->join('users', 'professores.userId', 'users.email')
        ->select('professores.*')
            ->paginate($this->perPage);
        return view('livewire.professor',
        [
           'professores' => $professores
        ]);
    }

    public function paginationView()
    {
        return 'pagination-links';
    }
}
