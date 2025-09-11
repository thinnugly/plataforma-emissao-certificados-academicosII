<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Estudante
 *
 * @property $id
 * @property $nomeCompleto
 * @property $Sexo
 * @property $paidId
 * @property $dataNascimento
 * @property $nomePai
 * @property $nomeMae
 * @property $classe
 * @property $userId
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Estudante extends Model
{

    static $rules = ([
		'nomeCompleto' => 'required',
		'Sexo' => 'required',
		'paidId' => 'required',
        'naturalidade'=> 'required',
        'morada'=> 'required',
		'dataNascimento' => 'required',
		'nomePai' => 'required',
		'nomeMae' => 'required',
		'classe' => 'required',
		'userId' => 'required',
        'turma_stu' => 'required',
    ]);

    //protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    // protected $fillable = ['nomeCompleto','Sexo','paidId','dataNascimento','nomePai','nomeMae','classe','userId','naturalidade', 'morada','bi','contacto','turma_stu'];
    protected $fillable = ['nomeCompleto','Sexo','paidId','dataNascimento','nomePai','nomeMae','classe','userId','naturalidade', 'morada','turma_stu'];

     public function scopeSearch($query, $val)
     {
         return $query
             ->where('nomeCompleto', 'like', '%' .$val. '%')
             ->Orwhere('Sexo', 'like', '%' .$val. '%')
             ->Orwhere('paidId', 'like', '%' .$val. '%')
             ->Orwhere('nomePai', 'like', '%' .$val. '%')
             ->Orwhere('userId', 'like', '%' .$val. '%')
             ->Orwhere('naturalidade', 'like', '%' .$val. '%')
             ->Orwhere('morada', 'like', '%' .$val. '%')
            //  ->Orwhere('bi', 'like', '%' .$val. '%')
            //  ->Orwhere('contacto', 'like', '%' .$val. '%')
             ->Orwhere('turma_stu', 'like', '%' .$val. '%') 
             ;
     }
}
