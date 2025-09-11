<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Livewire\WithPagination;

/**
 * Class Certificado
 *
 * @property $id
 * @property $portugues
 * @property $ingles
 * @property $frances
 * @property $filosolia
 * @property $fisica
 * @property $biologia
 * @property $quimica
 * @property $matematica
 * @property $desenho
 * @property $geografia
 * @property $edfisica
 * @property $historia
 * @property $mediaFinal
 * @property $estudanteId
 * @property $created_at
 * @property $updated_at
 *
 * @property Estudante $estudante
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Certificado extends Model
{
    
    static $rules = [
		'mediaFinal' => 'required',
		'estudanteId' => 'required',
    ];

    protected $perPage = 5;
    
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
     protected $table = "certificados";
     protected $fillable = ['portugues','ingles','frances','filosolia','fisica','biologia','quimica','matematica','desenho','geografia','edfisica','historia','mediaFinal','estudanteId','juri','situacao','status'];
    
     public function scopeSearch($query, $val)
     {
         return $query
             ->where('estudanteId', 'like', '%' .$val. '%')
            //  ->Orwhere('situacao', 'like', '%' .$val. '%')
            //  ->Orwhere('juri', 'like', '%' .$val. '%')
            //  ->Orwhere('portugues', 'like', '%' .$val. '%')
            //  ->Orwhere('ingles', 'like', '%' .$val. '%')
            //  ->Orwhere('frances', 'like', '%' .$val. '%')
            //  ->Orwhere('fisica', 'like', '%' .$val. '%')
            //  ->Orwhere('biologia', 'like', '%' .$val. '%')
            //  ->Orwhere('quimica', 'like', '%' .$val. '%') 
            //  ->Orwhere('matematica', 'like', '%' .$val. '%')
            //  ->Orwhere('geografia', 'like', '%' .$val. '%')
            //  ->Orwhere('edfisica', 'like', '%' .$val. '%')
            //  ->Orwhere('historia', 'like', '%' .$val. '%')
            //  ->Orwhere('mediaFinal', 'like', '%' .$val. '%') 
             ;
     }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estudante()
    {
        return $this->hasOne('App\Models\Estudante', 'nomeCompleto', 'estudanteId');
    }
    

}
