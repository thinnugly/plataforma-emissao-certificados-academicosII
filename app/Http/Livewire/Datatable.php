<?php

namespace App\Http\Livewire;

use App\Models\Estudante;
use App\Models\Turma;
use Livewire\Component;
use Livewire\withPagination;
use Illuminate\Support\Facades\DB;

class Datatable extends Component
{
    use withPagination;
    public $perPage = 5;
    public $search = '';

    public function render()
    {
        $turmas = Turma::all();
        $estudantes = Estudante::query()
            ->search($this->search)
        ->paginate($this->perPage);
        return view('livewire.datatable',[
            'estudantes'=>$estudantes,
            'turmas'=>$turmas
        ])->with('i');
    }

    public function paginationView()
    {
        return 'pagination-links';
    }

}
