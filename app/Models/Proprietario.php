<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class Proprietario extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;


    // Gravação do Log
    protected static $logName = 'Proprietarios'; // Nome do Log
    protected static $logAttributes = ['*']; // Pega todos os campos da entidade
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    // Define o nome da tabela
    protected $table = 'proprietarios';

    // Chave Primaria
    protected $primaryKey = 'id';


    //Define os campos da entidade
    protected $fillable = [
        'tenant_id',
        'uuid',
        'razao_social',
        'nome_fantasia',
        'abreviacao',
        'tipo_pagamento',
        'tipo',
        'data_nascimento',
        'nascionalidade',
        'naturalidade',
        'estado_civel',
        'cpf_cnpj',
        'rg_inscriacao',
        'email',
        'telefone',
        'celular',
        'status',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'endereco',
        'complemento',
        'numero',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tenant_id' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'data_nascimento',
    ];

    /**
     * Método empresa()
     * Responsavel por interligar as Entidades Proprietario com Empresa
     * Traz as informações da Empresa
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Método fazendas()
     * Responsavel por interligar as Entidades Proprietario com Fazenda
     * Traz todas as Fazenda refrente ao determinado Proprietario
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function fazendas()
    {
        return $this->hasMany(Fazenda::class);
        
    }
}
