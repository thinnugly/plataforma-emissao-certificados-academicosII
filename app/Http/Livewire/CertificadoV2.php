<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Certificado;
use Livewire\withPagination;
use Illuminate\Support\Facades\DB;

class CertificadoV2 extends Component
{
       
        use withPagination;
        public $perPage = 2;
        public $search = '';
        
        
        public function render()
        {
            $certificados = Certificado::query()->get();
           return view('livewire.certificado-v2',[
                'certificados'=>Certificado::latest()->paginate(10)
            ]);
        }

        public function updatingSearch()
        {
            $this->resetPage();
        }
        
}
