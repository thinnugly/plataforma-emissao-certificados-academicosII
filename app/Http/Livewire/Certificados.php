<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Certificados extends Component
{
    use withPagination;
    public $perPage = 5;
    public $search = '';

    public function render()
    {

        $certificados = DB::table('certificados')
        ->join('estudantes','certificados.estudanteId', '=', 'estudantes.nomeCompleto')
        ->select('certificados.id','certificados.estudanteId', 'certificados.portugues','certificados.ingles','certificados.frances',
        'certificados.filosolia','certificados.fisica','certificados.biologia','certificados.quimica','certificados.matematica','certificados.desenho',
        'certificados.geografia','certificados.edfisica','certificados.historia','certificados.historia','estudantes.contacto')
            ->paginate($this->perPage);
        return view('livewire.certificados',
        [
           'certificados' => $certificados,
        ]);
    }

    public function paginationView()
    {
        return 'pagination-links';
    }
}
