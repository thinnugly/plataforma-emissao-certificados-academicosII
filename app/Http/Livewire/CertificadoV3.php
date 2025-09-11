<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Certificado;
use Livewire\withPagination;
use Illuminate\Support\Facades\DB;

class CertificadoV3 extends Component
{
       
        use withPagination;
        public $perPage = 2;
        public $search = '';
        
        
        public function render()
        {
            $certificados = Certificado::query()->get();
           return view('livewire.certificado-v3',[
                'certificados'=>Certificado::latest()->paginate(10)
            ]);
        }

        public function updatingSearch()
        {
            $this->resetPage();
        }
        
}
