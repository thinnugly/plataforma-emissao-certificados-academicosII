<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DisciplinaProfessor extends Component
{
    use withPagination;
    public $perPage = 5;
    public $search = '';

    public function render()
    {
        $disciplina_professor = DB::table('disciplina_professors')
        ->select('disciplina_professors.*')
            ->paginate($this->perPage);
        return view('livewire.disciplina-professor',
        [
            'disciplina_professor' => $disciplina_professor
        ]);
    }

    public function paginationView()
    {
        return 'pagination-links';
    }
}
